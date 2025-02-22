<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reservation;
use App\Models\User;
use App\Rules\SiteTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('site.home', compact('services'));
    }

    // عرض صفحة تسجيل الدخول المستخدم
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
//        dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended(route('mainSite'))->with('success', 'تم تسجيل الدخول بنجاح');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'بيانات خاطئة'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/loginUser')->with('success', 'تم تسجيل الخروج بنجاح');
    }

    // عرض صفحة تسجيل الدخول للمستخدم
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
            'phone_number' => 'required|string|unique:users,phone_number',
            'role' => 'required',
        ]);
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
        ]);
        return redirect()->route('mainSite')->with('success', 'تم تسجيل العضوية بنجاح.');
    }

    public function showDetails(Service $service)
    {
        return view('site.details', compact('service'));
    }




    public function myReservations()
    {
        $reservations = auth()->user()->orders()->paginate(5);
        return view('site.reservations', compact('reservations'));
    }

    public function destroyReservation($id)
    {
        $reservation = Reservation::find($id);

        // Check if the reservation belongs to the authenticated user
        if (auth()->user()->id === $reservation->user_id) {
            $reservation->delete();
        }

        return redirect()->route('myOrders')->with('success', 'تم الغاء الحجز');
    }

    public function createReservation(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'يرجي تسجيل الدخول لاتمام عمليه الحجز.']);
        }

        // Validate request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_time' => 'required|date|after:now', // Ensure future date
        ]);

        // Create the reservation
        $reservation = Reservation::create([
            'reservation_time' => $validatedData['reservation_time'],
            'status' => 'pending',
            'user_id' => $user->id,
            'service_id' => $validatedData['service_id'],
        ]);

        return redirect()->route('reservations.index')->with('success', 'تم عمل الحجز بنجاح.');
    }

}
