<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\SearchController;
use Illuminate\Support\Facades\Auth;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    Auth::routes();

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::group(['prefix' => 'product'], function () {
        Route::get('/{name}', [ProductController::class, 'index'])->name('product.details');
    });

    Route::get('cart', [CartController::class, 'index'])->name('cart.store');
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    // Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('invoice/{id}', [CheckoutController::class, 'invoice'])->name('invoice');

    Route::get('category/{name}', [CategoryController::class, 'index'])->name('category.index');

    Route::get('search/{search}', [SearchController::class, 'search'])->name('search');

    Route::get('shop', [HomeController::class, 'shop'])->name('shop.index');
});
