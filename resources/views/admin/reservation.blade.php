<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde - Reservations</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: DM Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --mv-primary: #1B3527;
            /* Deep Forest Green */
            --mv-sidebar-bg: #1B3527;
            /* Solid Sidebar Background */
            --mv-bg: #F8F5EE;
            /* Cream/Beige Background */
            --mv-navbar-bg: #FFFFFF;
            --mv-gold: #C49A3A;
            /* Accent Gold */
            --mv-border: #E8E3D8;
            --mv-topbar-border: #ECE7DD;

            /* Status Pill Colors */
            --status-confirmed-bg: #E6EEF3;
            --status-confirmed-txt: #0A3251;
            --status-checkedin-bg: #E2F4EA;
            --status-checkedin-txt: #1C7C4C;
            --status-pending-bg: #FBF3D8;
            --status-pending-txt: #AD8322;
            --status-cancelled-bg: #FDE8E8;
            --status-cancelled-txt: #DC3545;

            /* Tier Badges */
            --tier-platinum-bg: #1C2421;
            --tier-platinum-txt: #E2E8F0;
            --tier-gold-bg: #FBF3D8;
            --tier-gold-txt: #AD8322;
            --tier-silver-bg: #ECEFF1;
            --tier-silver-txt: #546E7A;
            --tier-standard-bg: #F1F3F5;
            --tier-standard-txt: #6C757D;
        }

        body {
            background-color: var(--mv-bg);
            font-family: 'DM Sans', sans-serif;
            color: #2b2b2b;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Elegant Serif Heading */
        .font-script {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--mv-primary);
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 250px;
            background-color: var(--mv-sidebar-bg) !important;
            min-height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo-container {
            padding: 1.25rem 0.5rem 1.5rem 0.5rem;
        }

        .sidebar .nav-link {
            color: rgba(248, 245, 238, 0.65);
            border-radius: 6px;
            padding: 0.58rem 0.85rem;
            margin-bottom: 0.2rem;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .sidebar .nav-link .index-num {
            font-size: 0.75rem;
            width: 24px;
            opacity: 0.45;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar .nav-link.active {
            color: var(--mv-gold);
            background-color: rgba(196, 154, 58, 0.14);
            border: 1px solid rgba(196, 154, 58, 0.28);
        }

        .sidebar .nav-link.active .index-num {
            opacity: 1;
            color: var(--mv-gold);
        }

        /* ==================== MAIN WRAPPER ==================== */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: 250px;
            }
        }

        /* ==================== TOP NAVIGATION BAR ==================== */
        .top-navbar {
            height: 64px;
            background-color: var(--mv-navbar-bg);
            border-bottom: 1px solid var(--mv-topbar-border);
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .search-container {
            position: relative;
            width: 380px;
            max-width: 100%;
        }

        .search-input {
            background-color: #ECE7DD;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 0.85rem;
            padding: 0.55rem 0.75rem 0.55rem 2.4rem;
            width: 100%;
            color: #333;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            background-color: #E5DFD2;
            border-color: #D3CABA;
        }

        .search-input::placeholder {
            color: #8C8C8C;
            font-size: 0.82rem;
        }

        /* ==================== RESERVATION COMPONENTS ==================== */
        .stat-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 6px;
            padding: 1.1rem;
        }

        .stat-card .label {
            text-transform: uppercase;
            font-size: 0.68rem;
            letter-spacing: 1px;
            font-weight: 600;
            color: #7d827a;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--mv-primary);
        }

        /* Filter Nav Buttons */
        .filter-btn-group .btn {
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.38rem 0.95rem;
            border: 1px solid #E0DAD0;
            background-color: #FFFFFF;
            color: #3b3d39;
        }

        .filter-btn-group .btn.active {
            background-color: var(--mv-primary);
            color: #FFFFFF;
            border-color: var(--mv-primary);
        }

        .btn-theme-primary {
            background-color: var(--mv-primary);
            color: #ffffff;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 5px;
            padding: 0.5rem 1.1rem;
        }

        .btn-theme-primary:hover {
            background-color: #13271c;
            color: #ffffff;
        }

        /* Ledger Table Styling */
        .res-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
        }

        .res-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            color: #8A8D86;
            border-bottom: 1px solid var(--mv-border);
            padding: 0.85rem 1rem;
            background-color: #FAFAF8;
        }

        .res-table td {
            font-size: 0.85rem;
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F0ECE4;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #F0EDE5;
            color: #555A52;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        /* Badges */
        .tier-badge {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 2px 6px;
            border-radius: 3px;
        }

        .tier-platinum {
            background-color: var(--tier-platinum-bg);
            color: var(--tier-platinum-txt);
        }

        .tier-gold {
            background-color: var(--tier-gold-bg);
            color: var(--tier-gold-txt);
        }

        .tier-silver {
            background-color: var(--tier-silver-bg);
            color: var(--tier-silver-txt);
        }

        .tier-standard {
            background-color: var(--tier-standard-bg);
            color: var(--tier-standard-txt);
        }

        .status-pill {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-pill-confirmed {
            background-color: var(--status-confirmed-bg);
            color: var(--status-confirmed-txt);
        }

        .status-pill-checkedin {
            background-color: var(--status-checkedin-bg);
            color: var(--status-checkedin-txt);
        }

        .status-pill-pending {
            background-color: var(--status-pending-bg);
            color: var(--status-pending-txt);
        }

        .status-pill-cancelled {
            background-color: var(--status-cancelled-bg);
            color: var(--status-cancelled-txt);
        }

        .room-assigned-tag {
            font-size: 0.75rem;
            border: 1px solid #E5E0D4;
            border-radius: 4px;
            padding: 2px 6px;
            background: #FAF8F5;
            font-weight: 600;
            color: var(--mv-primary);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="offcanvas-lg offcanvas-start sidebar text-white p-3" tabindex="-1" id="sidebarMenu">
        <div>
            <!-- Brand Logo Header -->
            <div class="d-flex align-items-center gap-2 logo-container">
                <div class="rounded d-flex align-items-center justify-content-center fw-bold"
                    style="width: 36px; height: 36px; background-color: var(--mv-gold); color: #1B3527; font-family: 'Playfair Display', serif; font-size: 1.35rem;">
                    真
                </div>
                <div>
                    <h6 class="mb-0 text-white fs-5" style="letter-spacing: 0.5px; line-height: 1.1;">Zhen</h6>
                    <span style="font-size: 0.55rem; letter-spacing: 1.6px; opacity: 0.65; display: block; text-transform: uppercase;">Resort & Spa</span>
                </div>
                <button type="button" class="btn-close btn-close-white ms-auto d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
            </div>

            <!-- Navigation Links -->
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
        </div>

        <!-- Sidebar Bottom / User Footer -->
        <div class="pt-3 border-top border-white border-opacity-10 px-1">
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

    <!-- MAIN -->
    <div class="main-wrapper">

        <!-- Navigation Bar -->
        <nav class="navbar top-navbar px-3 px-lg-4">
            <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

                <!-- Left: Search Bar & Mobile Trigger -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="bi bi-list fs-3 text-dark"></i>
                    </button>

                    <div class="search-container">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.85rem;"></i>
                        <input type="text" class="search-input" placeholder="Search guests, reservation ID, room, phone..." />
                    </div>
                </div>

                <!-- Right: Date Status & Notification Bell -->
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <div class="fw-bold small text-dark" style="font-size: 0.82rem; line-height: 1.2;">Wed, 9 Sept 2026</div>
                        <div style="font-size: 0.63rem; letter-spacing: 0.5px; color: #8A8D86;" class="text-uppercase fw-semibold">Wed &middot; Season High</div>
                    </div>
                    <button class="btn btn-link text-dark p-0 position-relative text-decoration-none">
                        <i class="bi bi-bell fs-5 text-secondary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    </button>
                </div>

            </div>
        </nav>

        <!--  -->
        {{-- Feedback Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <!--  -->

        <!-- Page Body Content -->
        <main class="px-4 py-4">

            <!-- Section Title & Action Buttons -->
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <h1 class="display-6 font-script fw-bold mb-1">Reservations</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">02</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">Booking Manifest & Stays</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <!-- Action Tools -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                        <i class="bi bi-calendar-range me-1"></i> 09 - 16 Sept 2026
                    </button>
                    <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createReservationModal">
                        <i class="bi bi-plus-lg"></i> New Reservation
                    </button>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Total On Books</div>
                        <div class="value mt-1">{{ $totalBookings }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">For current stay week</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Arriving Today</div>
                        <div class="value mt-1">{{ $activeCheckIns }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;"><span class="text-success fw-bold">2</span> checked in &middot; 3 expected</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Pacing Revenue</div>
                        <div class="value mt-1" style="color: var(--mv-primary);">$34,850</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">+12% vs previous week</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Avg. Length of Stay</div>
                        <div class="value mt-1" style="color: var(--mv-gold);">3.4d</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">78% Resort Suites / Villas</div>
                    </div>
                </div>
            </div>

            <!-- Main Ledger Card -->
            <div class="res-card overflow-hidden">

                <!-- Table Toolbar: Filters & Quick Search -->
                <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <!-- Status Filter Tabs -->
                    <div class="btn-group filter-btn-group shadow-sm rounded">
                        <button type="button" class="btn active">All (28)</button>
                        <button type="button" class="btn">Confirmed (18)</button>
                        <button type="button" class="btn">Checked In (6)</button>
                        <button type="button" class="btn">Pending Deposit (3)</button>
                        <button type="button" class="btn">Cancelled (1)</button>
                    </div>

                    <!-- Channel & Options Filter -->
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 220px;">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-funnel text-muted"></i></span>
                            <select class="form-select bg-light border-start-0 text-muted small">
                                <option selected>All Sources (Direct, OTA)</option>
                                <option value="1">Direct Web Booking</option>
                                <option value="2">Concierge Phone</option>
                                <option value="3">Booking.com / Expedia</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Reservation Records Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Reference</th>
                                <th>Guest Details</th>
                                <th>Allocated Villa</th>
                                <th>Stay Window</th>
                                <th>Nightly Rate</th>
                                <th>Status</th>
                                <th>Booked By</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $res)
                            @php
                            $statusClasses = [
                            'CONFIRMED' => 'bg-primary',
                            'CHECKED_IN' => 'bg-success',
                            'CHECKED_OUT' => 'bg-secondary',
                            'CANCELLED' => 'bg-danger',
                            'NO_SHOW' => 'bg-dark',
                            ];
                            $badgeClass = $statusClasses[$res->status] ?? 'bg-secondary';
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">{{ $res->reservation_no }}</span>
                                    <div class="text-muted small">{{ $res->booking_source }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $res->guest->first_name ?? 'N/A' }} {{ $res->guest->last_name ?? '' }}</div>
                                    <div class="text-muted small">{{ $res->guest->phone ?? 'No phone' }}</div>
                                </td>
                                <td>
                                    <div><span class="fw-bold">{{ $res->room->room_number ?? 'Unassigned' }}</span> ({{ $res->room->building_code ?? '-' }})</div>
                                    <small class="text-muted">{{ $res->room->room_type ?? '' }}</small>
                                </td>
                                <td>
                                    <div class="small">In: <strong>{{ $res->check_in_date->format('M d, Y') }}</strong></div>
                                    <div class="small text-muted">Out: <strong>{{ $res->check_out_date->format('M d, Y') }}</strong></div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">${{ number_format($res->nightly_rate, 2) }}</span>
                                    <div class="text-muted small">{{ $res->adults_count }} Ad / {{ $res->children_count }} Ch</div>
                                </td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">{{ str_replace('_', ' ', $res->status) }}</span>
                                </td>
                                <td class="text-muted small">
                                    {{ $res->creator->full_name ?? 'System' }}
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary edit-res-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editReservationModal"
                                            data-id="{{ $res->id }}"
                                            data-no="{{ $res->reservation_no }}"
                                            data-guest="{{ $res->guest_id }}"
                                            data-room="{{ $res->room_id }}"
                                            data-checkin="{{ $res->check_in_date->format('Y-m-d') }}"
                                            data-checkout="{{ $res->check_out_date->format('Y-m-d') }}"
                                            data-rate="{{ $res->nightly_rate }}"
                                            data-status="{{ $res->status }}"
                                            data-source="{{ $res->booking_source }}"
                                            data-adults="{{ $res->adults_count }}"
                                            data-children="{{ $res->children_count }}"
                                            data-instructions="{{ $res->special_instructions }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Cancel/Delete reservation {{ $res->reservation_no }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">No reservations booked.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                <!-- 1. CREATE RESERVATION MODAL                                               -->
                <div class="modal fade" id="createReservationModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form action="{{ route('admin.reservations.store') }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">New Booking</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Reservation Reference</label>
                                    <input type="text" name="reservation_no" class="form-control" placeholder="e.g. RES-2026-001" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Booking Source</label>
                                    <select name="booking_source" class="form-select" required>
                                        <option value="DIRECT">DIRECT</option>
                                        <option value="WEBSITE">WEBSITE</option>
                                        <option value="OTA_BOOKING">OTA_BOOKING</option>
                                        <option value="OTA_EXPEDIA">OTA_EXPEDIA</option>
                                        <option value="PHONE">PHONE</option>
                                        <option value="WALK_IN">WALK_IN</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Select Guest</label>
                                    <select name="guest_id" class="form-select" required>
                                        <option value="">-- Choose registered guest --</option>
                                        @foreach($guests as $guest)
                                        <option value="{{ $guest->id }}">{{ $guest->last_name }}, {{ $guest->first_name }} ({{ $guest->phone }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Assign Villa / Room</label>
                                    <select name="room_id" class="form-select" required>
                                        <option value="">-- Choose villa --</option>
                                        @foreach($availableRooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }} (${{ $room->base_rate }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Check-In Date</label>
                                    <input type="date" name="check_in_date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Check-Out Date</label>
                                    <input type="date" name="check_out_date" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Nightly Rate ($)</label>
                                    <input type="number" step="0.01" name="nightly_rate" class="form-control" placeholder="200.00" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Adults Count</label>
                                    <input type="number" name="adults_count" class="form-control" value="1" min="1" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Children Count</label>
                                    <input type="number" name="children_count" class="form-control" value="0" min="0" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Booking Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="CONFIRMED">CONFIRMED</option>
                                        <option value="CHECKED_IN">CHECKED_IN</option>
                                        <option value="CHECKED_OUT">CHECKED_OUT</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                        <option value="NO_SHOW">NO_SHOW</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Special Requests</label>
                                    <textarea name="special_instructions" class="form-control" rows="2" placeholder="Late check-in, extra towels, etc."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Booking</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- 2. EDIT RESERVATION MODAL                                                 -->
                <div class="modal fade" id="editReservationModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form id="editReservationForm" method="POST" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Modify Reservation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Reservation Reference</label>
                                    <input type="text" name="reservation_no" id="edit_reservation_no" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Booking Source</label>
                                    <select name="booking_source" id="edit_booking_source" class="form-select" required>
                                        <option value="DIRECT">DIRECT</option>
                                        <option value="WEBSITE">WEBSITE</option>
                                        <option value="OTA_BOOKING">OTA_BOOKING</option>
                                        <option value="OTA_EXPEDIA">OTA_EXPEDIA</option>
                                        <option value="PHONE">PHONE</option>
                                        <option value="WALK_IN">WALK_IN</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Guest</label>
                                    <select name="guest_id" id="edit_guest_id" class="form-select" required>
                                        @foreach($guests as $guest)
                                        <option value="{{ $guest->id }}">{{ $guest->last_name }}, {{ $guest->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Villa / Room</label>
                                    <select name="room_id" id="edit_room_id" class="form-select" required>
                                        @foreach($availableRooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Check-In Date</label>
                                    <input type="date" name="check_in_date" id="edit_check_in_date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Check-Out Date</label>
                                    <input type="date" name="check_out_date" id="edit_check_out_date" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Nightly Rate ($)</label>
                                    <input type="number" step="0.01" name="nightly_rate" id="edit_nightly_rate" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Adults Count</label>
                                    <input type="number" name="adults_count" id="edit_adults_count" class="form-control" min="1" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Children Count</label>
                                    <input type="number" name="children_count" id="edit_children_count" class="form-control" min="0" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Status</label>
                                    <select name="status" id="edit_status" class="form-select" required>
                                        <option value="CONFIRMED">CONFIRMED</option>
                                        <option value="CHECKED_IN">CHECKED_IN</option>
                                        <option value="CHECKED_OUT">CHECKED_OUT</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                        <option value="NO_SHOW">NO_SHOW</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Special Requests</label>
                                    <textarea name="special_instructions" id="edit_special_instructions" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Booking</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Pagination / Footer Controls -->
                <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <span class="text-muted small" style="font-size: 0.78rem;">
                        Showing <span class="fw-bold text-dark">1 - 6</span> of <span class="fw-bold text-dark">28</span> reservations
                    </span>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--mv-primary); border-color: var(--mv-primary);">1</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-res-btn');
            const form = document.getElementById('editReservationForm');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    form.action = `admin/reservations/${id}`;

                    document.getElementById('edit_reservation_no').value = button.getAttribute('data-no');
                    document.getElementById('edit_booking_source').value = button.getAttribute('data-source');
                    document.getElementById('edit_guest_id').value = button.getAttribute('data-guest');
                    document.getElementById('edit_room_id').value = button.getAttribute('data-room');
                    document.getElementById('edit_check_in_date').value = button.getAttribute('data-checkin');
                    document.getElementById('edit_check_out_date').value = button.getAttribute('data-checkout');
                    document.getElementById('edit_nightly_rate').value = button.getAttribute('data-rate');
                    document.getElementById('edit_adults_count').value = button.getAttribute('data-adults');
                    document.getElementById('edit_children_count').value = button.getAttribute('data-children');
                    document.getElementById('edit_status').value = button.getAttribute('data-status');
                    document.getElementById('edit_special_instructions').value = button.getAttribute('data-instructions');
                });
            });
        });
    </script>
</body>

</html>