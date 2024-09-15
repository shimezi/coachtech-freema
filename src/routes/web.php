<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/items/{id}/like', [LikeController::class, 'likeButton'])->name('item.like');
    Route::post('/items/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/form/{id}', [CommentController::class, 'showForm'])->name('comments.showForm');
    Route::get('/sell/create', [ItemController::class, 'createSell'])->name('sell.create');
    Route::post('/sell/store', [ItemController::class, 'storeSell'])->name('sell.store');
    Route::get('purchase/create{id}', [ItemController::class, 'createPurchase'])->name('purchase.create');
    Route::post('/purchase/store/{id}', [ItemController::class, 'storePurchase'])->name('purchase.store');
    //Route::get('/purchase/address/{id}', [ItemController::class, 'address'])->name('purchase.address');
    //Route::post('/purchase/address/{id}', [ItemController::class, 'storeAddress'])->name('purchase.address.different');
    //Route::get('/purchase/payment/{id}', [ItemController::class, 'payment'])->name('purchase.payment');
    //Route::post('/purchase/payment/{id}', [ItemController::class, 'storePayment'])->name('purchase.payment');
});