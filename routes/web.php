<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Untuk user
Route::get('/posts', 'PostController@index');
Route::get('/posts/{id}', 'PostController@show');

// Untuk admin dengan autentikasi
Route::middleware('auth:api')->group(function () {
    Route::post('/admin/posts', 'AdminPostController@store');
    Route::put('/admin/posts/{id}', 'AdminPostController@update');
    Route::delete('/admin/posts/{id}', 'AdminPostController@destroy');
});

