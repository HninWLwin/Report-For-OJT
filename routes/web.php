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
Route::get('/register', function () {
    return view('auth.register');
});

Auth::routes();

Route::resource('posts', PostController::class);
Route::get('/postList', [App\Http\Controllers\PostController::class, 'index'])->name('postList');
Route::get('/search_post','PostController@find')->name('search_post');
Route::get('posts/{id}', [PostController::class, 'destory'])->name('destory');

Route::resource('users', UserController::class);
Route::get('/userlist', 'UserController@index')->name('showUsers');
Route::get('/search-user','UserController@find')->name('search_user');
//Route::get('users/{id}', [UserController::class, 'destory'])->name('destory');
Route::post('/confirm','UserController@confirm_registration')->name('confirm_registration');
