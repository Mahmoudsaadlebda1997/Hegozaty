<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::paginate(1);
        $active = 'hotels';

        return view('admin.hotels.index', compact('hotels', 'active'));
    }

    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        $active = 'hotels';

        return view('admin.hotels.show', compact('hotel', 'active'));
    }

    public function create()
    {
        $active = 'hotels';

        return view('admin.hotels.create', compact('active'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust mime types and max size as needed
            'rating' => 'nullable|integer',
            'phone' => 'required',
            'phone2' => 'nullable',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('hotel_images', 'public');

        Hotel::create(array_merge($request->except('image'), ['image' => $imagePath]));

        return redirect()->route('hotels.index')
            ->with('success', 'تم اضافه الفندق بنجاح');
    }


    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $active = 'hotels';

        return view('admin.hotels.edit', compact('hotel', 'active'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:hotels,name,' . $id . '|max:255',
            'location' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust mime types and max size as needed
            'rating' => 'nullable|integer',
            'phone' => 'required',
            'phone2' => 'nullable',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $hotel = Hotel::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotel_images', 'public');
            $hotel->image = $imagePath;
        }

        $hotel->update($request->except('image'));

        return redirect()->route('hotels.index')
            ->with('success', 'تم تعديل الفندق بنجاح');
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        if ($hotel->rooms->count() > 0) {
            $hotel->rooms()->delete();
            $hotel->rooms()->resevervations()->delete();
        }
        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'تم مسح الغندق بنجاح.');
    }
}
