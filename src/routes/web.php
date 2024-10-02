<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\AdminRegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotificationMail;
use App\Models\User;

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
Route::get('/test-mail', function () {
    $user = User::first(); // 既存のユーザーを取得
    if (!$user) {
        return 'ユーザーが見つかりません。';
    }

    try {
        Mail::to($user->email)->send(new UserNotificationMail($user, 'これはテストメールです。'));
        return 'メールが送信されました。';
    } catch (\Exception $e) {
        return 'メール送信中にエラーが発生しました: ' . $e->getMessage();
    }
});

Route::get('/', [ItemController::class, 'index'])->name('index');
Route::get('/items/{id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/sold_products', [UserController::class, 'soldProducts'])->name('mypage.soldProducts');
    Route::get('/mypage/purchased_products', [UserController::class, 'purchasedProducts'])->name('mypage.purchasedProducts');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::post('items/{id}', [ItemController::class, 'update'])->name('item.update');
    Route::post('/items/{id}/like', [LikeController::class, 'like'])->name('item.like');
    Route::get('/liked_items', [LikeController::class, 'likeItems'])->name('liked.items');
    Route::post('/items/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/form/{id}', [CommentController::class, 'showForm'])->name('comments.showForm');
    Route::get('/sell/create', [ItemController::class, 'createSell'])->name('sell.create');
    Route::post('/sell/store', [ItemController::class, 'storeSell'])->name('sell.store');
    Route::get('purchase/create{id}', [ItemController::class, 'createPurchase'])->name('purchase.create');
    Route::post('/purchase/store/{id}', [ItemController::class, 'storePurchase'])->name('purchase.store');
    Route::get('/purchase/address/{id}', [ItemController::class, 'address'])->name('purchase.address');
    Route::post('/purchase/address/{id}', [ItemController::class, 'storeAddress'])->name('purchase.address.different');
    //Route::get('/purchase/payment/{id}', [ItemController::class, 'payment'])->name('purchase.payment');
    //Route::post('/purchase/payment/{id}', [ItemController::class, 'storePayment'])->name('purchase.payment');
});

Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ユーザー管理
    Route::get('/manage_users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // コメント管理
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('admin.comments.destroy'); // コメント削除

    // メール送信フォームの表示
    Route::get('/mail_form/{id}', [AdminController::class, 'showMailForm'])->name('admin.mail_form');

    Route::post('/send_email', [AdminController::class, 'sendEmail'])->name('admin.send_email');
});
