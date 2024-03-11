<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function storeDonor(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'blood_type' => 'required',
            'gender' => 'nullable|string',
            'age' => 'nullable|numeric|gte:18',
            'address' => 'nullable|string',
            'last_donation' => 'required|date|before_or_equal:today',
            'money_donation' => 'required',
        ]);

        Donor::create($data);
        return back()->with('success', 'تم التسجيل بنجاح.');
    }

    public function storeOrder(Request $request)
    {
        $data = $request->validate([
            'blood_type_id' => 'required',
            'branch_id' => 'required',
        ]);

        Order::create($data + [
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);
        return back()->with('success', 'تم ارسال الطلب بنجاح.');
    }


    // عرض صفحة تسجيل الدخول للمريض
    public function showLoginForm()
    {
        return view('site.login');
    }

    // عرض صفحة تسجيل العضوية للمريض
    public function showRegisterForm()
    {
        return view('site.register');
    }

    public function storePatient(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
        ]);
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);
        return redirect()->route('show-login-form')->with('success', 'تم التسجيل بنجاح.');
    }

    public function listOrders()
    {
       $orders = Order::where('user_id',auth()->id())->paginate(5);
       $branches = Branch::all();
       $blood_types = BloodType::where('count','>',0)->get();
       return view('site.orders',compact('orders','blood_types','branches'));
    }

    // Login function
    public function loginPatient(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            return redirect()->intended('/'); // Redirect to the intended URL or a default path
        }

        return back()->withErrors(['email' => 'بيانات خاطئة'])->withInput($request->only('email'));
    }


    public function logoutPatient()
    {
        Auth::logout();
        return redirect('/');
    }


}
