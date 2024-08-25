<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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


Route::get('/', [SiteController::class, 'index'])->name('mainSite');

// Authenticated routes
Route::middleware('web')->group(function () {

    // تسجيل الدخول
    Route::get('login', [SiteController::class, 'showUserLoginForm'])->name('loginUser');
    Route::post('login', [SiteController::class, 'loginUser']);

    Route::get('logout', [SiteController::class, 'logoutUser'])->name('logoutUser');

    Route::get('/register', [SiteController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [SiteController::class, 'storeUser']);

    // تسجيل الدخول لمسئول النظام
    Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

    // تسجيل الخروج
    Route::get('/logout', [AuthController::class, 'logout'])->name('logoutUser');

//    المنتجات
    Route::get('/product/{product}', [SiteController::class, 'showDetails'])->name('product.details');
    // عرض الغرف
//        Route::get('/products/{id}/details', [SiteController::class, 'showRoomDetails'])->name('room.details');
//card
    Route::post('/cart/add', [SiteController::class, 'add'])->name('cart.add');
    Route::get('/cart', [SiteController::class, 'indexCart'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [SiteController::class, 'remove'])->name('cart.remove');
    Route::middleware(['auth'])->group(function () {
        // Dashboard route (protected by auth middleware)
        //        Site Routes
        Route::post('/order/create', [SiteController::class, 'createOrder'])->name('order.create');
        Route::get('/orders', [SiteController::class, 'myOrders'])->name('myOrders');
        Route::delete('/orders/{id}', [SiteController::class, 'destroyOrder'])->name('destroyOrder');
        Route::post('/save-rating', [RateController::class, 'saveRating'])->name('save.rating');
        Route::middleware(['auth', 'checkCustomerRole'])->group(function () {

            // Admin routes
            Route::prefix('admin')->group(function () {
                Route::resource('categories', CategoryController::class);
                Route::resource('users', UserController::class);
                Route::resource('products', ProductController::class);
                Route::resource('promoCodes', PromoCodeController::class);
                Route::resource('orders', OrderController::class);
                Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
                Route::resource('rates', RateController::class);
                Route::get('/dashboard', [HomeController::class, 'home'])->name('homeDashboard');
            });
        });
    });
});

