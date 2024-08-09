<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TagsController;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
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


Route::post('/login', [AuthenticationController::class, 'login']);

// Untuk user
Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/{id}', [PostController::class,'show']);

// Untuk admin dengan autentikasi
Route::middleware('auth:sanctum')->group(function () {

Route::resource('services',ServicesController::class);
Route::post('services/{id}/restore', [ServicesController::class, 'restore'])->name('services.restore');
Route::delete('services/{id}/forceDelete', [ServicesController::class, 'forceDelete'])->name('services.forceDelete');

Route::resource('posts',AdminPostController::class);
Route::post('posts/{id}/restore', [AdminPostController::class, 'restore'])->name('posts.restore');
Route::delete('posts/{id}/forceDelete', [AdminPostController::class, 'forceDelete'])->name('posts.forceDelete');


Route::get('categories', [CategoriesController::class, 'index']);
Route::get('categories/{id}', [CategoriesController::class, 'show']);
Route::post('categories', [CategoriesController::class, 'store']);
Route::put('categories/{id}', [CategoriesController::class, 'update']);

Route::get('tags', [TagsController::class, 'index']);
Route::get('tags/{id}', [TagsController::class, 'show']);
Route::post('tags', [TagsController::class, 'store']);
Route::put('tags/{id}', [TagsController::class, 'update']);

});







