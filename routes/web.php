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

Route::get('/postList', [App\Http\Controllers\PostController::class, 'index'])->name('postList');

Route::resource('posts', PostController::class);

Route::get('/create_user','UserController@create')->name('create_user');

Route::get('posts/{id}', [PostController::class, 'destory'])->name('destory');

//Route::post('/postRegistration', 'PostController@store')->name('create_post');

//Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
