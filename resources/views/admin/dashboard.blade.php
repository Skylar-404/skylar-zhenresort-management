@extends('admin.layout.app')

@section('title', 'Operations Dashboard')

@section('content')
@php
    $hour = (int) now()->format('H');
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp

<!-- Greeting and Live Performance Header -->
<div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3" data-aos="fade-down" data-aos-duration="700">
    <div>
        <span class="text-uppercase fw-semibold small" style="letter-spacing: 2px; color: var(--resort-gold);">Zhen Executive Operations</span>
        <h1 class="h2 fw-bold mb-1" style="color: var(--resort-green);">
            {{ $greeting }}, {{ Auth::user()?->full_name ?? Auth::user()?->username ?? 'Administrator' }}.
        </h1>
        <p class="text-muted mb-0 small">
            {{ now()->format('l, j F Y') }} &middot; Zhen Private Island Resort &amp; Sanctuary
        </p>
    </div>

    <!-- Top Quick Action Buttons with Shimmer & Lift -->
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.reservations') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-calendar3 me-1"></i> Bookings
        </a>
        <a href="{{ route('admin.folios') }}" class="btn btn-resort-gold btn-sm">
            <i class="bi bi-receipt me-1"></i> Folios &amp; Billing
        </a>
        <a href="{{ route('admin.rooms') }}" class="btn btn-theme-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Inventory
        </a>
    </div>
</div>

<div class="container-fluid px-0">

    {{-- KPI Cards Row 1: Primary Metrics with Staggered AOS & Lift --}}
    <div class="row g-3 mb-4">
        {{-- Occupancy Rate --}}
        <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="label">Occupancy Rate</span>
                    <span class="badge px-2 py-1" style="background: rgba(4, 62, 53, 0.1); color: var(--resort-green); border-radius: 6px;">
                        {{ $occupiedRooms }} / {{ $totalRooms }} Villas
                    </span>
                </div>
                <div class="value mb-1 gradient-text-gold">{{ $occupancyRate }}%</div>
                <div class="progress mt-2" style="height: 6px; border-radius: 6px; background-color: #ede9df;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $occupancyRate }}%; background: linear-gradient(90deg, var(--resort-green), var(--resort-gold));"></div>
                </div>
            </div>
        </div>

        {{-- Total Collections --}}
        <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="label">Total Collections</span>
                    <span class="badge px-2 py-1" style="background: rgba(28, 124, 76, 0.12); color: #1C7C4C; border-radius: 6px;">
                        +${{ number_format($todayRevenue, 2) }} Today
                    </span>
                </div>
                <div class="value mb-1" style="color: var(--resort-green);">${{ number_format($totalRevenue, 2) }}</div>
                <small class="text-muted" style="font-size: 0.76rem;">Unsettled: ${{ number_format($outstandingBalance, 2) }}</small>
            </div>
        </div>

        {{-- In-House Guests --}}
        <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="label">In-House Guests</span>
                    <span class="badge px-2 py-1" style="background: rgba(10, 50, 81, 0.1); color: #0A3251; border-radius: 6px;">
                        Registered: {{ $totalGuests }}
                    </span>
                </div>
                <div class="value mb-1 gradient-text-gold">{{ $checkedInGuests }}</div>
                <small class="text-muted" style="font-size: 0.76rem;">Arrivals: {{ $arrivalsToday }} &bull; Departures: {{ $departuresToday }}</small>
            </div>
        </div>

        {{-- Maintenance Alert --}}
        <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="label">Work Orders</span>
                    <span class="badge px-2 py-1 {{ $pendingRepairs > 0 ? 'bg-danger bg-opacity-10 text-danger' : 'bg-secondary bg-opacity-10 text-secondary' }}" style="border-radius: 6px;">
                        Active Tasks
                    </span>
                </div>
                <div class="value {{ $pendingRepairs > 0 ? 'text-danger' : 'text-dark' }} mb-1">{{ $pendingRepairs }}</div>
                <small class="text-muted" style="font-size: 0.76rem;">Housekeeping dirty villas: {{ $dirtyRooms }}</small>
            </div>
        </div>
    </div>

    {{-- Villa Inventory Status Grid with Glassmorphism Cards --}}
    <div class="row g-3 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="col-12">
            <div class="card p-3 p-lg-4 border-0 shadow-sm" style="border-radius: 16px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-uppercase small" style="letter-spacing: 1px; color: var(--resort-green);">
                        <i class="bi bi-building me-2" style="color: var(--resort-gold);"></i>Villa Room Status Breakdown
                    </h6>
                    <span class="text-muted small">Total Inventory: {{ $totalRooms }} Sanctuary Villas</span>
                </div>
                <div class="row text-center g-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3" style="background: linear-gradient(145deg, #F0FAF4 0%, #E2F5EB 100%); border-color: rgba(28, 124, 76, 0.2) !important;">
                            <span class="small fw-bold text-success" style="letter-spacing: 1px;">AVAILABLE &bull; READY</span>
                            <h3 class="fw-bold text-success mb-0 mt-1">{{ $availableRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3" style="background: linear-gradient(145deg, #EEF5FB 0%, #E1EFF8 100%); border-color: rgba(10, 50, 81, 0.2) !important;">
                            <span class="small fw-bold" style="color: #0A3251; letter-spacing: 1px;">OCCUPIED &bull; IN-HOUSE</span>
                            <h3 class="fw-bold mb-0 mt-1" style="color: #0A3251;">{{ $occupiedRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3" style="background: linear-gradient(145deg, #FDF9EE 0%, #F8F1DC 100%); border-color: rgba(173, 131, 34, 0.25) !important;">
                            <span class="small fw-bold" style="color: #9A7215; letter-spacing: 1px;">DIRTY &bull; HOUSEKEEPING</span>
                            <h3 class="fw-bold mb-0 mt-1" style="color: #9A7215;">{{ $dirtyRooms }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Split: Recent Bookings & Financial Activity --}}
    <div class="row g-3 mb-4">
        {{-- Recent Bookings Table --}}
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="350">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color: var(--resort-green);">
                        <i class="bi bi-calendar-check me-2" style="color: var(--resort-gold);"></i>Latest Booking Activity
                    </h6>
                    <a href="{{ route('admin.reservations') }}" class="small text-decoration-none fw-semibold" style="color: var(--resort-gold);">
                        View All Bookings <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Ref #</th>
                                <th>Guest</th>
                                <th>Room</th>
                                <th>Dates</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentReservations as $booking)
                            @php
                            $statusPillStyles = [
                                'CONFIRMED' => 'background: #E6EEF3; color: #0A3251;',
                                'CHECKED_IN' => 'background: #E2F4EA; color: #1C7C4C;',
                                'CHECKED_OUT' => 'background: #EAE8E2; color: #69655E;',
                                'CANCELLED' => 'background: #FDE8E8; color: #DC3545;',
                                'PENDING' => 'background: #FBF3D8; color: #AD8322;',
                            ];
                            @endphp
                            <tr>
                                <td class="ps-3 fw-bold" style="color: var(--resort-green);">{{ $booking->reservation_no }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $booking->guest->full_name ?? 'N/A' }}</div>
                                </td>
                                <td><span class="badge bg-light text-dark border">Villa {{ $booking->room->room_number ?? '-' }}</span></td>
                                <td class="text-muted small">
                                    {{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d') }} &rarr;
                                    {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="status-pill" style="{{ $statusPillStyles[$booking->status] ?? 'background: #EAE8E2; color: #69655E;' }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No reservations found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Financial Activity Ledger --}}
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color: var(--resort-green);">
                        <i class="bi bi-wallet2 me-2" style="color: var(--resort-gold);"></i>Recent Payments
                    </h6>
                    <a href="{{ route('admin.invoices') }}" class="small text-decoration-none fw-semibold" style="color: var(--resort-gold);">
                        Ledger &rarr;
                    </a>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush small">
                        @forelse($recentPayments as $pay)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle" style="width: 32px; height: 32px; font-size: 0.72rem;">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $pay->folio->guest->full_name ?? 'Walk-in Guest' }}</div>
                                    <small class="text-muted">{{ $pay->payment_method }} &bull; {{ $pay->paid_at ? $pay->paid_at->format('H:i') : '' }}</small>
                                </div>
                            </div>
                            <span class="fw-bold text-success">+${{ number_format($pay->amount, 2) }}</span>
                        </li>
                        @empty
                        <li class="list-group-item text-center py-4 text-muted">No recent payments logged.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Urgent Maintenance Row --}}
    @if($urgentRepairs->isNotEmpty())
    <div class="card border-0 shadow-sm p-3 border-start border-4 mb-3" style="border-radius: 14px; border-left-color: #DC3545 !important;" data-aos="fade-up">
        <h6 class="fw-bold text-danger mb-2 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-octagon-fill"></i> High Priority Operations Alerts
        </h6>
        <div class="row g-2">
            @foreach($urgentRepairs as $repair)
            <div class="col-md-3">
                <div class="p-2 border rounded-3 bg-light small d-flex align-items-center justify-content-between">
                    <div>
                        <strong>Villa {{ $repair->room->room_number ?? 'N/A' }}</strong>: {{ $repair->issue_title }}
                    </div>
                    <span class="badge bg-danger ms-2">{{ $repair->priority }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection