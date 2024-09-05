<?php

namespace App\Traits;

use App\Models\Post;
use App\Models\Post_image;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

trait GlobalTrait
{
    /*  public $images_dir = (is_dir(public_path('../../public/imagesz/')))? '../../public/images/':'images/';
    public $temp_image_dir = $this->images_dir.'courses/temp/'; */

    public function getImagesDir()
    {
        return 'images/';
    }
    public function getTempImageDir()
    {
        return $this->getImagesDir() . 'courses/temp/';
    }

    /**
     * Summary of file_exists_get_new_name
     * This function will check if file exists in specified folder, if it exists, add number to the end of the file name, if the next name still exists, keep incrementing until it doesn't exist
     * @param string $dir
     * @param string $file_name
     * @return string
     */
    public function file_exists_get_new_name(string $dir, string $file_name)
    {
        $image_location = "$dir/$file_name";
        $new_image_name = $file_name;
        while (file_exists($image_location)) {
            Log::info('there is an image in temp folder with same name::' . $image_location);
            $location_array = explode('/', $image_location);
            $image_name = $location_array[count($location_array) - 1]; // dzb_00000_gimp_crop_image.jpg
            $name_array = explode('.', $image_name);
            $name = $name_array[0]; // dzb_00000_gimp_crop_image
            $extension = $name_array[count($name_array) - 1]; // jpg or png etc
            $last_index = strlen($name) - 1;
            $number_count = 0;
            while (is_numeric($name[$last_index])) {
                $number_count++;
                $last_index--;
            }
            if (!$number_count) {
                Log::info("------------No number found-------------");
                $new_image_name = $name_array[0] . '1.' . $extension;
            } else {
                $extracted_number = (int) substr($name, -$number_count) + 1;
                // change dzb_00000_image0.jpg to dzb_00000_image1.jpg
                $new_image_name = substr($name, 0, -strlen($extracted_number)) . "$extracted_number.$extension";
            }

            $image_location = str_replace($image_name, $new_image_name, $image_location);
            Log::info("::Image Name=>$image_location");
        }
        return $new_image_name;
    }

    /**
     * is_local
     * @return bool
     * @param Request $request
     */
    public function is_local(Request $request): bool
    {
        return !str_contains($request->url(), '.com/');
    }

    /**
     * add_post_with_consistent_id
     */
    public function add_post_with_consistent_id(Request $request)
    {
        $last_post_id = Post::latest('id')->first()->id;

        // add dummy (unpublished) posts till $id-1 while last post id + 1 < $request->id
        while ($last_post_id + 1 < $request->id) {
            $dummy_post = Post::create([
                "topic" => "dummy",
                "content" => "dummy",
                "status" => "unpublished",
                "description" => "dummy",
                "tags" => "dummy",
                "type"  => "course-series",
                "subject_id" => $request->subject_id,
                "author_id" => 1,
                'comment_count' => 0,
                'slug' => 'dummy' . $last_post_id + 1,
            ]);
            $last_post_id = $dummy_post->id;
        }
        // if last post id + 1 is not equal to received id, the post is out of sync, return error
        if ($last_post_id + 1 != $request->id) {
            return [
                'status' => 'error',
                'message' => 'Post out of sync. Next post id is ' . ($last_post_id + 1) . ' and received id is ' . $request->id . '.',
            ];
        }
        $post = Post::create($request->post);
        return [
            'status' => 'success',
            'message' => 'post successfully added',
            'data' => $post,
        ];
    }

    /**
     * sync_post_images
     */
    public function sync_post_images(int $post_id, array $post_images)
    {
        $existing_post_images = Post_image::where('post_id', $post_id)->get();
        $existing_post_image_links = array_map(function ($link) {
            return $link['link'];
        }, $existing_post_images->toArray());

        $new_images = array_filter($post_images, function ($image) use ($existing_post_image_links) {
            return !in_array($image['link'], $existing_post_image_links);
        });
        if (count($new_images)) {
            $this->download_post_images($post_id, $new_images);
        }
    }

    /**
     * download_post_images
     * @return bool
     */
    public function download_post_images(int $post_id, array $post_images): bool
    {
        $error_downloading_images = false;
        foreach ($post_images as $post_image) {
            try {
                $image_extension = last(explode('.', $post_image['link']));
                $response = Curl::to(config('app.live_url') . $post_image['link'])->allowRedirect()->withContentType("image/$image_extension")->download($post_image['link']);
                Post_image::create($post_image + ['post_id' => $post_id]);
            } catch (Exception $e) {
                $error_downloading_images = true;
                Log::error('An error occurred while downloading post images::' . $e->getMessage());
                Log::error($e);
            }
        }
        return $error_downloading_images;
    }

    /**
     * delete_removed_images
     */
    public function delete_removed_images(int $post_id, array $post_images)
    {
        // delete images that have been removed from post
        $post_db_images = Post_image::where('post_id', $post_id)->get();
        $post_images_links = array_map(function ($image) {
            return $image['link'];
        }, $post_images);
        foreach ($post_db_images as $image) {
            if (!in_array($image->link, $post_images_links)) {
                $removed_link = $image->link;
                $image->delete();
                if (file_exists($removed_link)) {
                    unlink($removed_link);
                }
            }
        }
    }
}
