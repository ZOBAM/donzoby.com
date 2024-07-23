<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/local-curl', function () {
    return [
        'status' => 'testing',
        'message' => 'if you saw this, it means that local curl request works',
    ];
});
