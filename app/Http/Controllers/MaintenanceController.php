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
        $totalTickets          = Maintenance::count();
        $pendingTickets        = Maintenance::whereIn('status', ['REPORTED', 'PENDING'])->count();
        $inProgressTickets     = Maintenance::where('status', 'IN_PROGRESS')->count();
        $resolvedTicketsCount  = Maintenance::whereIn('status', ['RESOLVED', 'CLOSED'])->count();
        $cancelledTicketsCount = Maintenance::where('status', 'CANCELLED')->count();
        $openTickets           = $pendingTickets + $inProgressTickets;

        $urgentTicketsCount    = Maintenance::whereIn('priority', ['HIGH', 'CRITICAL'])
            ->whereIn('status', ['REPORTED', 'PENDING', 'IN_PROGRESS'])
            ->count();

        $maintenanceRooms      = Room::where('status', 'MAINTENANCE')->get();
        $maintenanceRoomsCount = $maintenanceRooms->count();

        // Calculate average resolution time for resolved tickets in hours
        $resolvedTickets = Maintenance::whereIn('status', ['RESOLVED', 'CLOSED'])
            ->whereNotNull('created_at')
            ->whereNotNull('resolved_at')
            ->get();
        $avgResolutionHours = $resolvedTickets->count() > 0
            ? round($resolvedTickets->avg(function ($t) {
                return $t->created_at->diffInMinutes($t->resolved_at) / 60;
            }), 1)
            : 0;

        return view('admin.maintenance', compact(
            'tickets',
            'rooms',
            'technicians',
            'totalTickets',
            'pendingTickets',
            'inProgressTickets',
            'resolvedTicketsCount',
            'cancelledTicketsCount',
            'openTickets',
            'urgentTicketsCount',
            'maintenanceRooms',
            'maintenanceRoomsCount',
            'avgResolutionHours'
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
            'room_id'        => 'required|exists:room,id',
            'assigned_to'    => 'nullable|exists:user,id',
            'category'       => 'nullable|string|max:50',
            'issue_title'    => 'nullable|string|max:150',
            'description'    => 'required|string|max:500',
            'priority'       => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'status'         => 'required|in:REPORTED,PENDING,IN_PROGRESS,RESOLVED,CLOSED,CANCELLED',
            'scheduled_date' => 'nullable|date',
            'resolved_at'    => 'nullable|date',
        ]);

        $status = in_array($validated['status'], ['REPORTED', 'IN_PROGRESS', 'RESOLVED', 'CLOSED', 'CANCELLED'])
            ? $validated['status']
            : ($validated['status'] === 'PENDING' ? 'REPORTED' : 'REPORTED');

        $category = !empty($validated['category']) ? $validated['category'] : (!empty($validated['issue_title']) ? $validated['issue_title'] : 'General Maintenance');

        Maintenance::create([
            'room_id'        => $validated['room_id'],
            'work_order_no'  => 'WO-' . strtoupper(uniqid()),
            'reported_by'    => auth()->id() ?? User::first()->id ?? 1,
            'assigned_to'    => $validated['assigned_to'] ?? null,
            'category'       => substr($category, 0, 50),
            'description'    => $validated['description'],
            'priority'       => $validated['priority'],
            'status'         => $status,
            'scheduled_date' => $request->input('scheduled_date'),
            'resolved_at'    => $request->input('resolved_at'),
        ]);

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
            'room_id'        => 'required|exists:room,id',
            'assigned_to'    => 'nullable|exists:user,id',
            'category'       => 'nullable|string|max:50',
            'issue_title'    => 'nullable|string|max:150',
            'description'    => 'required|string|max:500',
            'priority'       => 'required|in:LOW,MEDIUM,HIGH,CRITICAL',
            'status'         => 'required|in:REPORTED,PENDING,IN_PROGRESS,RESOLVED,CLOSED,CANCELLED',
            'scheduled_date' => 'nullable|date',
            'resolved_at'    => 'nullable|date',
        ]);

        $status = in_array($validated['status'], ['REPORTED', 'IN_PROGRESS', 'RESOLVED', 'CLOSED', 'CANCELLED'])
            ? $validated['status']
            : ($validated['status'] === 'PENDING' ? 'REPORTED' : $ticket->status);

        $category = !empty($validated['category']) ? $validated['category'] : (!empty($validated['issue_title']) ? $validated['issue_title'] : $ticket->category);

        $ticket->update([
            'room_id'        => $validated['room_id'],
            'assigned_to'    => $validated['assigned_to'] ?? null,
            'category'       => substr($category, 0, 50),
            'description'    => $validated['description'],
            'priority'       => $validated['priority'],
            'status'         => $status,
            'scheduled_date' => $request->input('scheduled_date'),
            'resolved_at'    => $request->input('resolved_at'),
        ]);

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
