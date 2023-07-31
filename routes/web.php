<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/address', AddressController::class)->name('address.update');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::delete('{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::patch('{product}', [CartController::class, 'updateQuantity'])->name('cart.update');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('{product}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
        Route::delete('{product}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    });

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/make-order', [OrderController::class, 'makeOrder'])->name('order.make');
});

require __DIR__ . '/auth.php';
