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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Ixudra\Curl\Facades\Curl;

Route::get('/repop', function () {
    $existing_images = [
        'gimp_crop_image.jpg',
        'gimp_crop_image3.jpg',
        'gimp_crop_image2.jpg',
    ];

    $image_name = 'gimp_crop_image.jpg';
    $iteration_count = 0;
    while (in_array($image_name, $existing_images)) {
        $name_array = explode('.', $image_name);
        $name = $name_array[0];
        $last_index = strlen($name) - 1;
        $number_count = 0;
        while (is_numeric($name[$last_index])) {
            $number_count++;
            $last_index--;
        }
        if (!$number_count) {
            Log::info("------------No number found-------------");
            $extracted_number = null;
            $new_image_name = $name_array[0] . '1.' . $name_array[1];
        } else {
            $extracted_number = (int) substr($name, -$number_count);
            $new_image_name = str_replace($extracted_number, $extracted_number + 1, $image_name);
        }

        $image_name = $new_image_name;
        $iteration_count++;
        Log::info("Count::$iteration_count::Image Name=>$image_name");
    }


    return [
        'image_name' => $image_name,
        'name' => $name,
        'number_count' => $number_count,
        'numbers' => $extracted_number,
        'new_name' => $new_image_name,
    ];
    /* $verified_users = Old_user::where('email_verified_at', '!=', null)->get();
    foreach ($verified_users as $user) {
        User::create($user->toArray());
    }
    return User::get(); */
});

Route::get('/dashboard', function () {
    return redirect('/user-area');
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
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'admin/users' => AdminUserController::class,
    ]);
});
Route::middleware(['auth'])->group(function () {
    Route::resources([
        'comments' => CommentController::class,
    ]);
});

Route::resource('posts', PostController::class)->middleware(['auth', 'can:create posts']);

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


Route::get('/curl', function () {
    try {
        $response = Curl::to('https://api.beezlinq.com/api/v1/get/countries')
            ->asJsonResponse()->returnResponseObject();
        $response = $response->get();
        return $response;
    } catch (Exception $e) {
        Log::error($e);
        $response = [
            'status' => 'error',
            'message' => 'endpoint call failed'
        ];
    } finally {
        Log::info('back from endpoint');
    }
});

Route::get('/{course?}/{subject?}/{id?}/{slug?}', [HomePageController::class, 'index'])->name('courses');
