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
        $reservations = Reservation::paginate(10);
        return view('admin.reservations.index', compact('reservations','active'));
    }

    // Display the specified user
    public function show(Reservation $reservation)
    {
        $active ='reservations';
        return view('admin.reservations.show', compact('reservation','active'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:done,pending,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id); // Find by ID
        $reservation->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة الحجز بنجاح');
    }

    // Remove the specified user from the database
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'تم مسح الحجز بنجاح');
    }
}
