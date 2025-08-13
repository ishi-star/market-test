<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ProductController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');



Route::get('/item/{id}', [ProductController::class, 'show'])->name('products.show');
// Route::post('/item/{id}/comment', [CommentController::class, 'store']);

Route::middleware('auth')->group(function () {
  Route::get('/', [ProductController::class, 'index'])->name('products.index');
  
  Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
  Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
  Route::get('/mypage', [ProfileController::class, 'index'])->name('profile.index');

  Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
  Route::post('/sell', [ProductController::class, 'store'])->name('products.store');

  Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
  Route::post('/purchase/{id}', [PurchaseController::class, 'submit'])->name('purchase.submit');
  Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'edit'])->name('address.edit');
  Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'update'])->name('address.update');

  // Route::get('/user/address/edit', [UserController::class, 'editAddress'])->name('user.address.edit');

  Route::get('/mypage/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
  Route::post('/mypage/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
  Route::get('/mypage/selling', [ProductController::class, 'selling'])->name('user.products.selling');

  Route::post('/products/{product}/like', [LikeController::class, 'store'])->name('products.like');
  Route::delete('/products/{product}/like', [LikeController::class, 'destroy'])->name('products.unlike');

});