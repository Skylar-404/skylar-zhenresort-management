<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Property / Room Inventory</title>

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
            /* Exact Primary Dark Forest Green */
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
            --status-occupied-bg: #1B3527;
            --status-occupied-txt: #FFFFFF;
            --status-dirty-bg: #FBF3D8;
            --status-dirty-txt: #AD8322;
            --status-avail-bg: #E2F4EA;
            --status-avail-txt: #1C7C4C;
            --status-cleaning-bg: #E5EFFF;
            --status-cleaning-txt: #3B71CA;
            --status-reserved-bg: #F1EDFF;
            --status-reserved-txt: #6F42C1;
            --status-ooo-bg: #FDE8E8;
            --status-ooo-txt: #DC3545;
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

        /* ==================== SIDEBAR (Full Height from top: 0) ==================== */
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

        /* Logo Box */
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

        /* ==================== MAIN WRAPPER (Offset for Sidebar) ==================== */
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

        /* ==================== ROOM INVENTORY CARDS ==================== */
        .room-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 6px;
            padding: 1rem 1.1rem;
            transition: box-shadow 0.2s ease;
        }

        .room-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .spec-pill {
            font-size: 0.7rem;
            color: #797D76;
            border: 1px solid #E5E0D4;
            border-radius: 4px;
            padding: 2px 7px;
            background-color: #FCFAF7;
        }

        /* Filter Buttons */
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

        /* Status Badges */
        .badge-status {
            font-size: 0.68rem;
            font-weight: 600;
            border-radius: 4px;
            padding: 3px 8px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .badge-status::before {
            content: "";
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: currentColor;
        }

        .badge-occupied {
            background-color: var(--status-occupied-bg);
            color: var(--status-occupied-txt);
        }

        .badge-occupied::before {
            background-color: var(--mv-gold);
        }

        .badge-dirty {
            background-color: var(--status-dirty-bg);
            color: var(--status-dirty-txt);
        }

        .badge-available {
            background-color: var(--status-avail-bg);
            color: var(--status-avail-txt);
        }

        .badge-cleaning {
            background-color: var(--status-cleaning-bg);
            color: var(--status-cleaning-txt);
        }

        .badge-reserved {
            background-color: var(--status-reserved-bg);
            color: var(--status-reserved-txt);
        }

        .badge-ooo {
            background-color: var(--status-ooo-bg);
            color: var(--status-ooo-txt);
        }
    </style>
</head>

<body>

    <aside class="offcanvas-lg offcanvas-start sidebar text-white p-3" tabindex="-1" id="sidebarMenu">
        <div>
            <!-- Brand Logo Header -->
            <div class="d-flex align-items-center gap-2 logo-container">
                <div>
                    <h6 class="font-script mb-0 text-white fs-5" style="letter-spacing: 0.5px; line-height: 1.1;">真 ZHEN</h6>
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

    <div class="main-wrapper">

        <!-- Top Navigation Bar (Starts right of sidebar) -->
        <nav class="navbar top-navbar px-3 px-lg-4">
            <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

                <!-- Left: Mobile Sidebar Trigger & Search Bar -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="bi bi-list fs-3 text-dark"></i>
                    </button>

                    <div class="search-container">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.85rem;"></i>
                        <input type="text" class="search-input" placeholder="Search guests, rooms, reservations, folios..." />
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

            <!-- Section Title & Filters -->
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <h1 class="display-6 font-script fw-bold mb-1">Property</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">04</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">Room Inventory</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Trigger Create Modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                            <i class="bi bi-plus-circle-dotted"></i>
                        </button>
                    </div>
                    <!-- Room Filter Button Group -->
                    <div class="btn-group filter-btn-group shadow-sm rounded">
                        <button type="button" class="btn active">All</button>
                        <button type="button" class="btn">OCEAN</button>
                        <button type="button" class="btn">GARDEN</button>
                        <button type="button" class="btn">ESTATE</button>
                    </div>
                </div>
            </div>
            <div class="container">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Villa & Room Management</h2>
                        <p class="text-muted small mb-0">Track room statuses, rates, capacity, and housekeeping availability</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Dashboard</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                            + Add Villa/Room
                        </button>
                    </div>
                </div>

                {{-- Aggregate Counters --}}
                <div class="row g-3 mb-4">
                    <div class="col-md">
                        <div class="card p-3 shadow-sm border-0">
                            <small class="text-muted text-uppercase fw-bold">Total Inventory</small>
                            <h3 class="fw-bold text-dark mt-1">{{ $totalRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card p-3 shadow-sm border-0 border-start border-success border-4">
                            <small class="text-muted text-uppercase fw-bold text-success">Available</small>
                            <h3 class="fw-bold text-success mt-1">{{ $availableRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card p-3 shadow-sm border-0 border-start border-primary border-4">
                            <small class="text-muted text-uppercase fw-bold text-primary">Occupied</small>
                            <h3 class="fw-bold text-primary mt-1">{{ $occupiedRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card p-3 shadow-sm border-0 border-start border-warning border-4">
                            <small class="text-muted text-uppercase fw-bold text-warning-emphasis">Housekeeping (Dirty)</small>
                            <h3 class="fw-bold text-warning-emphasis mt-1">{{ $dirtyRooms }}</h3>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card p-3 shadow-sm border-0 border-start border-danger border-4">
                            <small class="text-muted text-uppercase fw-bold text-danger">Out of Order</small>
                            <h3 class="fw-bold text-danger mt-1">{{ $maintenanceRooms }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Feedback Notifications --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
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

                {{-- Room Inventory Table --}}
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Villa / Room #</th>
                                    <th>Type</th>
                                    <th>Capacity</th>
                                    <th>Nightly Rate</th>
                                    <th>Status</th>
                                    <th>Quick Action (Housekeeping)</th>
                                    <th>Description</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                @php
                                $statusClasses = [
                                'AVAILABLE' => 'bg-success-subtle text-success border border-success-subtle',
                                'OCCUPIED' => 'bg-primary-subtle text-primary border border-primary-subtle',
                                'DIRTY' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                'MAINTENANCE' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                ];
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-bold fs-6">{{ $room->room_number }}</td>
                                    <td>{{ $room->room_type }}</td>
                                    <td>{{ $room->capacity }} Guests</td>
                                    <td class="fw-bold">${{ number_format($room->price_per_night, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                            {{ $room->status }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- Quick One-Click Housekeeping State Transitions --}}
                                        @if($room->status === 'DIRTY')
                                        <form action="{{ route('admin.rooms.status.update', $room->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="AVAILABLE">
                                            <button type="submit" class="btn btn-sm btn-outline-success py-0" style="font-size: 0.75rem;">
                                                &#10003; Mark Cleaned
                                            </button>
                                        </form>
                                        @elseif($room->status === 'AVAILABLE')
                                        <form action="{{ route('admin.rooms.status.update', $room->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="DIRTY">
                                            <button type="submit" class="btn btn-sm btn-outline-warning py-0" style="font-size: 0.75rem;">
                                                Mark Dirty
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-muted small">In Use</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small text-truncate" style="max-width: 250px;">
                                        {{ $room->description ?? '-' }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary edit-room-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editRoomModal"
                                                data-id="{{ $room->id }}"
                                                data-no="{{ $room->room_number }}"
                                                data-type="{{ $room->room_type }}"
                                                data-cap="{{ $room->capacity }}"
                                                data-price="{{ $room->price_per_night }}"
                                                data-status="{{ $room->status }}"
                                                data-desc="{{ $room->description }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete room {{ $room->room_number }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" {{ $room->status === 'OCCUPIED' ? 'disabled' : '' }}>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">No rooms found in inventory.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 1. CREATE ROOM MODAL                                                      -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="createRoomModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('admin.rooms.store') }}" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Add Villa / Room</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room / Villa #</label>
                                <input type="text" name="room_number" class="form-control" placeholder="e.g. V-101" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Type</label>
                                <input type="text" name="room_type" class="form-control" placeholder="e.g. Deluxe Pool Villa" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Max Guests</label>
                                <input type="number" name="capacity" class="form-control" value="2" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Price Per Night ($)</label>
                                <input type="number" step="0.01" name="price_per_night" class="form-control" placeholder="150.00" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Initial Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="AVAILABLE" selected>AVAILABLE (Ready)</option>
                                    <option value="DIRTY">DIRTY (Needs Housekeeping)</option>
                                    <option value="MAINTENANCE">MAINTENANCE (Out of Order)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Features / Notes</label>
                                <textarea name="description" class="form-control" rows="2" placeholder="King bed, private pool, ocean view..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Room</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 2. EDIT ROOM MODAL                                                        -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="editRoomForm" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Edit Villa Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room / Villa #</label>
                                <input type="text" name="room_number" id="edit_room_number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Type</label>
                                <input type="text" name="room_type" id="edit_room_type" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Max Guests</label>
                                <input type="number" name="capacity" id="edit_capacity" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Price Per Night ($)</label>
                                <input type="number" step="0.01" name="price_per_night" id="edit_price_per_night" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="AVAILABLE">AVAILABLE (Ready)</option>
                                    <option value="OCCUPIED">OCCUPIED (In-House)</option>
                                    <option value="DIRTY">DIRTY (Needs Housekeeping)</option>
                                    <option value="MAINTENANCE">MAINTENANCE (Out of Order)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Features / Notes</label>
                                <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Bootstrap 5 JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const editButtons = document.querySelectorAll('.edit-room-btn');
                    const form = document.getElementById('editRoomForm');

                    editButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');
                            form.action = `/admin/rooms/${id}`;

                            document.getElementById('edit_room_number').value = button.getAttribute('data-no');
                            document.getElementById('edit_room_type').value = button.getAttribute('data-type');
                            document.getElementById('edit_capacity').value = button.getAttribute('data-cap');
                            document.getElementById('edit_price_per_night').value = button.getAttribute('data-price');
                            document.getElementById('edit_status').value = button.getAttribute('data-status');
                            document.getElementById('edit_description').value = button.getAttribute('data-desc') || '';
                        });
                    });
                });
            </script>
</body>

</html>