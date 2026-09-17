<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount([
            'reservations as active_reservations_count' => function ($query) {
                $query->where('status', 'CHECKED_IN');
            },
            'maintenanceTickets as active_repairs_count' => function ($query) {
                $query->whereIn('status', ['PENDING', 'IN_PROGRESS']);
            }
        ])->orderBy('room_number')->get();

        // Operational Aggregates
        $totalRooms     = $rooms->count();
        $availableRooms = $rooms->where('status', 'AVAILABLE')->count();
        $occupiedRooms  = $rooms->where('status', 'OCCUPIED')->count();
        $dirtyRooms     = $rooms->where('status', 'DIRTY')->count();
        $maintenanceRooms = $rooms->where('status', 'MAINTENANCE')->count();

        return view('admin.property', compact(
            'rooms',
            'totalRooms',
            'availableRooms',
            'occupiedRooms',
            'dirtyRooms',
            'maintenanceRooms'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number'     => 'required|string|max:32|unique:room,room_number',
            'room_type'       => 'required|string|max:64',
            'capacity'        => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'status'          => 'required|in:AVAILABLE,OCCUPIED,DIRTY,MAINTENANCE',
            'description'     => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->route('admin.property')->with('success', 'Villa/Room created successfully.');
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'room_number'     => ['required', 'string', 'max:32', Rule::unique('room')->ignore($room->id)],
            'room_type'       => 'required|string|max:64',
            'capacity'        => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'status'          => 'required|in:AVAILABLE,OCCUPIED,DIRTY,MAINTENANCE',
            'description'     => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()->route('admin.property')->with('success', 'Room details updated.');
    }

    public function updateStatus(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:AVAILABLE,OCCUPIED,DIRTY,MAINTENANCE',
        ]);

        $room->update(['status' => $validated['status']]);

        return back()->with('success', "Room {$room->room_number} status updated to {$validated['status']}.");
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Guard against deleting occupied rooms
        if ($room->status === 'OCCUPIED') {
            return back()->with('error', 'Cannot delete an occupied room.');
        }

        $room->delete();

        return redirect()->route('admin.property')->with('success', 'Room deleted.');
    }
}
