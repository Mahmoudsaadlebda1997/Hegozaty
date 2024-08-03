<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(5);
        $active = 'products';
        return view('admin.products.index', compact('rooms', 'active'));
    }

    public function create()
    {
        $active = 'products';
        $hotels = Hotel::all();
        return view('admin.products.create', compact('active', 'hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
            'available_count' => 'required|numeric',
            'area' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,mov,flv,mkv,avi,mp4,svg,bmp|max:10000', // Adjust mime types and max size as needed
            'type.*' => 'nullable|in:image,video',
        ]);

        // Create Room
        $room = Room::create($request->all());

        $room = Room::findOrFail($room->id);

        foreach ($request->file('images') as $index => $file) {
            if ($file) {
                $imagePath = $file->store('room_media', 'public');

                $roomMedia = new RoomMedia([
                    'image' => $imagePath,
                    'type' => $request->input('type'),
                ]);

                $room->media()->save($roomMedia);
            }
        }

        return redirect()->route('products.index')->with('success', 'تم اضافه الغرفه');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        $active = 'products';
        return view('admin.products.show', compact('room', 'active'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        $active = 'products';
        $hotels = Hotel::all();
        return view('admin.products.edit', compact('room', 'active', 'hotels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
            'available_count' => 'required|numeric',
            'area' => 'required',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif,mov,flv,mkv,avi,mp4,svg,bmp|max:10000', // Adjust mime types and max size as needed
            'type.*' => 'nullable|in:image,video',
            'hotel_id' => 'required|exists:hotels,id'
        ]);

        $room = Room::findOrFail($id);

        // Retrieve the current image path
        $oldImagePath = $room->image;

        // Update room details
        $room->update($request->except('image', 'type'));
        if ($request->has('images')) {
            foreach ($request->file('images') as $index => $file) {
                if ($file) {
                    // Store the new image
                    $newImagePath = $file->store('room_media', 'public');

                    // Update room's image path
                    $room->image = $newImagePath;

                    $roomMedia = new RoomMedia([
                        'image' => $newImagePath,
                        'type' => $request->input('type'),
                    ]);

                    $room->media()->save($roomMedia);

                    // Delete the old image if it exists and is different from the new one
                    if ($oldImagePath && $oldImagePath !== $newImagePath) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'تم تعديل الغرفة');
    }


    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        // Delete associated Room Media if any
        RoomMedia::where('room_id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'تم مسخ الغرفه');
    }
}
