<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Rate;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Rules\SiteTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        return view('site.home',compact('hotels'));
    }

    // عرض صفحة تسجيل الدخول للمريض
    public function showUserLoginForm()
    {
        return view('site.login');
    }

    // Login function
    public function loginUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email', new SiteTypeEmail],
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended(route('mainSite'));
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/loginUser');
    }
    // عرض صفحة تسجيل الدخول للمريض
    public function showRegistrationForm()
    {
        return view('site.register');
    }
    public function storeUser(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'role' => 'required',
        ]);
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'role' => $request->input('role'),
        ]);
        return redirect()->route('mainSite')->with('success', 'تم التسجيل بنجاح.');
    }
    public function showDetails(Hotel $hotel)
    {
        $rates = Rate::where('hotel_id',$hotel->id)->get();
        return view('site.rooms', compact('hotel','rates'));
    }

    public function storeBooking(Request $request)
    {
        // Validate the form data
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'payment_status' => 'required|in:visa', // Adjust as needed
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id', // Adjust as needed
        ]);

        // Create a new booking
        $reservation = new Reservation([
            'check_in' => $request->input('check_in'),
            'check_out' => $request->input('check_out'),
            'payment_status' => $request->input('payment_status'),
            'user_id' => $request->input('user_id'),
            'room_id' => $request->input('room_id'),
        ]);

        // Save the booking to the database
        $reservation->save();

        // You can also return a response if needed
        return response()->json(['message' => 'تم الحجز بنجاح'], 200);
    }
    public function showRoomDetails($id)
    {
        $room = Room::findOrFail($id);

        return view('site.details', compact('room'));
    }
    public function myReservations()
    {
        $reservations = auth()->user()->reservations;
        return view('site.reservations', compact('reservations'));
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::find($id);

        // Check if the reservation belongs to the authenticated user
        if (auth()->user()->id === $reservation->user_id) {
            $reservation->delete();
        }

        return redirect()->route('myReservations');
    }

}
