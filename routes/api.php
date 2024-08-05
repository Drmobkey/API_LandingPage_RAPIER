<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
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
