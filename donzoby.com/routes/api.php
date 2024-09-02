<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostSyncController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ixudra\Curl\Facades\Curl;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sync-post', [PostSyncController::class, 'sync']);
Route::post('/update-sync-status', [PostSyncController::class, 'update_sync_status']);
Route::get('/test', function () {
    return [
        'status' => 'testing',
        'message' => 'reached api test endpoint',
    ];
});

Route::put('/posts/sync', [PostController::class, 'sync_post']);
Route::resource('posts', PostController::class);
Route::get('/download-image', function () {
    $response = Curl::to('https://donzoby.com/images/courses/html/dzb_00051_sublime-editor.png')->allowRedirect()->withContentType("image/png")->download('images/courses/xphp/dzb_00051_sublime-editor.png');
    return [
        'status' => 'testing',
        'message' => 'should have downloaded image by now',
    ];
});
