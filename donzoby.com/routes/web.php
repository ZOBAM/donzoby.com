<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPictureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('dzb');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// resource links

Route::middleware(['auth'])->group(function(){
    Route::resources([
    'posts'=> PostController::class,
    'courses'=> CourseController::class,
    'subjects'=> SubjectController::class,
]);
});
Route::post('/image-upload', [PostPictureController::class,'index'])->name('post-image');

// auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user-area', [UserController::class,'index'])->middleware('verified')->name('user-area');

require __DIR__.'/auth.php';


Route::get('/{course?}/{subject?}/{id?}/{topic?}', [HomePageController::class,'index'])->name('courses');
