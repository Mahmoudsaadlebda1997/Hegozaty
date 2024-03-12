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


Route::get('/', [SiteController::class, 'index'])->name('mainSite');

// Authenticated routes
Route::middleware('web')->group(function () {

    // تسجيل الدخول
    Route::get('loginUser', [SiteController::class, 'showUserLoginForm'])->name('loginUser');
    Route::post('/loginUser', [SiteController::class, 'loginUser']);
    Route::get('/logoutUser', [SiteController::class, 'logoutUser'])->name('logoutUser');
    Route::get('/register', [SiteController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [SiteController::class, 'storeUser']);

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // تسجيل الخروج
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//    غرف الفنادق
    Route::get('/hotel/{hotel}', [SiteController::class, 'showDetails'])->name('hotel.details');
        // عرض الغرف
        Route::get('/rooms/{id}/details', [SiteController::class, 'showRoomDetails'])->name('room.details');
    // Dashboard route (protected by auth middleware)
    Route::middleware(['auth'])->group(function () {
        //        Site Routes
        Route::post('/booking', [SiteController::class, 'storeBooking'])->name('booking.store');
        Route::get('/reservations', [SiteController::class, 'myReservations'])->name('myReservations');
        Route::delete('/reservations/{id}', [SiteController::class, 'destroyReservation'])->name('destroyReservation');
        Route::post('/save-rating', [RateController::class, 'saveRating'])->name('save.rating');

        // Admin routes
        Route::prefix('admin')->group(function () {
            Route::resource('hotels', HotelController::class);
            Route::resource('users', UserController::class);
            Route::resource('rooms', RoomController::class);
            Route::resource('reservations', ReservationController::class);
            Route::patch('/reservations/{id}/update-status', [ReservationController::class, 'updateStatus'])
                ->name('reservations.update-status');
            Route::resource('rates', RateController::class);
            Route::get('/dashboard', [HomeController::class, 'home'])->name('homeDashboard');
        });
    });
});

