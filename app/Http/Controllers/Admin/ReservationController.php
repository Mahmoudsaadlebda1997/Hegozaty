<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='reservations';
        $reservations = Reservation::paginate(5);
        return view('admin.reservations.index', compact('reservations','active'));
    }

    // Display the specified user
    public function show(Reservation $reservation)
    {
        $active ='reservations';
        return view('admin.reservations.show', compact('reservation','active'));
    }
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:done,pending,cancelled',
        ]);

        $reservation->status = $request->input('status');
        $reservation->save();

        return redirect()->route('reservations.show', $reservation->id)->with('success', 'تم تحديث حالة الحجز بنجاح');
    }

    // Remove the specified user from the database
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('services.index')->with('success', 'تم مسح الحجز بنجاح');
    }
}
