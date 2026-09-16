<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde Resort & Spa - Dashboard</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        :root {
            --mv-primary: #1F4534;
            --mv-bg: #F8F5EE;
            --mv-sidebar: #1F4534;
            --mv-accent-gold: #C49A3A;
            --mv-accent-red: #A31B2C;
            --mv-navbar-bg: #FCFAF7;
            --mv-status-blue: #0A3251;
            --mv-status-green: #2B624A;
            --mv-status-gray: #707070;
        }

        body {
            background-color: var(--mv-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            font-family: "Poppins", sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: var(--mv-sidebar);
            color: #F8F5EE;
            width: 280px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000;
        }

        .nav-link {
            color: #A3BFB1;
            /* Lighter text for non-active links */
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }

        .nav-link.active {
            color: #F8F5EE;
            font-weight: bold;
        }

        .nav-link.active .link-icon {
            color: var(--mv-accent-gold);
        }

        .nav-link .link-icon {
            margin-right: 0.75rem;
            font-size: 1.25rem;
            width: 1.25em;
            /* fixed width for alignment */
        }

        /* Primary Container for the full content layout */
        .content-container {
            margin-left: 280px;
            /* Sidebar width */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main Area for Dashboard Widgets */
        main {
            padding: 2rem;
        }

        /* Top Navigation bar */
        .top-nav {
            background-color: var(--mv-navbar-bg);
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Search bar in the top-nav */
        .top-nav .search-bar input {
            background-color: #F0F0F0;
            border-radius: 20px;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #E0E0E0;
        }

        /* Metric cards in dashboard grid */
        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%;
        }

        .metric-card .label {
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #707070;
            letter-spacing: 1px;
        }

        .metric-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2b2b2b;
        }

        /* Common Card Styling for lower dashboard */
        .dashboard-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 500;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        /* List item (for Arrivals and Housekeeping) */
        .list-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #E0E0E0;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-item .initials {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #F0F0F0;
            color: var(--mv-status-gray);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-right: 1rem;
        }

        .list-item .details {
            flex-grow: 1;
        }

        /* Status badges like "Confirmed" and "In Progress" */
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .status-confirmed {
            background-color: #E6EEF3;
            color: var(--mv-status-blue);
        }

        .status-inprogress {
            background-color: #DDEEE1;
            color: var(--mv-status-green);
        }

        .status-pending {
            color: var(--mv-status-gray);
        }

        /* New Reservation Button (styled from top-nav right actions) */
        .new-res-btn {
            background-color: var(--mv-primary);
            color: white;
            border-radius: 5px;
            padding: 0.5rem 1rem;
            font-weight: bold;
            border: none;
        }
    </style>
</head>

<body>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="sidebar p-4">
        <div>
            <!-- Brand -->
            <div class="mb-5">
                <div class="fs-4 fw-bold">
                    <span style="color:var(--mv-accent-red); font-size: 1.25em; margin-right: 5px; vertical-align: middle;">
                        <span style="color: #C49A3A;" id="zhen-brand">真 ZHEN</span>
                </div>
                <div class="text-white opacity-75" style="font-size: 0.8rem; letter-spacing: 1px; margin-top:-5px;">RESORT & SPA</div>
            </div>

            <!-- Main Navigation -->
            <nav>
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link"><span class="index-num">01</span><i class="bi bi-grid me-2"></i> Overview</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reservations') }}" class="nav-link active"><span class="index-num">02</span><i class="bi bi-calendar3 me-2"></i> Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><span class="index-num">03</span><i class="bi bi-building me-2"></i> Property</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><span class="index-num">04</span><i class="bi bi-wrench me-2"></i> Operations</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><span class="index-num">05</span><i class="bi bi-star me-2"></i> Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.guests') }}" class="nav-link"><span class="index-num">06</span><i class="bi bi-people me-2"></i> Guests</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><span class="index-num">07</span><i class="bi bi-receipt me-2"></i> Finance</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users') }}" class="nav-link"><span class="index-num">08</span><i class="bi bi-gear me-2"></i> Administration</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- User Info -->
        <div class="user-block pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
            {{-- User Info Display & Logout Form --}}
            <div class="d-flex align-items-center gap-3">
                <div class="text-end small d-none d-sm-block">
                    <div class="fw-bold text-dark">{{ Auth::user()->full_name ?? Auth::user()->username }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">Role: {{ Auth::user()->role }}</div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sign out of PMS?');">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- navigation -->
    <div class="content-container">
        <nav class="top-nav">
            <div class="search-bar">
                <i class="bi bi-search position-absolute text-muted ms-3" style="margin-top: 0.5rem;"></i>
                <input type="text" placeholder="Search guests, rooms, reservations, folios...">
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex flex-column text-end me-3">
                    <span style="color:var(--mv-status-gray); font-size: 0.75rem;">Wed, 9 Sept 2026</span>
                    <span style="color:var(--mv-status-gray); font-size: 0.65rem; text-transform:uppercase;">Wed, Season High</span>
                </div>
                <button class="new-res-btn me-2">New Reservation</button>
                <i class="bi bi-bell-fill fs-5 text-muted ms-2"></i>
            </div>
        </nav>

        <!---------->
        <!-- Main -->
        <main>

            <!-- Greeting and Date Section -->
            <div class="mb-5">
                <h1 class="h2 fw-bold" style="color: var(--mv-primary);">Good afternoon, JohnPork.</h1>
                <p class="text-muted mb-0">Wednesday, 9 September 2026 &middot; Zhen Private Resort & Spa</p>
            </div>

            <div class="container-fluid px-lg-5">
                {{-- Top Bar Navigation & Logout --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-0">Resort Operations Dashboard</h2>
                        <p class="text-muted small mb-0">{{ now()->format('l, F d, Y') }} &bull; Real-time Performance Overview</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.reservations') }}" class="btn btn-outline-primary btn-sm">Manage Bookings</a>
                        <a href="{{ route('admin.folios') }}" class="btn btn-outline-dark btn-sm">Folios & Billing</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Sign Out</button>
                        </form>
                    </div>
                </div>

                {{-- KPI Cards Row 1: Primary Metrics --}}
                <div class="row g-3 mb-4">
                    {{-- Occupancy Rate --}}
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Occupancy Rate</span>
                                <span class="badge bg-primary-subtle text-primary">{{ $occupiedRooms }} / {{ $totalRooms }} Villas</span>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">{{ $occupancyRate }}%</h2>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $occupancyRate }}%"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Total Revenue --}}
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Total Collections</span>
                                <span class="badge bg-success-subtle text-success">+${{ number_format($todayRevenue, 2) }} Today</span>
                            </div>
                            <h2 class="fw-bold text-success mb-1">${{ number_format($totalRevenue, 2) }}</h2>
                            <small class="text-muted">Unsettled: ${{ number_format($outstandingBalance, 2) }}</small>
                        </div>
                    </div>

                    {{-- In-House Guests --}}
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-bold text-uppercase">In-House Guests</span>
                                <span class="badge bg-info-subtle text-info-emphasis">Registered: {{ $totalGuests }}</span>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">{{ $checkedInGuests }}</h2>
                            <small class="text-muted">Arrivals: {{ $arrivalsToday }} | Departures: {{ $departuresToday }}</small>
                        </div>
                    </div>

                    {{-- Maintenance Alert --}}
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Work Orders</span>
                                <span class="badge bg-danger-subtle text-danger">Active</span>
                            </div>
                            <h2 class="fw-bold {{ $pendingRepairs > 0 ? 'text-danger' : 'text-dark' }} mb-1">{{ $pendingRepairs }}</h2>
                            <small class="text-muted">Housekeeping dirty villas: {{ $dirtyRooms }}</small>
                        </div>
                    </div>
                </div>

                {{-- Villa Inventory Status Grid --}}
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card p-3 shadow-sm border-0">
                            <h6 class="fw-bold mb-3 text-secondary text-uppercase small">Villa Room Status Breakdown</h6>
                            <div class="row text-center g-2">
                                <div class="col-md-4">
                                    <div class="p-2 border rounded bg-success-subtle border-success-subtle">
                                        <span class="text-success small fw-bold">AVAILABLE (READY)</span>
                                        <h4 class="fw-bold text-success mb-0 mt-1">{{ $availableRooms }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 border rounded bg-primary-subtle border-primary-subtle">
                                        <span class="text-primary small fw-bold">OCCUPIED (IN-HOUSE)</span>
                                        <h4 class="fw-bold text-primary mb-0 mt-1">{{ $occupiedRooms }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 border rounded bg-warning-subtle border-warning-subtle">
                                        <span class="text-warning-emphasis small fw-bold">DIRTY / HOUSEKEEPING</span>
                                        <h4 class="fw-bold text-warning-emphasis mb-0 mt-1">{{ $dirtyRooms }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Activity Split: Recent Bookings & Financial Activity --}}
                <div class="row g-3 mb-4">
                    {{-- Recent Bookings --}}
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">Latest Booking Activity</h6>
                                <a href="{{ route('admin.reservations') }}" class="small text-decoration-none">View All Bookings &rarr;</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 small">
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
                                        $statusBadges = [
                                        'CONFIRMED' => 'bg-info text-dark',
                                        'CHECKED_IN' => 'bg-success',
                                        'CHECKED_OUT' => 'bg-secondary',
                                        'CANCELLED' => 'bg-danger',
                                        'PENDING' => 'bg-warning text-dark',
                                        ];
                                        @endphp
                                        <tr>
                                            <td class="ps-3 fw-bold">{{ $booking->reservation_no }}</td>
                                            <td>{{ $booking->guest->full_name ?? 'N/A' }}</td>
                                            <td>Villa {{ $booking->room->room_number ?? '-' }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($booking->check_in_date)->format('M d') }} -
                                                {{ \Carbon\Carbon::parse($booking->check_out_date)->format('M d') }}
                                            </td>
                                            <td><span class="badge {{ $statusBadges[$booking->status] ?? 'bg-secondary' }}">{{ $booking->status }}</span></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-3 text-muted">No reservations found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Financial Activity Ledger --}}
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 border-0">
                                <h6 class="fw-bold mb-0">Recent Payment Receipts</h6>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush small">
                                    @forelse($recentPayments as $pay)
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                        <div>
                                            <div class="fw-bold">{{ $pay->folio->guest->full_name ?? 'Walk-in' }}</div>
                                            <small class="text-muted">{{ $pay->payment_method }} &bull; {{ $pay->paid_at ? $pay->paid_at->format('H:i') : '' }}</small>
                                        </div>
                                        <span class="fw-bold text-success">+${{ number_format($pay->amount, 2) }}</span>
                                    </li>
                                    @empty
                                    <li class="list-group-item text-center py-3 text-muted">No recent payments logged.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Urgent Maintenance Row --}}
                @if($urgentRepairs->isNotEmpty())
                <div class="card border-0 shadow-sm p-3 border-start border-danger border-4">
                    <h6 class="fw-bold text-danger mb-2">High Priority Maintenance Warnings</h6>
                    <div class="row g-2">
                        @foreach($urgentRepairs as $repair)
                        <div class="col-md-3">
                            <div class="p-2 border rounded bg-light small">
                                <span class="badge bg-danger">{{ $repair->priority }}</span>
                                <strong>Villa {{ $repair->room->room_number ?? 'N/A' }}</strong>: {{ $repair->issue_title }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>