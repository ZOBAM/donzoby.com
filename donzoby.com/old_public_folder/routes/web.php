<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 Auth::routes(['verify' => true]);

Route::get('/about-donzoby', function () {
    return view('about');
});
Route::get('/mission-&-vision', function () {
    return view('mission-vision');
});
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/comment/{post_id}','CommentController@store')->name('comment')->middleware('verified');
Route::get('/comment/{id}/edit','CommentController@edit')->name('comment_edit');
Route::post('/comment/{id}/update','CommentController@update')->name('comment_update');
Route::get('/comment/{id}/delete','CommentController@destroy')->name('comment_delete');
Route::post('/profile-picture','ProfilePictureController@index')->name('picture');
//the post will save new data plan while get will fetch and edit existing ones
Route::post('/member/data-plan/{create?}/{id?}', 'DataPlanController@store')->middleware('verified');
Route::get('/member/data-plan/{id?}', 'DataPlanController@create')->middleware('verified');
Route::get('/member/{item?}/{action?}', 'MemberController@index')->name('member')->middleware('verified');
//handle all post with this resource controller
Route::resource('/post', 'PostController');
Route::post('/image-upload', 'PictureUploadController@index')->name('image');

Auth::routes();

Route::get('/mobile-usage/service-providers/data-plans/{id?}/{topic?}', 'DataPlanController@index');
Route::get('/{course?}/{subject?}/{id?}/{topic?}', 'CoursesController@index')->name('courses');




