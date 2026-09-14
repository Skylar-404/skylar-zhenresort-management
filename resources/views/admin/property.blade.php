<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde - Property / Room Inventory</title>

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
                    <a href="#" class="nav-link"><span class="index-num">01</span><i class="bi bi-grid me-2"></i> Overview</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">02</span><i class="bi bi-calendar3 me-2"></i> Reservations</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">03</span><i class="bi bi-door-closed me-2"></i> Front Office</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active"><span class="index-num">04</span><i class="bi bi-building me-2"></i> Property</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><span class="index-num">05</span><i class="bi bi-wrench me-2"></i> Operations</a>
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
            <a href="#" class="nav-link px-1 mb-2 text-white-50 small">
                <i class="bi bi-layout-sidebar-inset me-2"></i> Collapse
            </a>
            <div class="d-flex align-items-center gap-2 mt-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                    style="width: 32px; height: 32px; background-color: var(--mv-gold); color: #1B3527; font-size: 0.75rem;">
                    AV
                </div>
                <div style="line-height: 1.2;">
                    <div class="fw-semibold text-white small">JohnPork</div>
                    <span style="font-size: 0.68rem; opacity: 0.6;">Front Desk Manager</span>
                </div>
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
                <!--  -->

                {{-- Feedback Notifications --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- Villa Grid --}}
                <div class="row g-4">
                    @forelse($rooms as $room)
                    @php
                    $statusColors = [
                    'AVAILABLE' => 'bg-success',
                    'CLEAN' => 'bg-info text-dark',
                    'INSPECTED' => 'bg-primary',
                    'RESERVED' => 'bg-secondary',
                    'OCCUPIED' => 'bg-dark',
                    'DIRTY' => 'bg-warning text-dark',
                    'UNDER_MAINTENANCE' => 'bg-danger',
                    'OUT_OF_ORDER' => 'bg-danger',
                    'BLOCKED' => 'bg-secondary',
                    ];
                    $badgeClass = $statusColors[$room->status] ?? 'bg-secondary';
                    @endphp

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <small class="text-muted text-uppercase fw-bold">{{ $room->room_type }} </small>
                                        <h5 class="card-title fw-bold mb-0">{{ $room->room_number }}</h5>
                                    </div>
                                    <span class="badge {{ $badgeClass }}">{{ str_replace('_', ' ', $room->status) }}</span>
                                </div>
                                <p class="text-primary fw-medium small mb-3">{{ $room->building_code }} &bull; F{{ $room->floor_number }}</p>

                                <ul class="list-group list-group-flush small mb-3">
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Rate:</span>
                                        <strong>${{ number_format($room->base_rate, 2) }} /night</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Max Capacity:</span>
                                        <span>{{ $room->max_capacity }} Guests</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        <span>Smoking:</span>
                                        <span>{{ $room->is_smoking ? 'Allowed' : 'Non-Smoking' }}</span>
                                    </li>
                                </ul>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Edit Button (stores record attributes in data-* attributes) -->
                                    <button type="button"
                                        class="btn btn-sm btn-outline-secondary edit-room-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal"
                                        data-id="{{ $room->id }}"
                                        data-building="{{ $room->building_code }}"
                                        data-number="{{ $room->room_number }}"
                                        data-floor="{{ $room->floor_number }}"
                                        data-type="{{ $room->room_type }}"
                                        data-rate="{{ $room->base_rate }}"
                                        data-capacity="{{ $room->max_capacity }}"
                                        data-status="{{ $room->status }}"
                                        data-smoking="{{ $room->is_smoking }}">
                                        Edit
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete room {{ $room->room_number }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center py-5">No rooms available.</div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 1. CREATE ROOM MODAL                                                      -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="createRoomModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('rooms.store') }}" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Add New Villa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Building Code</label>
                                <input type="text" name="building_code" class="form-control" placeholder="e.g. OCEAN" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Number</label>
                                <input type="text" name="room_number" class="form-control" placeholder="e.g. OP-205" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Floor Number</label>
                                <input type="number" name="floor_number" class="form-control" value="1" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Type</label>
                                <select name="room_type" class="form-select" required>
                                    <option value="Tropical garden suite">Tropical garden suite</option>
                                    <option value="ocean pool">ocean pool</option>
                                    <option value="Ultimate Suite Villa">Ultimate Suite Villa</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Base Rate ($)</label>
                                <input type="number" step="0.01" name="base_rate" class="form-control" placeholder="200.00" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Max Capacity</label>
                                <input type="number" name="max_capacity" class="form-control" value="2" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="AVAILABLE">AVAILABLE</option>
                                    <option value="CLEAN">CLEAN</option>
                                    <option value="DIRTY">DIRTY</option>
                                    <option value="OCCUPIED">OCCUPIED</option>
                                    <option value="UNDER_MAINTENANCE">UNDER MAINTENANCE</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Smoking</label>
                                <select name="is_smoking" class="form-select">
                                    <option value="0">Non-Smoking</option>
                                    <option value="1">Smoking Allowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Villa</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 2. EDIT ROOM MODAL (Shared dynamically across all cards)                   -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="editRoomForm" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Edit Villa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Building Code</label>
                                <input type="text" name="building_code" id="edit_building_code" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Number</label>
                                <input type="text" name="room_number" id="edit_room_number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Floor Number</label>
                                <input type="number" name="floor_number" id="edit_floor_number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Room Type</label>
                                <select name="room_type" id="edit_room_type" class="form-select" required>
                                    <option value="Tropical garden suite">Tropical garden suite</option>
                                    <option value="ocean pool">ocean pool</option>
                                    <option value="Ultimate Suite Villa">Ultimate Suite Villa</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Base Rate ($)</label>
                                <input type="number" step="0.01" name="base_rate" id="edit_base_rate" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Max Capacity</label>
                                <input type="number" name="max_capacity" id="edit_max_capacity" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="AVAILABLE">AVAILABLE</option>
                                    <option value="CLEAN">CLEAN</option>
                                    <option value="INSPECTED">INSPECTED</option>
                                    <option value="RESERVED">RESERVED</option>
                                    <option value="OCCUPIED">OCCUPIED</option>
                                    <option value="DIRTY">DIRTY</option>
                                    <option value="UNDER_MAINTENANCE">UNDER MAINTENANCE</option>
                                    <option value="OUT_OF_ORDER">OUT OF ORDER</option>
                                    <option value="BLOCKED">BLOCKED</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Smoking</label>
                                <select name="is_smoking" id="edit_is_smoking" class="form-select">
                                    <option value="0">Non-Smoking</option>
                                    <option value="1">Smoking Allowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Villa</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bootstrap 5 JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Script to populate Edit Modal dynamically -->
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const editButtons = document.querySelectorAll('.edit-room-btn');
                    const form = document.getElementById('editRoomForm');

                    editButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const id = button.getAttribute('data-id');

                            // Update form action dynamically to match PUT /rooms/{id}
                            form.action = `/rooms/${id}`;

                            // Populate form inputs with existing room data
                            document.getElementById('edit_building_code').value = button.getAttribute('data-building');
                            document.getElementById('edit_room_number').value = button.getAttribute('data-number');
                            document.getElementById('edit_floor_number').value = button.getAttribute('data-floor');
                            document.getElementById('edit_room_type').value = button.getAttribute('data-type');
                            document.getElementById('edit_base_rate').value = button.getAttribute('data-rate');
                            document.getElementById('edit_max_capacity').value = button.getAttribute('data-capacity');
                            document.getElementById('edit_status').value = button.getAttribute('data-status');
                            document.getElementById('edit_is_smoking').value = button.getAttribute('data-smoking');
                        });
                    });
                });
            </script>
</body>

</html>