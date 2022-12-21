<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    $arr = [1, 1, 0, 1, 1, 0, 0];
    //check if the first and second element are different
    //keep tab of subsequent element and check if they are different
    function getReverse($arr)
    {
        $reversCount = 0;
        if ($arr[0] == $arr[1]) {
            if ($arr[0] == 0) {
                $arr[1] = 1;
            }
            $arr[0] = 0;
            $reversCount++;
        }
        for ($i = 2; $i < count($arr); $i++) {
            if ($arr[$i] == $arr[$i - 1]) {
                $arr[$i] = $arr[$i] == 0 ? 1 : 0;
                $reversCount++;
            }
        }
        return $reversCount;
    }
    return getReverse($arr);
});
