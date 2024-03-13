<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $active = 'reservations';
        // Retrieve all reservations
        $reservations = Reservation::paginate(5);
        return view('admin.reservations.index', compact('reservations','active'));
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:accepted,cancelled', // Add more status types as needed
        ]);

        $reservation = Reservation::findOrFail($id);

        // Validate the request if needed

        $oldStatus = $reservation->status;
        $newStatus = $request->status;

        // Update the reservation status
        $reservation->update(['status' => $newStatus]);

        // If the new status is 'accepted' and the old status was not 'accepted'
        if ($newStatus === 'accepted' && $oldStatus !== 'accepted') {
            // Decrease the available_count for the associated room by 1
            $room = $reservation->room;
            $room->decrement('available_count');
        }

        return redirect()->back()->with('success', 'تم تحديث حالة الحجز بنجاح.');
    }
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        $reservation->room()->increment('available_count');

        return redirect()->route('reservations.index')->with('success', 'تم حذف الحجز بنجاح.');
    }
}
