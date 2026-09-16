<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch tickets with eager-loaded relations
        $tickets = Maintenance::with(['room', 'reporter', 'assignee'])
            ->latest()
            ->get();

        // Auxiliary data for dropdown menus in modals
        $rooms = Room::where('is_active', 1)->orderBy('room_number')->get();
        $technicians = User::where('role', 'MAINTENANCE')->where('is_active', 1)->get();

        // Operational Aggregates
        $totalTickets     = Maintenance::count();
        $pendingTickets   = Maintenance::where('status', 'PENDING')->count();
        $inProgressTickets = Maintenance::where('status', 'IN_PROGRESS')->count();

        return view('admin.maintenance', compact(
            'tickets',
            'rooms',
            'technicians',
            'totalTickets',
            'pendingTickets',
            'inProgressTickets'
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
            'room_id'      => 'required|exists:room,id',
            'assigned_to'  => 'nullable|exists:user,id',
            'issue_title'  => 'required|string|max:150',
            'description'  => 'required|string',
            'priority'     => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'status'       => 'required|in:PENDING,IN_PROGRESS,RESOLVED,CANCELLED',
            'cost'         => 'nullable|numeric|min:0',
            'started_at'   => 'nullable|date',
            'resolved_at'  => 'nullable|date|after_or_equal:started_at',
        ]);

        $validated['reported_by'] = auth()->id() ?? 1;

        Maintenance::create($validated);

        return redirect()->route('admin.maintenance')->with('success', 'Maintenance ticket created successfully.');
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
        $ticket = Maintenance::findOrFail($id);

        $validated = $request->validate([
            'room_id'      => 'required|exists:room,id',
            'assigned_to'  => 'nullable|exists:user,id',
            'issue_title'  => 'required|string|max:150',
            'description'  => 'required|string',
            'priority'     => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'status'       => 'required|in:PENDING,IN_PROGRESS,RESOLVED,CANCELLED',
            'cost'         => 'nullable|numeric|min:0',
            'started_at'   => 'nullable|date',
            'resolved_at'  => 'nullable|date|after_or_equal:started_at',
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.maintenance')->with('success', 'Maintenance ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Maintenance::findOrFail($id);
        $ticket->delete();

        return redirect()->route('admin.maintenance')->with('success', 'Maintenance ticket deleted successfully.');
    }
}
