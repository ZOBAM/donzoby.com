<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\Post_image;
use App\Models\Subject;
use App\Models\User;
use App\Traits\GlobalTrait;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // loop through all post and populate the slug cols using the topic
        /* foreach (Post::get() as $post) {
            $post->sort_value = $post->id;
            $post->save();
        } */
        // return list of matching parent posts
        if ($request->has("subject_id")) {
            $post = Post::where("subject_id", $request->subject_id)->where('type', $request->type)->orderBy("created_at", "desc")->get();
            return response()->json(
                ["parents" => $post]
            );
        }

        $posts = Post::paginate(10);
        foreach ($posts as $post) {
            $post->is_parent = Post::where("parent_id", $post->id)->count();
            $post->is_child = $post->parent_id;
            $post->content = Str::words(strip_tags($post->content), 35);
        }
        return view('admin.posts')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = Course::with('subjects')->get();
        return view("admin.create-post")->with("courses", $course);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'     => ['required', 'min:5', 'max:20',],
            'parent_id'         => ['nullable', 'exists:posts,id',],
            'subject_id'       => ['required', 'exists:subjects,id',],
            'topic'         => ['required', 'string', 'min:7', 'max:200',],
            'content'  => ['required', 'string', 'min:200', 'max:3500',],
            'status'   => ['required', 'string', Rule::in(['published', 'unpublished']),],
            'tags'     => ['required', 'string', 'min:4', 'max:200',],
            'description'     => ['required', 'string', 'min:30', 'max:1500',],
            'comment_status'     => ['required', 'string', Rule::in(['open', 'closed'])],
            // 'picture.*'     => 'image|mimes:jpeg,png,jpg|max:250',
        ]);
        $validated['author_id'] = Auth::id();
        // add post slug using the post topic
        $validated['slug'] = $this->get_post_slug($request->topic);

        $post = Subject::find($validated['subject_id'])->posts()->create($validated);

        if ($post) {
            //increment user post count
            $user = User::find(Auth::id());
            $user->post_count =  (($user->post_count + 1)); //increment sagged items
            $user->save();
            //fetch image link form post content and save in the database
            $num_images = preg_match_all('/src="([^"]+.[^s])"/i', $request->content, $matches);
            $link_matches = $matches[1];
            if ($num_images > 0) {
                foreach ($link_matches as $original_img_url) {
                    $rel_img_url_for_db = $this->assign_image_unique_name($post, $original_img_url);
                    // save post image link to db
                    $post->post_images()->create(['link' => $rel_img_url_for_db]);
                    //move image from temp location to it's subject folder
                    $this->move_post_image($post, $original_img_url, $rel_img_url_for_db);
                }
            }
        }
        return response()->json([
            'status' => 'success',
            'message' => 'New post created.',
            'post' => $post,
        ]);
        // return redirect('/post');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $course = Course::with('subjects')->get();
        $post = Post::where('id', $post->id)->with('subject')->first();
        // $post->content = str_replace('../../images/courses', '/images/courses', $post->content);
        // Log::info($post->content);
        return view("admin.create-post")->with(["courses" => $course, "post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            // if sort_value is set, update it
            // AT THE MOMENT, SORTING IS ONLY DONE FOR POSTS WITHIN A SPECIFIC SUBJECT
            if ($request->has('sort_direction')) {
                $response = [];
                if ($request->sort_direction == 'down') {
                    $target_same_subject_post = Post::where('subject_id', $post->subject_id)->where('sort_value', '>', $post->sort_value)->first();
                } else {
                    $target_same_subject_post = Post::where('subject_id', $post->subject_id)->where('sort_value', '<', $post->sort_value)->latest()->first();
                }
                if (!$target_same_subject_post) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'no ' . $request->sort_direction . 'ward position exists for ' . $post->subject->name,
                    ], 404);
                }
                // switch
                $temp_sort_value = $post->sort_value;
                $post->sort_value = $target_same_subject_post->sort_value;
                $target_same_subject_post->sort_value = $temp_sort_value;
                $post->save();
                $target_same_subject_post->save();

                $response['message'] = 'post sort_value changed.::' . $target_same_subject_post->topic;
                $response['data'] = $post;
                return response()->json($response);
            }
            // else proceed with the normal post update
            $validated = $request->validate([
                "id" => ['required', 'exists:posts,id'],
                'type'     => ['sometimes', 'min:5', 'max:20'],
                'parent_id'         => ['nullable', 'exists:posts,id'],
                'subject_id'       => ['required', 'exists:subjects,id'],
                'topic'         => ['required', 'string', 'min:7', 'max:200'],
                'content'  => ['required', 'string', 'min:200'],
                'status'   => ['required', 'string', Rule::in(['published', 'unpublished']),],
                'tags'     => ['required', 'string', 'min:4', 'max:200'],
                'description'     => ['required', 'string', 'min:30', 'max:1500'],
                'comment_status'     => ['required', 'string', Rule::in(['open', 'closed'])],
                // 'picture.*'     => 'image|mimes:jpeg,png,jpg|max:250',
            ]);


            $old_subject = $post->subject;
            $new_subject = Subject::find($request->subject_id);
            $subject_changed = $new_subject != $old_subject;

            // if topic changed update slug
            if ($post->topic != $request->topic) {
                $validated['slug'] = $this->get_post_slug($request->topic);
            }

            // update post in db
            $post->update($validated);

            //check if image links are available in the post content
            $pattern = '/src="([^"]+.[^s])"/i';
            $num_images = preg_match_all($pattern, $post->content, $matches);
            $image_link_matches = $matches[1];
            //images saved in db
            $db_images = Post_image::where('post_id', $post->id)->get();

            // filter image links into two categories
            $new_image_links = array_filter($image_link_matches, function ($i_link) {
                return str_contains($i_link, 'images/courses/temp/dzb_00000_');
            });
            $old_image_links = array_filter($image_link_matches, function ($i_link) {
                return !str_contains($i_link, 'images/courses/temp/dzb_00000_');
            });

            /* Log::info('these are old image links');
        Log::info(json_encode($old_image_links));
        Log::info('these are new image links');
        Log::info(json_encode($new_image_links)); */

            if ($num_images > 0) { //there are matches for image link

                // save new images
                foreach ($new_image_links as $original_img_url) {
                    $rel_img_url_for_db = $this->assign_image_unique_name($post, $original_img_url);
                    // save post image link to db
                    $post->post_images()->create(['link' => $rel_img_url_for_db]);
                    //move image from temp location to it's subject folder
                    $this->move_post_image($post, $original_img_url, $rel_img_url_for_db);
                }

                // ----------------update old images url by replacing ../../ with absolute path ----------------//
                // ----------------loop thru and change img url to absolute url----------------//
                foreach ($old_image_links as $image_link) { //loop thru & replace ../image with www.domain/image
                    $pattern = '/[\.\.]+\//';
                    $abs_img_url = URL(preg_replace($pattern, "", $image_link));
                    if ($subject_changed) { //update post image url if subject was changed
                        $abs_img_url = str_replace("/images/courses/$old_subject->slug/", "/images/courses/$new_subject->slug/", $abs_img_url);
                    }
                    $post->content = str_replace($image_link, $abs_img_url, $post->content);
                    $post->save();
                } //end ----------------loop thru and change img url to absolute url----------------//

                if (count($db_images) > 0) { //there are images in db for this post
                    foreach ($db_images as $db_image) {
                        $db_image_link = $db_image->link;

                        $edited_db_img_url = "../../" . $db_image_link;

                        if (in_array($edited_db_img_url, $image_link_matches)) { //db image is in matched links
                            if ($subject_changed) {
                                $pattern = '/courses\/[a-z-]+\//i';
                                $new_db_image = preg_replace($pattern, "courses/$new_subject->slug/", $db_image_link);
                                // update image link in db
                                Post_image::find($db_image->id)->update([
                                    "link" => $new_db_image
                                ]);

                                $this->move_post_image($post, $db_image_link, $new_db_image);
                            }
                        } else { //delete image if it's in db but no more in post content
                            if (strpos($post->content, $db_image_link) == false) {
                                $this->delete_images($db_images->only([$db_image->id]));
                            }
                        } //end else
                    }
                } //end if db image was > 0

            } //end if there are matches for images links
            else { //there is no image links in the post content
                if (count($db_images) > 0) { //check if there are orphaned image link in db and dir & clear
                    $this->delete_images($db_images);
                }
            }
            return response()->json([
                "status" => "success",
                "message" => "post successfully updated",
                "data" => $post,
            ]);
        } catch (Exception $e) {
            Log::error('::::::POST UPDATE ERROR:::::::');
            Log::error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $user = User::find(Auth::id());
        // allow only those with applicable permission to delete post
        if (!($user->hasPermissionTo('delete posts') || $user->hasRole('super admin'))) {
            return back()->with('post_delete_error', 'you are not authorized to delete a post');
        }

        $post_children = Post::where("parent_id", $post->id)->get();
        if (count($post_children) > 0) {
            return back()->with("post_delete_error", "This post has children and therefore cannot be deleted");
        }
        //specify images directory first for development and then for production
        $post_images = Post_image::where('post_id', $post->id)->get();
        //delete the post from db, clear img links from db, and then delete files from server.
        if (Post::destroy($post->id)) {
            //decrement user post_count
            $user->post_count =  ($user->post_count - 1);
            $user->save();

            $this->delete_images($post_images);

            return back()->with('post_delete_success', true);
        }
    }

    /**
     * move_post_image
     */
    public function move_post_image(Post $post, $origin, $destination)
    {
        // create subject image directory if it doesn't exist
        $dir_string = $this->getImagesDir() . "courses/" . $post->subject->slug;
        if (!is_dir($dir_string)) {
            mkdir($dir_string);
        }
        // rename file if it exists
        $original_img_url = str_replace('../', '', $origin);
        if (file_exists($original_img_url)) {
            rename($original_img_url, $destination);
        }
    }

    /**
     * replace_post_img_link
     * @return string
     */
    public function assign_image_unique_name(Post $post, string $original_img_url)
    {
        $rel_img_url = str_replace("courses/temp", "courses/" . $post->subject->slug, $original_img_url);
        // generate unique name for image
        $unique_name = "dzb_" . str_pad($post->id, 5, "0", STR_PAD_LEFT) . "_";
        $rel_img_url = str_replace("dzb_00000_", $unique_name, $rel_img_url);
        //absolute url will be in the post content
        $rel_img_url_for_db = str_replace('../', '', $rel_img_url);
        // update the link in post content
        $post->content = str_replace($original_img_url, URL($rel_img_url_for_db), $post->content);
        $post->save();

        return $rel_img_url_for_db;
    }

    /**
     * delete_images
     */
    public function delete_images(Collection $post_images)
    {
        if (count($post_images) > 0) {
            foreach ($post_images as $image) {
                if (file_exists($image->link)) {
                    Log::info('found image file and about to delete:::' . $image->link);
                    unlink($image->link);
                } else {
                    Log::info('could not find image file and cannot delete:::' . $image->link);
                }
                // delete record in db if it is still existing
                if (Post_image::find($image->id)) {
                    Post_image::destroy($image->id);
                }
            }
        }
    }

    /**
     * get_post_slug
     * @return string
     */
    public function get_post_slug(string $topic)
    {
        return str_replace('?', '', str_replace(' ', '_', strtolower($topic)));
    }
}
