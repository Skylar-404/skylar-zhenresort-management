<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use App\Models\Guest;
use App\Models\Invoice;
use App\Models\Maintenance;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search across all administrative entities.
     */
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));

        $guests = collect();
        $reservations = collect();
        $rooms = collect();
        $folios = collect();
        $invoices = collect();
        $maintenanceTickets = collect();
        $users = collect();

        if (!empty($query)) {
            // 1. Guests: search by first_name, last_name, email, phone, id number
            $guests = Guest::where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('identification_no', 'like', "%{$query}%");
            })->latest()->take(20)->get();

            // 2. Reservations: search by reservation_no or guest name
            $reservations = Reservation::with(['guest', 'room'])
                ->where(function ($q) use ($query) {
                    $q->where('reservation_no', 'like', "%{$query}%")
                        ->orWhereHas('guest', function ($gq) use ($query) {
                            $gq->where('first_name', 'like', "%{$query}%")
                                ->orWhere('last_name', 'like', "%{$query}%");
                        });
                })->latest()->take(20)->get();

            // 3. Rooms: search by room_number or room_type
            $rooms = Room::where('room_number', 'like', "%{$query}%")
                ->orWhere('room_type', 'like', "%{$query}%")
                ->orderBy('room_number')
                ->take(20)
                ->get();

            // 4. Folios: search by folio_no or guest name
            $folios = Folio::with(['guest', 'reservation.room'])
                ->where(function ($q) use ($query) {
                    $q->where('folio_no', 'like', "%{$query}%")
                        ->orWhereHas('guest', function ($gq) use ($query) {
                            $gq->where('first_name', 'like', "%{$query}%")
                                ->orWhere('last_name', 'like', "%{$query}%");
                        });
                })->latest('opened_at')->take(20)->get();

            // 5. Invoices: search by invoice_no or guest name
            $invoices = Invoice::with(['guest', 'folio'])
                ->where(function ($q) use ($query) {
                    $q->where('invoice_no', 'like', "%{$query}%")
                        ->orWhereHas('guest', function ($gq) use ($query) {
                            $gq->where('first_name', 'like', "%{$query}%")
                                ->orWhere('last_name', 'like', "%{$query}%");
                        });
                })->latest('issue_date')->take(20)->get();

            // 6. Maintenance: search by work_order_no, category, description, or room number
            $maintenanceTickets = Maintenance::with(['room', 'reporter', 'assignee'])
                ->where(function ($q) use ($query) {
                    $q->where('work_order_no', 'like', "%{$query}%")
                        ->orWhere('category', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhereHas('room', function ($rq) use ($query) {
                            $rq->where('room_number', 'like', "%{$query}%");
                        });
                })->latest()->take(20)->get();

            // 7. Users: search by full_name, username, email, or role
            $users = User::where(function ($q) use ($query) {
                $q->where('full_name', 'like', "%{$query}%")
                    ->orWhere('username', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('role', 'like', "%{$query}%");
            })->latest()->take(20)->get();
        }

        $totalResults = $guests->count()
            + $reservations->count()
            + $rooms->count()
            + $folios->count()
            + $invoices->count()
            + $maintenanceTickets->count()
            + $users->count();

        return view('admin.search', compact(
            'query',
            'guests',
            'reservations',
            'rooms',
            'folios',
            'invoices',
            'maintenanceTickets',
            'users',
            'totalResults'
        ));
    }
}
