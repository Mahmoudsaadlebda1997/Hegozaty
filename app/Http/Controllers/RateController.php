<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        // Get all rates
        $rates = Rate::all();
        $active = 'rates';
        // Return the view with rates data
        return view('admin.rates.index', compact('rates','active'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Rate $rate)
    {
        // Delete the rate
        $rate->delete();

        // Redirect back with a success message
        return redirect()->route('rates.index')->with('success', 'تم مسح التقييم.');
    }
    public function saveRating(Request $request)
    {
        // Validate the request
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
            'hotelId' => 'required|exists:hotels,id',
            'userId' => 'required|exists:users,id',
        ]);

        Rate::create([
            'user_id' => $request->userId,
            'hotel_id' => $request->hotelId,
            'rate' => $request->rating,
            'comment' => $request->comment
        ]);
        // Fetch all ratings for the hotel
        $rates = Rate::where('hotel_id', $request->hotelId)->get();

        // Calculate the average rating
        $averageRating = $rates->avg('rate');

        // Find the hotel by ID
        $hotel = Hotel::findOrFail($request->hotelId);

        // Update the hotel's rating
        $hotel->rating = $averageRating;

        // Save the changes to the database
        $hotel->save();

        // Return the new rating
        return response()->json(['message' => 'تم التقييم بنجاح.']);
    }
}
