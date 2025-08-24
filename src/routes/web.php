<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AddressController;

/*
|--------------------------------------------------
| Web Routes
|--------------------------------------------------
| 商品一覧や購入など、ユーザーがブラウザでアクセスするルートを定義します。コントローラーとの紐付けや、ビューの表示処理をここに記述します。
*/

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/profile', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/item/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
  Route::get('/?tab=mylist', [ProductController::class, 'index'])->name('products.index');

  Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
  Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
// マイページ
  Route::get('/mypage', [ProfileController::class, 'mypage'])->name('mypage');
  Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');

  // 商品購入画面
  Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
  Route::post('/sell', [ProductController::class, 'store'])->name('products.store');

  Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
  Route::post('/purchase/{id}', [PurchaseController::class, 'submit'])->name('purchase.submit');
  Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'edit'])->name('address.edit');
  Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'update'])->name('address.update');


  // Route::post('/mypage/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
  // Route::get('/mypage/selling', [ProductController::class, 'selling'])->name('user.products.selling');

  Route::post('/products/{product}/like', [LikeController::class, 'store'])->name('products.like');
  Route::delete('/products/{product}/like', [LikeController::class, 'destroy'])->name('products.unlike');

  // コメント投稿のルート
  Route::post('/item/{product}/comment', [CommentController::class, 'store'])->name('comments.store');









  Route::post('/purchase/{id}/update', [PurchaseController::class, 'update'])->name('purchase.update');


});