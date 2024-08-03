<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='promoCodes';
        $promoCodes = PromoCode::paginate(5);
        return view('admin.promoCodes.index', compact('promoCodes','active'));
    }

    // Show the form for creating a new user
    public function create()
    {
        $active ='promoCodes';
        return view('admin.promoCodes.create',compact('active'));
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'code' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount_percentage' => 'required',
        ]);

        PromoCode::create($request->all());
        return redirect()->route('promoCodes.index')->with('success', 'تم عمل كود الخصم بنجاح');
    }

    // Display the specified user
    public function show(PromoCode $promoCode)
    {
        $active ='promoCodes';
        return view('admin.promoCodes.show', compact('promoCode','active'));
    }

    // Show the form for editing the specified user
    public function edit(PromoCode $promoCode)
    {
        $active = 'promoCodes';
        return view('admin.promoCodes.edit', compact('promoCode','active'));
    }

    // Update the specified user in the database
    public function update(Request $request, PromoCode $promoCode)
    {
        // Validate the request data (add validation rules as needed)
        $request->validate([
            'code' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount_percentage' => 'required',
        ]);
        // Update user fields
        $promoCode->code = $request->code;
        $promoCode->start_date = $request->start_date;
        $promoCode->end_date = $request->end_date;
        $promoCode->discount_percentage = $request->discount_percentage;

        $promoCode->save();
        return redirect()->route('promoCodes.index')->with('success', 'تم تعديل كود الخصم بنجاح');
    }

    // Remove the specified user from the database
    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        return redirect()->route('promoCodes.index')->with('success', 'تم مسح كود الخصم بنجاح');
    }
}
