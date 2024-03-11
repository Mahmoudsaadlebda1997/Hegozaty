<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
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

Route::get('/', [SiteController::class, 'mainSite'])->name('mainSite');

// Authenticated routes
Route::middleware('web')->group(function () {
//Route::resource('rates', RateController::class);
    // تسجيل الدخول
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // تسجيل الخروج
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard route (protected by auth middleware)
    Route::middleware(['auth'])->group(function () {
        // Admin routes
        Route::prefix('admin')->group(function () {
            Route::resource('hotels', HotelController::class);
            Route::resource('users', UserController::class);
            Route::resource('rates', RateController::class);
            Route::resource('rooms', RoomController::class);
            Route::resource('reservations', ReservationController::class);
            Route::resource('rates', RateController::class);
            Route::get('/dashboard', [HomeController::class, 'home'])->name('homeDashboard');
        });
    });
});

