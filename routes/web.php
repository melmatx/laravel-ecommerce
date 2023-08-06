<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('browse');
});

Route::get('/browse', [HomeController::class, 'browse'])->name('browse');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');

Route::resource('product', ProductController::class);
Route::resource('category', CategoryController::class);
Route::resource('review', ReviewController::class);

Route::get('/search/products', [SearchController::class, 'searchProducts'])->name('search.products');
Route::get('/search/categories', [SearchController::class, 'searchCategories'])->name('search.categories');

Route::middleware('auth')->group(function () {
    Route::post('/address', AddressController::class)->name('address.update');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('{product}', 'addToCart')->name('cart.add');
        Route::delete('{product}', 'removeFromCart')->name('cart.remove');
        Route::patch('{product}', 'updateQuantity')->name('cart.update');
        Route::get('clear', 'clearCart')->name('cart.clear');
        Route::get('checkout', 'checkout')->name('cart.checkout');
    });

    Route::prefix('wishlist')->controller(WishlistController::class)->group(function () {
        Route::get('/', 'index')->name('wishlist.index');
        Route::post('{product}', 'addToWishlist')->name('wishlist.add');
        Route::delete('{product}', 'removeFromWishlist')->name('wishlist.remove');
    });

    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('order.index');
        Route::get('make', 'makeOrder')->name('order.make');
        Route::patch('{order}', 'updateStatus')->name('order.update');
    });
});

require __DIR__ . '/auth.php';
