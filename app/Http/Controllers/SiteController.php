<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reservation;
use App\Models\User;
use App\Rules\SiteTypeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $reservations = auth()->user()->reservations()->paginate(5);
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
            return response()->json(['message' => 'يرجى تسجيل الدخول لإتمام عملية الحجز.'], 401);
        }

        // Validate request data
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'nullable|date|after_or_equal:today',
        ]);

        $service = Service::findOrFail($validatedData['service_id']);

        if ($service->service_type === 'branch') {
            if (!$validatedData['reservation_date']) {
                return response()->json(['message' => 'يرجى اختيار يوم للحجز في الفرع.'], 422);
            }

            $reservationDate = $validatedData['reservation_date'];

            // Start at 9:00 AM
            $startTime = Carbon::createFromFormat('Y-m-d H:i', $reservationDate . ' 09:00');

            // Define closing time at 2:00 PM
            $closingTime = Carbon::createFromFormat('Y-m-d H:i', $reservationDate . ' 14:00');

            // Get existing reservations for the selected day
            $existingReservations = Reservation::whereDate('reservation_time', $reservationDate)
                ->orderBy('reservation_time', 'asc')
                ->get();

            if ($existingReservations->isNotEmpty()) {
                // Next available time slot in 15-minute increments
                $lastReservation = $existingReservations->last();
                $nextAvailableTime = Carbon::parse($lastReservation->reservation_time)->addMinutes(15);
            } else {
                // Start at 9:00 AM if no reservations exist
                $nextAvailableTime = $startTime;
            }

            // ✅ Block if the next available time exceeds 2:00 PM
            if ($nextAvailableTime->greaterThan($closingTime)) {
                return response()->json(['message' => '❌ لا توجد مواعيد متاحة بعد الساعة 2:00 مساءً.'], 422);
            }

            $reservationTime = $nextAvailableTime->format('Y-m-d H:i:s');
        } else {
            // For phone_banking services, no specific reservation time
            $reservationTime = null;
        }

        // ✅ Create the reservation
        $reservation = Reservation::create([
            'reservation_time' => $reservationTime,
            'status' => 'pending',
            'user_id' => $user->id,
            'service_id' => $validatedData['service_id'],
        ]);

        return response()->json(['message' => '✅ تم إرسال الحجز بنجاح!']);
    }






}
