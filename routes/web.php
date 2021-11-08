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
    return view('postlist');
});
Route::get('/register', function () {
    return view('auth.register');
});

//Route::post('/registerUser', 'Auth\RegisterController@create');
//Route::post('/loginUser', 'Auth\LoginController@login');

Auth::routes();

Route::get('/postList', [App\Http\Controllers\PostListController::class, 'index'])->name('postList');

Route::resource('posts', PostController::class);

Route::get('/create_user','UserController@create')->name('create_user');

//Route::get('/create', [App\Http\Controllers\PostController::class, 'create'])->name('create');

//Route::post('posts/create', 'PostController@store');
//Route::post('posts', 'PostController@index');

//Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
