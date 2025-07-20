<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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
Route::get('/', [ProductController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/item/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/item/{id}/comment', [CommentController::class, 'store']);

Route::middleware('auth')->group(function () {
  Route::get('/mypage', [ProductController::class, 'index']);
  Route::get('/sell', [ProductController::class, 'create'])->name('products.create');
  Route::post('/sell', [ProductController::class, 'store'])->name('products.store');
});