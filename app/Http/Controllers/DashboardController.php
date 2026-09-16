<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use App\Models\Guest;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Occupancy Metrics
        $totalRooms    = Room::count();
        $occupiedRooms = Room::where('status', 'OCCUPIED')->count();
        $dirtyRooms    = Room::where('status', 'DIRTY')->count();
        $availableRooms = Room::where('status', 'AVAILABLE')->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 1) : 0;

        // 2. Financial Metrics
        $totalRevenue       = Payment::where('payment_status', 'SUCCESS')->sum('amount');
        $todayRevenue       = Payment::where('payment_status', 'SUCCESS')->whereDate('paid_at', $today)->sum('amount');
        $outstandingBalance = Folio::whereIn('status', ['OPEN', 'DRAFT'])->sum('balance');

        // 3. Guest & Reservation Metrics
        $totalGuests    = Guest::count();
        $checkedInGuests = Reservation::where('status', 'CHECKED_IN')->count();
        $arrivalsToday  = Reservation::whereDate('check_in_date', $today)->whereIn('status', ['CONFIRMED', 'PENDING'])->count();
        $departuresToday = Reservation::whereDate('check_out_date', $today)->where('status', 'CHECKED_IN')->count();

        // 4. Operations & Maintenance
        $pendingRepairs = Maintenance::whereIn('status', ['PENDING', 'IN_PROGRESS'])->count();

        // 5. Activity Feeds
        $recentReservations = Reservation::with(['guest', 'room'])
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = Payment::with(['folio.guest'])
            ->where('payment_status', 'SUCCESS')
            ->latest('paid_at')
            ->take(5)
            ->get();

        $urgentRepairs = Maintenance::with('room')
            ->whereIn('priority', ['HIGH', 'CRITICAL'])
            ->whereIn('status', ['PENDING', 'IN_PROGRESS'])
            ->latest('created_at')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalRooms',
            'occupiedRooms',
            'dirtyRooms',
            'availableRooms',
            'occupancyRate',
            'totalRevenue',
            'todayRevenue',
            'outstandingBalance',
            'totalGuests',
            'checkedInGuests',
            'arrivalsToday',
            'departuresToday',
            'pendingRepairs',
            'recentReservations',
            'recentPayments',
            'urgentRepairs'
        ));
    }
}
