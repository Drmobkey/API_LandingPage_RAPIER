<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;

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
Route::get('/posts', [PostController::class,'index']);
Route::get('/posts/{id}', [PostController::class,'show']);

// Untuk admin dengan autentikasi
Route::middleware('auth:api')->group(function () {
    Route::post('/admin/posts', [AdminPostController::class,'store']);
    Route::put('/admin/posts/{id}', [AdminPostController::class,'update']);
    Route::delete('/admin/posts/{id}', [AdminPostController::class,'destroy']);
});
