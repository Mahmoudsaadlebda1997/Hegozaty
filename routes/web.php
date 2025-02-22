<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReservationController;
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
    Route::get('/services/{service}', [SiteController::class, 'showDetails'])->name('service.details');
    // عرض الغرف
    Route::middleware(['auth'])->group(function () {
        // Dashboard route (protected by auth middleware)
        //        Site Routes
        Route::post('/reservation/create', [SiteController::class, 'createReservation'])->name('reservation.create');
        Route::get('/reservations', [SiteController::class, 'myReservations'])->name('myReservations');
        Route::delete('/reservations/{id}', [SiteController::class, 'destroyReservation'])->name('destroyReservation');
        Route::middleware(['auth', 'checkCustomerRole'])->group(function () {

            // Admin routes
            Route::prefix('admin')->group(function () {
                Route::resource('services', ServiceController::class);
                Route::resource('users', UserController::class);
                Route::resource('reservations', ReservationController::class);
                Route::patch('/reservations/{id}/update-status', [ReservationController::class, 'updateStatus'])
                    ->name('reservations.update-status');
                Route::get('/dashboard', [HomeController::class, 'home'])->name('homeDashboard');
            });
        });
    });
});

