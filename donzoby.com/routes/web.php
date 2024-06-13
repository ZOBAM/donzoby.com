<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPictureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Old_user;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/repop', function () {
    $verified_users = Old_user::where('email_verified_at', '!=', null)->get();
    foreach ($verified_users as $user) {
        User::create($user->toArray());
    }
    return User::get();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about-donzoby', function () {
    return view('about');
});
Route::get('/mission-&-vision', function () {
    return view('mission-vision');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
// resource links
Route::middleware(['auth', 'can:create users'])->group(function () {
    Route::resources([
        // 'posts' => PostController::class,
        'courses' => CourseController::class,
        'subjects' => SubjectController::class,
        'comments' => CommentController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'admin/users' => AdminUserController::class,
    ]);
});
Route::resource('posts', PostController::class)->middleware(['can:create posts']);

Route::post('/image-upload', [PostPictureController::class, 'index'])->name('post-image');

// profile
Route::post('/assign-role', [PostPictureController::class, 'assign_role']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user-area', [UserController::class, 'index'])->middleware('verified')->name('user-area');

require __DIR__ . '/auth.php';

// clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/{course?}/{subject?}/{id?}/{slug?}', [HomePageController::class, 'index'])->name('courses');
