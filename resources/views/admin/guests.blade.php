<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde - Guests CRM</title>

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

            /* Guest Status Pill Colors */
            --status-inhouse-bg: #E2F4EA;
            --status-inhouse-txt: #1C7C4C;
            --status-arriving-bg: #E6EEF3;
            --status-arriving-txt: #0A3251;
            --status-upcoming-bg: #F1EDFF;
            --status-upcoming-txt: #6F42C1;
            --status-past-bg: #F1F3F5;
            --status-past-txt: #6C757D;

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

        /* ==================== GUEST CRM COMPONENTS ==================== */
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

        /* Guest Table Card */
        .guest-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
        }

        .guest-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            color: #8A8D86;
            border-bottom: 1px solid var(--mv-border);
            padding: 0.85rem 1rem;
            background-color: #FAFAF8;
        }

        .guest-table td {
            font-size: 0.85rem;
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F0ECE4;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
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

        .status-pill-inhouse {
            background-color: var(--status-inhouse-bg);
            color: var(--status-inhouse-txt);
        }

        .status-pill-arriving {
            background-color: var(--status-arriving-bg);
            color: var(--status-arriving-txt);
        }

        .status-pill-upcoming {
            background-color: var(--status-upcoming-bg);
            color: var(--status-upcoming-txt);
        }

        .status-pill-past {
            background-color: var(--status-past-bg);
            color: var(--status-past-txt);
        }

        /* Preference Tags */
        .pref-tag {
            font-size: 0.68rem;
            color: #61665D;
            background: #F4F1EA;
            border-radius: 3px;
            padding: 2px 6px;
            display: inline-block;
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
                        <input type="text" class="search-input" placeholder="Search guests by name, email, country, phone, folio..." />
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
                    <h1 class="display-6 font-script fw-bold mb-1">Guests</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">07</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">Guest CRM & Profiles</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <!-- Action Tools -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                        <i class="bi bi-cloud-arrow-down me-1"></i> Export CRM
                    </button>
                    <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createGuestModal">
                        <i class="bi bi-person-plus"></i> Add New Profile
                    </button>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Total Guest Profiles</div>
                        <div class="value mt-1">{{ $totalGuests }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">+{{ $totalGuests }} added this month</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Currently In-House</div>
                        <div class="value mt-1">{{ $activeProfiles }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;"><span class="text-success fw-bold">9</span> rooms occupied</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Club VIP Members</div>
                        <div class="value mt-1" style="color: var(--mv-gold);">{{ $vipGuests }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Platinum & Gold tiers</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Average Lifetime Spend</div>
                        <div class="value mt-1" style="color: var(--mv-primary);">$ - </div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Top 10% avg $14,900</div>
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

            <!-- Main CRM Card -->
            <div class="guest-card overflow-hidden">

                <!-- Table Toolbar: Filters & Views -->
                <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <!-- Category Filter Tabs -->
                    <div class="btn-group filter-btn-group shadow-sm rounded">
                        <button type="button" class="btn active">All Profiles</button>
                        <button type="button" class="btn">In-House (9)</button>
                        <button type="button" class="btn">Arriving Today (5)</button>
                        <button type="button" class="btn">VIP Club</button>
                        <button type="button" class="btn">Preferences Alert</button>
                    </div>

                    <!-- Tier Quick Filter -->
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-award text-muted"></i></span>
                            <select class="form-select bg-light border-start-0 text-muted small">
                                <option selected>All Membership Tiers</option>
                                <option value="1">Platinum</option>
                                <option value="2">Gold</option>
                                <option value="3">Silver</option>
                                <option value="4">Standard</option>
                            </select>
                        </div>
                    </div>

                </div>
                <!--  -->
                <!--  -->

                {{-- Feedback Notifications --}}
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

                <!-- Guest Records Table -->
                <div class="table-responsive">
                    <table class="table guest-table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Full Name</th>
                                <th>Contact</th>
                                <th>Identification</th>
                                <th>Country / City</th>
                                <th>VIP Tier</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guests as $guest)
                            @php
                            $vipBadges = [
                            'STANDARD' => 'bg-secondary',
                            'SILVER' => 'bg-info text-dark',
                            'GOLD' => 'bg-warning text-dark',
                            'PLATINUM' => 'bg-dark',
                            ];
                            $badgeClass = $vipBadges[$guest->vip_status] ?? 'bg-secondary';
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $guest->full_name }}</div>
                                    @if($guest->special_requests)
                                    <small class="text-muted d-block text-truncate" style="max-width: 200px;">
                                        Note: {{ $guest->special_requests }}
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $guest->phone }}</div>
                                    <div class="text-muted small">{{ $guest->email ?? 'No email' }}</div>
                                </td>
                                <td>
                                    <div><span class="fw-semibold">{{ $guest->identification_no }}</span></div>
                                    <small class="text-muted">{{ str_replace('_', ' ', $guest->identification_type) }}</small>
                                </td>
                                <td>
                                    <span>{{ $guest->country_code }}</span> - {{ $guest->city ?? 'N/A' }}
                                </td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">{{ $guest->vip_status }}</span>
                                </td>
                                <td>
                                    @if($guest->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                                    @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary edit-guest-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editGuestModal"
                                            data-id="{{ $guest->id }}"
                                            data-first="{{ $guest->first_name }}"
                                            data-last="{{ $guest->last_name }}"
                                            data-email="{{ $guest->email }}"
                                            data-phone="{{ $guest->phone }}"
                                            data-idtype="{{ $guest->identification_type }}"
                                            data-idno="{{ $guest->identification_no }}"
                                            data-country="{{ $guest->country_code }}"
                                            data-city="{{ $guest->city }}"
                                            data-address="{{ $guest->address }}"
                                            data-vip="{{ $guest->vip_status }}"
                                            data-requests="{{ $guest->special_requests }}"
                                            data-active="{{ $guest->is_active }}">
                                            Edit
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Archive guest {{ $guest->full_name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No guests registered.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination / Footer Controls -->
                <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <span class="text-muted small" style="font-size: 0.78rem;">
                        Showing <span class="fw-bold text-dark">1 - 6</span> of <span class="fw-bold text-dark">1,428</span> guests
                    </span>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#" style="background-color: var(--mv-primary); border-color: var(--mv-primary);">1</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">... 238</a></li>
                            <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- 1. CREATE GUEST MODAL                                                     -->
                <div class="modal fade" id="createGuestModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form action="{{ route('admin.guests.store') }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Register Guest</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">First Name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="e.g. Jonathan" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="e.g. Miller" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="+14155552671" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="jmiller@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">ID Document Type</label>
                                    <select name="identification_type" class="form-select" required>
                                        <option value="PASSPORT">PASSPORT</option>
                                        <option value="NATIONAL_ID">NATIONAL_ID</option>
                                        <option value="DRIVING_LICENSE">DRIVING_LICENSE</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Identification Document Number</label>
                                    <input type="text" name="identification_no" class="form-control" placeholder="PA987654321" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Country Code (2-letter)</label>
                                    <input type="text" name="country_code" class="form-control" placeholder="US" maxlength="2" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="San Francisco">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">VIP Status</label>
                                    <select name="vip_status" class="form-select" required>
                                        <option value="STANDARD">STANDARD</option>
                                        <option value="SILVER">SILVER</option>
                                        <option value="GOLD">GOLD</option>
                                        <option value="PLATINUM">PLATINUM</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Street Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="742 Evergreen Terr">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Account State</label>
                                    <select name="is_active" class="form-select" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Special Requests / Dietary Needs</label>
                                    <textarea name="special_requests" class="form-control" rows="2" placeholder="Late check-out, extra beach towels, allergies..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Guest</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 2. EDIT GUEST MODAL                                                       -->
                <div class="modal fade" id="editGuestModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <form id="editGuestForm" method="POST" class="modal-content">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Edit Guest Profile</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">First Name</label>
                                    <input type="text" name="first_name" id="edit_first_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Last Name</label>
                                    <input type="text" name="last_name" id="edit_last_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="text" name="phone" id="edit_phone" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" name="email" id="edit_email" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">ID Document Type</label>
                                    <select name="identification_type" id="edit_id_type" class="form-select" required>
                                        <option value="PASSPORT">PASSPORT</option>
                                        <option value="NATIONAL_ID">NATIONAL_ID</option>
                                        <option value="DRIVING_LICENSE">DRIVING_LICENSE</option>
                                        <option value="OTHER">OTHER</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Identification Document Number</label>
                                    <input type="text" name="identification_no" id="edit_id_no" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Country Code (2-letter)</label>
                                    <input type="text" name="country_code" id="edit_country" class="form-control" maxlength="2" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">City</label>
                                    <input type="text" name="city" id="edit_city" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">VIP Status</label>
                                    <select name="vip_status" id="edit_vip" class="form-select" required>
                                        <option value="STANDARD">STANDARD</option>
                                        <option value="SILVER">SILVER</option>
                                        <option value="GOLD">GOLD</option>
                                        <option value="PLATINUM">PLATINUM</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Street Address</label>
                                    <input type="text" name="address" id="edit_address" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Account State</label>
                                    <select name="is_active" id="edit_is_active" class="form-select" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Special Requests / Dietary Needs</label>
                                    <textarea name="special_requests" id="edit_requests" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Guest</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const editButtons = document.querySelectorAll('.edit-guest-btn');
                        const form = document.getElementById('editGuestForm');

                        editButtons.forEach(button => {
                            button.addEventListener('click', () => {
                                const id = button.getAttribute('data-id');
                                form.action = `/admin/guests/${id}`;

                                document.getElementById('edit_first_name').value = button.getAttribute('data-first');
                                document.getElementById('edit_last_name').value = button.getAttribute('data-last');
                                document.getElementById('edit_phone').value = button.getAttribute('data-phone');
                                document.getElementById('edit_email').value = button.getAttribute('data-email');
                                document.getElementById('edit_id_type').value = button.getAttribute('data-idtype');
                                document.getElementById('edit_id_no').value = button.getAttribute('data-idno');
                                document.getElementById('edit_country').value = button.getAttribute('data-country');
                                document.getElementById('edit_city').value = button.getAttribute('data-city');
                                document.getElementById('edit_address').value = button.getAttribute('data-address');
                                document.getElementById('edit_vip').value = button.getAttribute('data-vip');
                                document.getElementById('edit_requests').value = button.getAttribute('data-requests');
                                document.getElementById('edit_is_active').value = button.getAttribute('data-active');
                            });
                        });
                    });
                </script>
</body>

</html>