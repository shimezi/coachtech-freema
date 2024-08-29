<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [ItemController::class, 'index'])->name('index');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::post('/items/{id}/like', [LikeController::class, 'likeButton'])->name('item.like');
    Route::post('/items/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/form/{id}', [CommentController::class, 'showForm'])->name('comments.showForm');
});