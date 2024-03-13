<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\Reservation;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Paginator::useBootstrap(); // For Bootstrap 5

        // Register a callback to run when the application is booted
        $this->app->booted(function () {
            // Get reservations where check_out is today
            $reservations = Reservation::whereDate('check_out', Carbon::today())->get();

            // Loop through each reservation and increment available_count for associated rooms
            foreach ($reservations as $reservation) {
                $room = $reservation->room;
                if ($room) {
                    $room->increment('available_count');
                }
            }
        });
    }
}
