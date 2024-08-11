<?php

namespace App\Classes;

use App\Models\Post;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;

class PostClass
{
    private Post $post;
    public array $what_changed = [];

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function sync_post()
    {
        // if something changed, try to sync what changed in post
        if (count($this->what_changed)) {
            try {

                Log::info('::::Attempt to sync post::::');
                Log::info(json_encode($this->what_changed));
                // save sync to db
                return $this->save_sync();
            } catch (Exception $e) {
                Log::error('**an error occurred while trying to sync post.');
                Log::error($e);
            }
        } else {
            Log::info('Not syncing because nothing changed');
        }
    }

    /**
     * save_sync
     */
    private function save_sync()
    {
        $message = 'syncing of post failed. Please try again';
        try {
            // reassign post because of the possible changes that took place
            $this->post = Post::find($this->post->id);

            // save sync to db
            $post_sync = $this->post->post_syncs()->create([
                'what_changed' => $this->what_changed,
            ]);
            Log::info("@@@@@@@@@@@POST SYNC@@@@@@@@@@@");
            Log::info(json_encode($post_sync));
            // get the field that changed
            $post_array = $this->post->toArray();
            $is_just_syncing = in_array('just_syncing', $this->what_changed);
            if (!in_array('all', $this->what_changed) && !$is_just_syncing) { // if it post edit
                $changed_fields = array_filter($post_array, function ($key) {
                    return in_array($key, $this->what_changed);
                }, ARRAY_FILTER_USE_KEY);
                // add post id
                $changed_fields['id'] = $this->post->id;
                $changed_fields['removed_images'] = $this->what_changed['removed_images'] ?? null;
            } else { // it is a new post
                $changed_fields = $this->post->toArray();
                // indicate that it's a new post
                $changed_fields['is_new_post'] = true;
                if ($is_just_syncing) {
                    $changed_fields['just_syncing'] = true;
                }
            }

            $changed_fields['added_images'] = $this->what_changed['added_images'] ?? null;

            // check if new images were added and upload files
            $request = Curl::to('http://www.donzoby.net/api/local-curl')->withData($changed_fields);
            if (isset($this->what_changed['added_images']) && count($this->what_changed['added_images'])) {
                for ($i = 0; $i < count($this->what_changed['added_images']); $i++) {
                    $link = $this->what_changed['added_images'][$i];
                    // only attach the image if it actually exists
                    if (!file_exists($link)) {
                        continue;
                    }
                    // extract image extension
                    $image_extension = last(explode('.', $link));
                    // Log::info("++++++++++++++++This is the extension::=>$image_extension++++++++++++");
                    $mime = "image/$image_extension";
                    // Log::info("++++++++++++++++This is the mime::=>$mime++++++++++++");
                    $request->withFile("image$i", $link, $mime);
                }
            }
            $response = $request->returnResponseObject()->post();
            // updated post sync if post was successfully synced
            if (str_contains($response->content, 'success')) {
                $post_sync->synced = true;
                $post_sync->save();
                $message = 'post successfully synced';
            }
            Log::info('Back from server simulation');
            Log::info(json_encode($response));
            return response()->json([
                'status' => $response->status ?? 'error',
                'message' => $message,
                'data' => $this->what_changed,
            ]);
        } catch (Exception $e) {
            Log::error('An error occurred while syncing file to server');
            Log::error($e);
            return response()->json([
                'status' => 'error',
                'message' => $message,
            ]);
        } finally {
            $post_sync->sync_attempts += 1; // increment sync_attempts
            $post_sync->save();
        }
    }
}
