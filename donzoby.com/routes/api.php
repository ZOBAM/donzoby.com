<?php

use App\Http\Controllers\PostSyncController;
use App\Models\Test_post;
use App\Models\Test_post_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sync-post', [PostSyncController::class, 'sync']);
Route::get('/test', function () {
    return [
        'status' => 'testing',
        'message' => 'reached api test endpoint',
    ];
});
