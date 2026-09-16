<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde - Maintenance & Operations</title>

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

            /* Work Order Status Colors */
            --status-inprogress-bg: #E6EEF3;
            --status-inprogress-txt: #0A3251;
            --status-pendingparts-bg: #FBF3D8;
            --status-pendingparts-txt: #AD8322;
            --status-scheduled-bg: #F1EDFF;
            --status-scheduled-txt: #6F42C1;
            --status-resolved-bg: #E2F4EA;
            --status-resolved-txt: #1C7C4C;

            /* Priority Badges */
            --prio-critical-bg: #FDE8E8;
            --prio-critical-txt: #DC3545;
            --prio-high-bg: #FDEBD0;
            --prio-high-txt: #B9770E;
            --prio-medium-bg: #ECEFF1;
            --prio-medium-txt: #455A64;
            --prio-preventive-bg: #E8F5E9;
            --prio-preventive-txt: #2E7D32;
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

        /* ==================== MAINTENANCE COMPONENTS ==================== */
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

        /* Work Order Card & Table */
        .wo-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
        }

        .wo-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            color: #8A8D86;
            border-bottom: 1px solid var(--mv-border);
            padding: 0.85rem 1rem;
            background-color: #FAFAF8;
        }

        .wo-table td {
            font-size: 0.85rem;
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F0ECE4;
        }

        .location-tag {
            font-size: 0.75rem;
            border: 1px solid #E5E0D4;
            border-radius: 4px;
            padding: 2px 7px;
            background: #FAF8F5;
            font-weight: 600;
            color: var(--mv-primary);
            display: inline-block;
        }

        .ooo-highlight {
            border-color: #F8D7DA !important;
            background-color: #FDF2F2 !important;
            color: #DC3545 !important;
        }

        /* Badges */
        .priority-badge {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            padding: 2px 7px;
            border-radius: 3px;
            display: inline-block;
        }

        .priority-critical {
            background-color: var(--prio-critical-bg);
            color: var(--prio-critical-txt);
        }

        .priority-high {
            background-color: var(--prio-high-bg);
            color: var(--prio-high-txt);
        }

        .priority-medium {
            background-color: var(--prio-medium-bg);
            color: var(--prio-medium-txt);
        }

        .priority-preventive {
            background-color: var(--prio-preventive-bg);
            color: var(--prio-preventive-txt);
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

        .status-pill-inprogress {
            background-color: var(--status-inprogress-bg);
            color: var(--status-inprogress-txt);
        }

        .status-pill-pendingparts {
            background-color: var(--status-pendingparts-bg);
            color: var(--status-pendingparts-txt);
        }

        .status-pill-scheduled {
            background-color: var(--status-scheduled-bg);
            color: var(--status-scheduled-txt);
        }

        .status-pill-resolved {
            background-color: var(--status-resolved-bg);
            color: var(--status-resolved-txt);
        }

        .tech-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #EDE8DD;
            color: var(--mv-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.72rem;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    <!-- ==================== FULL-HEIGHT SIDEBAR ==================== -->
    <aside class="offcanvas-lg offcanvas-start sidebar text-white p-3" tabindex="-1" id="sidebarMenu">
        <div>
            <!-- Brand Logo Header -->
            <div class="d-flex align-items-center gap-2 logo-container">
                <div class="rounded d-flex align-items-center justify-content-center fw-bold"
                    style="width: 36px; height: 36px; background-color: var(--mv-gold); color: #1B3527; font-family: 'Playfair Display', serif; font-size: 1.35rem;">
                    M
                </div>
                <div>
                    <h6 class="font-script mb-0 text-white fs-5" style="letter-spacing: 0.5px; line-height: 1.1;">Maison Verde</h6>
                    <span style="font-size: 0.55rem; letter-spacing: 1.6px; opacity: 0.65; display: block; text-transform: uppercase;">Resort & Spa</span>
                </div>
                <button type="button" class="btn-close btn-close-white ms-auto d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
            </div>

            <!-- Navigation Links -->
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">01</span><i class="bi bi-grid me-2"></i> Overview</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">02</span><i class="bi bi-calendar3 me-2"></i> Reservations</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">03</span><i class="bi bi-door-closed me-2"></i> Front Office</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">04</span><i class="bi bi-building me-2"></i> Property</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active"><span class="index-num">05</span><i class="bi bi-wrench me-2"></i> Operations</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">06</span><i class="bi bi-star me-2"></i> Services</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">07</span><i class="bi bi-people me-2"></i> Guests</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">08</span><i class="bi bi-receipt me-2"></i> Finance</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">09</span><i class="bi bi-gear me-2"></i> Administration</a>
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

    <!-- ==================== MAIN CONTENT WRAPPER ==================== -->
    <div class="main-wrapper">

        <!-- Top Navigation Bar -->
        <nav class="navbar top-navbar px-3 px-lg-4">
            <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

                <!-- Left: Search Bar & Mobile Trigger -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="bi bi-list fs-3 text-dark"></i>
                    </button>

                    <div class="search-container">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.85rem;"></i>
                        <input type="text" class="search-input" placeholder="Search work order #, room, technician, asset..." />
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

        <!-- Page Body Content -->
        <main class="px-4 py-4">

            <!-- Section Title & Action Buttons -->
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <h1 class="display-6 font-script fw-bold mb-1">Maintenance</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">05</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">Engineering & Facility Work Orders</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <!-- Action Tools -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                        <i class="bi bi-tools me-1"></i> Asset Inventory
                    </button>
                    <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i> Create Work Order
                    </button>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Open Work Orders</div>
                        <div class="value mt-1">7</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">5 in progress &middot; 2 pending parts</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card" style="border-left: 3px solid #DC3545;">
                        <div class="label">Out of Order Rooms</div>
                        <div class="value mt-1 text-danger">2</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;"><span class="fw-semibold text-dark">Room 204</span> &amp; <span class="fw-semibold text-dark">Villa 05</span></div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Urgent Priority</div>
                        <div class="value mt-1" style="color: var(--mv-gold);">2</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Require same-day completion</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Avg Resolution Time</div>
                        <div class="value mt-1" style="color: var(--mv-primary);">2.4h</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Within 3h resort SLA target</div>
                    </div>
                </div>
            </div>

            <!-- Main Work Orders Card -->
            <div class="wo-card overflow-hidden">

                <!-- Table Toolbar: Filters & Views -->
                <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <!-- Category Filter Tabs -->
                    <div class="btn-group filter-btn-group shadow-sm rounded">
                        <button type="button" class="btn active">All Tickets (7)</button>
                        <button type="button" class="btn">Guest Rooms (4)</button>
                        <button type="button" class="btn">OOO Rooms (2)</button>
                        <button type="button" class="btn">Public Areas & Spa (2)</button>
                        <button type="button" class="btn">Preventive (1)</button>
                    </div>

                    <!-- Trade / Category Quick Filter -->
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 210px;">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-funnel text-muted"></i></span>
                            <select class="form-select bg-light border-start-0 text-muted small">
                                <option selected>All Trades & Disciplines</option>
                                <option value="1">HVAC / Air Conditioning</option>
                                <option value="2">Plumbing & Water</option>
                                <option value="3">Electrical & Lighting</option>
                                <option value="4">Carpentry & Structural</option>
                                <option value="5">Pool & Jacuzzi</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!--  -->
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

                <!-- Work Orders Ledger Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Villa / Room</th>
                                <th>Issue Summary</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Assigned Tech</th>
                                <th>Cost</th>
                                <th>Logged At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                            @php
                            $priorityBadges = [
                            'LOW' => 'bg-secondary',
                            'MEDIUM' => 'bg-info text-dark',
                            'HIGH' => 'bg-warning text-dark',
                            'CRITICAL' => 'bg-danger',
                            ];
                            $statusBadges = [
                            'PENDING' => 'bg-danger-subtle text-danger border border-danger-subtle',
                            'IN_PROGRESS' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                            'RESOLVED' => 'bg-success-subtle text-success border border-success-subtle',
                            'CANCELLED' => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                            ];
                            $priorityClass = $priorityBadges[$ticket->priority] ?? 'bg-secondary';
                            $statusClass = $statusBadges[$ticket->status] ?? 'bg-secondary-subtle text-secondary';
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold">{{ $ticket->room->room_number ?? 'N/A' }}</span>
                                    <div class="text-muted small">{{ $ticket->room->room_type ?? '' }}</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $ticket->issue_title }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 250px;">
                                        {{ $ticket->description }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $priorityClass }}">{{ $ticket->priority }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $statusClass }}">{{ str_replace('_', ' ', $ticket->status) }}</span>
                                </td>
                                <td>
                                    <div>{{ $ticket->assignee->full_name ?? 'Unassigned' }}</div>
                                    <div class="text-muted small">Rep: {{ $ticket->reporter->full_name ?? 'System' }}</div>
                                </td>
                                <td>
                                    @if($ticket->cost)
                                    <span class="fw-bold">${{ number_format($ticket->cost, 2) }}</span>
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $ticket->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary edit-ticket-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editTicketModal"
                                            data-id="{{ $ticket->id }}"
                                            data-room="{{ $ticket->room_id }}"
                                            data-assigned="{{ $ticket->assigned_to }}"
                                            data-title="{{ $ticket->issue_title }}"
                                            data-description="{{ $ticket->description }}"
                                            data-priority="{{ $ticket->priority }}"
                                            data-status="{{ $ticket->status }}"
                                            data-cost="{{ $ticket->cost }}"
                                            data-started="{{ $ticket->started_at ? $ticket->started_at->format('Y-m-d\TH:i') : '' }}"
                                            data-resolved="{{ $ticket->resolved_at ? $ticket->resolved_at->format('Y-m-d\TH:i') : '' }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.maintenance.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Delete ticket #{{ $ticket->id }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">No maintenance orders logged.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- 1. CREATE TICKET MODAL                                                    -->
                <div class="modal fade" id="createTicketModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form action="{{ route('admin.maintenance.store') }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Create Maintenance Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Affected Room / Villa</label>
                                    <select name="room_id" class="form-select" required>
                                        <option value="">-- Choose Villa --</option>
                                        @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Assign Technician</label>
                                    <select name="assigned_to" class="form-select">
                                        <option value="">-- Unassigned --</option>
                                        @foreach($technicians as $tech)
                                        <option value="{{ $tech->id }}">{{ $tech->full_name }} (&#64;{{ $tech->username }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Issue Title</label>
                                    <input type="text" name="issue_title" class="form-control" placeholder="e.g. Master bathroom AC leaking" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Detailed Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Describe symptoms, equipment codes, or notes..." required></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Priority</label>
                                    <select name="priority" class="form-select" required>
                                        <option value="LOW">LOW</option>
                                        <option value="MEDIUM" selected>MEDIUM</option>
                                        <option value="HIGH">HIGH</option>
                                        <option value="CRITICAL">CRITICAL</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Initial Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="PENDING" selected>PENDING</option>
                                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                                        <option value="RESOLVED">RESOLVED</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Estimated Cost ($)</label>
                                    <input type="number" step="0.01" name="cost" class="form-control" placeholder="0.00">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Started At</label>
                                    <input type="datetime-local" name="started_at" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Resolved At</label>
                                    <input type="datetime-local" name="resolved_at" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Create Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 2. EDIT TICKET MODAL                                                      -->
                <div class="modal fade" id="editTicketModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form id="editTicketForm" method="POST" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Edit Maintenance Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Room / Villa</label>
                                    <select name="room_id" id="edit_room_id" class="form-select" required>
                                        @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Assign Technician</label>
                                    <select name="assigned_to" id="edit_assigned_to" class="form-select">
                                        <option value="">-- Unassigned --</option>
                                        @foreach($technicians as $tech)
                                        <option value="{{ $tech->id }}">{{ $tech->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Issue Title</label>
                                    <input type="text" name="issue_title" id="edit_issue_title" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Description</label>
                                    <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Priority</label>
                                    <select name="priority" id="edit_priority" class="form-select" required>
                                        <option value="LOW">LOW</option>
                                        <option value="MEDIUM">MEDIUM</option>
                                        <option value="HIGH">HIGH</option>
                                        <option value="CRITICAL">CRITICAL</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Ticket Status</label>
                                    <select name="status" id="edit_status" class="form-select" required>
                                        <option value="PENDING">PENDING</option>
                                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                                        <option value="RESOLVED">RESOLVED</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Repair Cost ($)</label>
                                    <input type="number" step="0.01" name="cost" id="edit_cost" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Started At</label>
                                    <input type="datetime-local" name="started_at" id="edit_started_at" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Resolved At</label>
                                    <input type="datetime-local" name="resolved_at" id="edit_resolved_at" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Pagination / Footer Controls -->
                <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <span class="text-muted small" style="font-size: 0.78rem;">
                        Showing <span class="fw-bold text-dark">1 - 6</span> of <span class="fw-bold text-dark">7</span> active orders
                    </span>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--mv-primary); border-color: var(--mv-primary);">1</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

            </div>

        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script for Dynamic Modal Rewriting -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-ticket-btn');
            const form = document.getElementById('editTicketForm');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');

                    // Direct route mapping matching Route::put('/admin/maintenance/{id}')
                    form.action = `/admin/maintenance/${id}`;

                    document.getElementById('edit_room_id').value = button.getAttribute('data-room');
                    document.getElementById('edit_assigned_to').value = button.getAttribute('data-assigned') || '';
                    document.getElementById('edit_issue_title').value = button.getAttribute('data-title');
                    document.getElementById('edit_description').value = button.getAttribute('data-description');
                    document.getElementById('edit_priority').value = button.getAttribute('data-priority');
                    document.getElementById('edit_status').value = button.getAttribute('data-status');
                    document.getElementById('edit_cost').value = button.getAttribute('data-cost');
                    document.getElementById('edit_started_at').value = button.getAttribute('data-started');
                    document.getElementById('edit_resolved_at').value = button.getAttribute('data-resolved');
                });
            });
        });
    </script>
</body>

</html>