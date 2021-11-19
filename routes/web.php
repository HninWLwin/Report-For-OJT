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
//Route::get('posts/{id}', [PostController::class, 'destory'])->name('destory');

Route::post('posts/register_confirm','PostController@postConfirmRegistration')->name('register_confirm');
Route::post('posts/{post}','PostController@update_confirm')->name('update_confirm');
Route::get('file-import-export', [App\Http\Controllers\PostController::class, 'fileImportExport'])->name('import');
Route::post('file-import', [App\Http\Controllers\PostController::class, 'fileImport'])->name('file-import');
Route::get('export', [App\Http\Controllers\PostController::class, 'export'])->name('export');


Route::resource('users', UserController::class);
Route::get('/userlist', 'UserController@index')->name('showUsers');
Route::get('/search-user','UserController@find')->name('search_user');
Route::post('users/confirm_registration','UserController@confirm_registration')->name('confirm_registration');
Route::get('users/{user}/profile','UserController@profile')->name('profile');      
Route::get('users/{user}/change_password','UserController@change_password')->name('change_password');  
Route::post('users/{user}/update_password','UserController@update_password')->name('update_password'); 

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
      return view('admin.postList');
    })->name('dashboard');
  });