<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Guest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Fetch reservations with related records to avoid N+1 queries
        $reservations = Reservation::with(['guest', 'room', 'creator'])
            ->latest('check_in_date')
            ->get();

        // 2. Auxiliary data needed for creation / filter modals
        $guests = Guest::where('is_active', 1)->orderBy('last_name')->get();
        $availableRooms = Room::where('is_active', 1)->orderBy('room_number')->get();

        // 3. Operational Aggregates
        $totalBookings   = Reservation::count();
        $activeCheckIns  = Reservation::where('status', 'CHECKED_IN')->count();
        $confirmedStays  = Reservation::where('status', 'CONFIRMED')->count();

        return view('admin.reservation', compact(
            'reservations',
            'guests',
            'availableRooms',
            'totalBookings',
            'activeCheckIns',
            'confirmedStays'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_no'       => 'required|string|max:32|unique:reservation,reservation_no',
            'guest_id'             => 'required|exists:guests,id',
            'room_id'              => 'required|exists:room,id',
            'check_in_date'        => 'required|date',
            'check_out_date'       => 'required|date|after:check_in_date',
            'nightly_rate'         => 'required|numeric|min:0',
            'status'               => 'required|in:CONFIRMED,CHECKED_IN,CHECKED_OUT,CANCELLED,NO_SHOW',
            'booking_source'       => 'required|in:DIRECT,WEBSITE,OTA_BOOKING,OTA_EXPEDIA,PHONE,WALK_IN',
            'adults_count'         => 'required|integer|min:1',
            'children_count'       => 'required|integer|min:0',
            'special_instructions' => 'nullable|string|max:500',
        ]);

        // Assign current authenticated staff user or fallback ID (e.g. 1)
        $validated['created_by'] = auth()->id() ?? 1;

        Reservation::create($validated);

        return redirect()->route('admin.reservation')->with('success', 'Reservation confirmed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'reservation_no'       => ['required', 'string', 'max:32', Rule::unique('reservation')->ignore($reservation->id)],
            'guest_id'             => 'required|exists:guests,id',
            'room_id'              => 'required|exists:room,id',
            'check_in_date'        => 'required|date',
            'check_out_date'       => 'required|date|after:check_in_date',
            'nightly_rate'         => 'required|numeric|min:0',
            'status'               => 'required|in:CONFIRMED,CHECKED_IN,CHECKED_OUT,CANCELLED,NO_SHOW',
            'booking_source'       => 'required|in:DIRECT,WEBSITE,OTA_BOOKING,OTA_EXPEDIA,PHONE,WALK_IN',
            'adults_count'         => 'required|integer|min:1',
            'children_count'       => 'required|integer|min:0',
            'special_instructions' => 'nullable|string|max:500',
        ]);

        $reservation->update($validated);

        return redirect()->route('admin.reservation')->with('success', 'Reservation details updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservation')->with('success', 'Reservation deleted.');
    }
}
