<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Test_post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostSyncController extends Controller
{
    public function sync(Request $request)
    {
        try {
            // Log::info('Received data::' . json_encode($request->all()));
            $post = Test_post::where('id',$request->id)->first();
            // if post with specified id does not exist yet, add dummy (unpublished) posts till $id
            $id = $request->id;
            while()
            // update the post
            // $post->update($request->toArray());

            if ($request->has('added_images')) {
                var_dump($request->added_images);
                Log::info('Added images::' . json_encode($request->added_images));
            }
            // process uploaded images
            // ****For some reason (the curl loop for adding multiple images modifies the added_images array into a string containing only one image)
            // ****Down the line, I will need to find a fix for that but for now, the below works
            foreach ($request->file() as $image) {
                Log::info('+++++++++++++++++++IMAGE FILE FOUND+++++++++++++++++++');
                $image->move("images/courses/xphp/{$post->subject->slug}", $image->getClientOriginalName());
                // add to post images
                $post->post_images()->create(['link' => "images/courses/{$post->subject->slug}/{$image->getClientOriginalName()}"]);
            }
            // delete images if there are removed_images
            if ($request->has('removed_images')) {
                var_dump($request->removed_images);
                Log::info('Removed images::' . json_encode($request->removed_images));
                /* foreach($request->removed_images as $image)
                if (file_exists($image)) {
                    Log::info('found image file and about to delete:::' . $image);
                    unlink($image);
                } */
            }
            return [
                'status' => 'success',
                'message' => 'post successfully synced',
            ];
        } catch (Exception $e) {
            Log::error('An error occurred while syncing post.');
            Log::error($e);
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while syncing post.',
            ]);
        }
    }
}
