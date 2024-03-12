<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
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
