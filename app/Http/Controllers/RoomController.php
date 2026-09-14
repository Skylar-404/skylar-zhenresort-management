<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('admin.property', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'building_code' => 'required|string|max:20',
            'room_number'   => 'required|string|max:20',
            'floor_number'  => 'required|integer',
            'room_type'     => 'required|string|max:50',
            'base_rate'     => 'required|numeric|min:0',
            'max_capacity'  => 'required|integer|min:1',
            'status'        => 'required|string',
            'is_smoking'    => 'required|boolean',
        ]);

        Room::create($validated);
        return redirect()->route('admin.property')->with('success', 'Room added successfully.');
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'building_code' => 'required|string|max:20',
            'room_number'   => 'required|string|max:20',
            'floor_number'  => 'required|integer',
            'room_type'     => 'required|string|max:50',
            'base_rate'     => 'required|numeric|min:0',
            'max_capacity'  => 'required|integer|min:1',
            'status'        => 'required|string',
            'is_smoking'    => 'required|boolean',
        ]);

        $room->update($validated);
        return redirect()->route('admin.property')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return redirect()->route('admin.property')->with('success', 'Room deleted successfully.');
    }
}
