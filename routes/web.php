<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ui 
Route::get('/', [HomeController::class, 'index']);

Route::get('/post/{id}/details', [HomeController::class, 'details']);
// comments
Route::resource('comment', CommentController::class);
// like 
Route::post('like', [LikeController::class, 'like']);
Route::post('unlike', [LikeController::class, 'unlike']);

Route::get('/searchByCategory/{id}', [HomeController::class, 'searchByCategory']);

# Authentication
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index']);
    // ======= Post =================================
    Route::resource('/posts', PostController::class);
    Route::post('/posts/{id}', [PostController::class, 'postUpdate']);

    // ======= Category =================================
    Route::get('/categories', [PostController::class, 'category']);
    Route::post('/category', [PostController::class, 'categoryStore']);
    Route::get('/category/create', [PostController::class, 'categoryCreate']);
    Route::get('/category/{id}/edit', [PostController::class, 'categoryEdit']);
    Route::post('/category/{id}/update', [PostController::class, 'categoryUpdate']);
    Route::post('/category/{id}/delete', [PostController::class, 'categoryDelete']);
});