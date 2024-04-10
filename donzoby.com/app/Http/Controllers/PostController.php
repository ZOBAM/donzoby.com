<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Post;
use App\Models\Post_image;
use App\Models\Subject;
use App\Models\User;
use App\Traits\GlobalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use GlobalTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // return list of matching parent posts
        if($request->has("parent")){
            $post = Post::where("parent_id", null)->orderBy("created_at","desc")->get();
            return response()->json(
                ["parents"=> $post]
            );
        }

        $posts = Post::paginate(5);
        foreach( $posts as $post ){
            $post->content = Str::words(strip_tags($post->content), 35);
        }
        return view('user.posts')->with(['posts'=> $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = Course::with('subjects')->get();
        return view("user.create-post")->with("courses", $course);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'     => 'sometimes|min:5|max:20',
            'parent_id'         => 'nullable|exists:posts,id',
            'subject_id'       => 'required|exists:subjects,id',
            'topic'         => 'required|string|min:7|max:200',
            'content'  => 'required|string|min:200',
            'status'   => 'required|string|min:9|max:11',
            'tags'     => 'required|string|min:4|max:200',
            'description'     => 'required|string|min:30|max:1500',
            // 'picture.*'     => 'image|mimes:jpeg,png,jpg|max:250',
        ]);
        $validated['author_id'] = Auth::id();

            /* $post = new Post;
            $post->author_id        = Auth::id();
            $post->course           = $request->course;
            $post->post_type        = $request->post_type;
            $post->subject          = $request->subject;
            $post->post_topic       = $request->topic;
            $post->post_content     = $request->post_content;
            $post->post_status      = $request->post_status;
            $post->post_tags        = $request->post_tags;
            $post->post_description = $request->post_desc; */

            $post = Subject::find($validated['subject_id'])->posts()->create( $validated );

            if ($post) {
                //increment user post count
                $user = User::find(Auth::id());
                $user->post_count =  (($user->post_count+1));//increment sagged items
                $user->save();
                //fetch image link form post content and save in the database
                $num_images = preg_match_all('/src="([^"]+.[^s])"/i', $request->content, $matches);
                $link_matches = $matches[1];
                if ($num_images>0) {
                    foreach ($link_matches as $original_img_url) {
                        $unique_name = "dzb_".str_pad($post->id,5,"0",STR_PAD_LEFT)."_";

                        $post_image = new Post_image;
                        $rel_img_url = str_replace("courses/temp", "courses/".$post->subject->slug, $original_img_url);
                        $rel_img_url = str_replace("dzb_00000_", $unique_name, $rel_img_url);

                        //absolute url will be in the post content
                        $abs_img_url = URL(str_replace("../","",$rel_img_url));
                        $post->content = str_replace($original_img_url, $abs_img_url, $post->content);
                        $post->save();

                        $rel_img_url_for_db = str_replace('../','',$rel_img_url);
                        $post_image->link = $rel_img_url_for_db;
                        $post_image->post_id = $post->id;
                        $post_image->save();

                        //specify images directory first for development and then for production
                        if (!is_dir(URL($this->getImagesDir()."courses/".$post->subject->slug))) {
                            mkdir(URL($this->getImagesDir()."courses/".$post->subject->slug));
                        }
                        // rename file if it exists
                        $original_img_url = str_replace('../','',$original_img_url);
                        if(file_exists($original_img_url)){
                            rename($original_img_url, $rel_img_url_for_db);
                        }
                    }
                }
            }
            return response()->json([
                'status'=>'success',
                'message'=> 'New post created.',
                'post'=> $post,
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
        return 'about to edit a post';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //specify imgages directory first for development and then for production
        $user = User::find(Auth::id());
        $post_img = Post_image::where('post_id', $post->id)->get();
        //delete the post from db, clear img links from db, and then delete files files from server.
        if(Post::destroy($post->id)){
            //decrement user post_count
           $user->post_count =  ($user->post_count-1);
           $user->save();

           if (count($post_img)>0) {
               foreach ($post_img as $image) {
                    if (file_exists($image->link)) {
                        Log::info('found image file and about to delete:::'.$image->link);
                    unlink($image->link);
                    }else{
                        Log::info('could not find image file and cannot delete:::'.$image->link);
                    }
              }
           }

        return back()->with('post_delete_success',true);
        }
    }
}
