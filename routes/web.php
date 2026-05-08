<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

// 認証
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// 商品一覧・詳細（未ログインでも閲覧可）
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// お問い合わせ
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// 認証必須
Route::middleware('auth')->group(function () {
    // お気に入り
    Route::post('/products/{id}/like', [ProductController::class, 'like'])->name('products.like');

    // 購入
    Route::get('/products/{id}/purchase', [PurchaseController::class, 'show'])->name('products.purchase');
    Route::post('/products/{id}/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

    // マイページ
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/products/create', [MyPageController::class, 'create'])->name('mypage.products.create');
    Route::post('/mypage/products', [MyPageController::class, 'store'])->name('mypage.products.store');
    Route::get('/mypage/products/{id}', [MyPageController::class, 'showProduct'])->name('mypage.products.show');
    Route::delete('/mypage/products/{id}', [MyPageController::class, 'destroyProduct'])->name('mypage.products.destroy');
    Route::get('/mypage/products/{id}/edit', [MyPageController::class, 'editProduct'])->name('mypage.products.edit');
    Route::put('/mypage/products/{id}', [MyPageController::class, 'updateProduct'])->name('mypage.products.update');

    // アカウント編集
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
});
