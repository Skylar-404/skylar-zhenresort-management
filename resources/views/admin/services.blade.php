<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maison Verde - Experiences & Guest Services</title>

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
            --status-inprep-bg: #FBF3D8;
            --status-inprep-txt: #AD8322;
            --status-completed-bg: #E2F4EA;
            --status-completed-txt: #1C7C4C;
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

        /* ==================== SERVICES COMPONENTS ==================== */
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

        /* 4 Service Cards */
        .service-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .service-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(27, 53, 39, 0.08);
        }

        .service-card-header {
            height: 160px;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
            color: #ffffff;
        }

        /* Gradient Backdrops representing each service */
        .bg-spa {
            background: linear-gradient(135deg, rgba(27, 53, 39, 0.9), rgba(43, 98, 74, 0.75)), url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80') center/cover;
        }

        .bg-dinner {
            background: linear-gradient(135deg, rgba(74, 38, 20, 0.85), rgba(196, 154, 58, 0.75)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=600&q=80') center/cover;
        }

        .bg-temple {
            background: linear-gradient(135deg, rgba(30, 42, 56, 0.9), rgba(58, 79, 97, 0.75)), url('https://images.unsplash.com/photo-1528181304800-259b08848526?auto=format&fit=crop&w=600&q=80') center/cover;
        }

        .bg-dining {
            background: linear-gradient(135deg, rgba(35, 31, 32, 0.9), rgba(100, 85, 75, 0.75)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80') center/cover;
        }

        .service-badge-pill {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .service-card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .spec-tag {
            font-size: 0.7rem;
            color: #6d726a;
            border: 1px solid #e7e4dc;
            border-radius: 4px;
            padding: 2px 7px;
            background: #faf8f5;
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

        /* Service Orders Table */
        .service-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            color: #8A8D86;
            border-bottom: 1px solid var(--mv-border);
            padding: 0.85rem 1rem;
            background-color: #FAFAF8;
        }

        .service-table td {
            font-size: 0.85rem;
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F0ECE4;
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

        .status-pill-inprep {
            background-color: var(--status-inprep-bg);
            color: var(--status-inprep-txt);
        }

        .status-pill-completed {
            background-color: var(--status-completed-bg);
            color: var(--status-completed-txt);
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
                    <a href="#" class="nav-link"><span class="index-num">05</span><i class="bi bi-wrench me-2"></i> Operations</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active"><span class="index-num">06</span><i class="bi bi-star me-2"></i> Services</a>
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
                        <input type="text" class="search-input" placeholder="Search experiences, spa therapists, dining orders..." />
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
                    <h1 class="display-6 font-script fw-bold mb-1">Services &amp; Experiences</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">06</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">Curated Resort Concierge Offerings</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <!-- Action Tools -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                        <i class="bi bi-calendar-week me-1"></i> Today's Schedule
                    </button>
                    <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                        <i class="bi bi-plus-lg"></i> Book Guest Experience
                    </button>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Booked Experiences Today</div>
                        <div class="value mt-1">14</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">8 Completed &middot; 6 Upcoming</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Spa &amp; Tour Availability</div>
                        <div class="value mt-1" style="color: var(--mv-primary);">4 Slots</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">2 Spa &middot; 2 In-Room Dining holds</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Experience Revenue (Today)</div>
                        <div class="value mt-1" style="color: var(--mv-gold);">$3,840</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">+24% vs. weekly average</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Guest Satisfaction Score</div>
                        <div class="value mt-1 text-success">4.96</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Based on 82 post-stay reviews</div>
                    </div>
                </div>
            </div>

            <!-- 4 CURATED SERVICE OPTIONS (Grid) -->
            <h6 class="text-uppercase fw-bold text-muted small mb-3" style="letter-spacing: 1px; font-size: 0.72rem;">Available Resort Services</h6>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-5">

                <!-- Service 1: Spas -->
                <div class="col">
                    <div class="service-card">
                        <div class="service-card-header bg-spa">
                            <div>
                                <span class="service-badge-pill mb-1 d-inline-block">Wellness &amp; Health</span>
                                <h5 class="fw-bold mb-0 text-white">Pavilion Spas</h5>
                            </div>
                        </div>
                        <div class="service-card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <span class="fw-bold text-dark fs-5">$180<span class="text-muted fw-normal small">/treatment</span></span>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> 60 - 90 min</span>
                            </div>
                            <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                                Hydrotherapy baths, organic herbal compresses, and deep tissue holistic treatments under pavilion gardens.
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                                <span class="spec-tag">Couples Suites</span>
                                <span class="spec-tag">Aromatherapy</span>
                                <span class="spec-tag">Sauna</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                                Reserve Spa &rarr;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Service 2: Sunset Dinner -->
                <div class="col">
                    <div class="service-card">
                        <div class="service-card-header bg-dinner">
                            <div>
                                <span class="service-badge-pill mb-1 d-inline-block">Fine Dining</span>
                                <h5 class="fw-bold mb-0 text-white">Sunset Dinner</h5>
                            </div>
                        </div>
                        <div class="service-card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <span class="fw-bold text-dark fs-5">$220<span class="text-muted fw-normal small">/couple</span></span>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> 17:30 - 21:00</span>
                            </div>
                            <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                                Five-course culinary voyage on the ocean cliffside with vintage sommelier wine pairings and acoustic strings.
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                                <span class="spec-tag">Private Cabana</span>
                                <span class="spec-tag">5-Course</span>
                                <span class="spec-tag">Live Cello</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                                Reserve Table &rarr;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Ancient Temple Tour -->
                <div class="col">
                    <div class="service-card">
                        <div class="service-card-header bg-temple">
                            <div>
                                <span class="service-badge-pill mb-1 d-inline-block">Cultural Excursion</span>
                                <h5 class="fw-bold mb-0 text-white">Ancient Temple Tour</h5>
                            </div>
                        </div>
                        <div class="service-card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <span class="fw-bold text-dark fs-5">$160<span class="text-muted fw-normal small">/person</span></span>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> Half-Day (4.5h)</span>
                            </div>
                            <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                                Private historic expedition to sacred 12th-century forest ruins guided by certified archaeologists and monk blessing.
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                                <span class="spec-tag">Chauffeured</span>
                                <span class="spec-tag">Historian Guide</span>
                                <span class="spec-tag">VIP Pass</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                                Book Excursion &rarr;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Service 4: Food - Door to Door -->
                <div class="col">
                    <div class="service-card">
                        <div class="service-card-header bg-dining">
                            <div>
                                <span class="service-badge-pill mb-1 d-inline-block">In-Villa Experience</span>
                                <h5 class="fw-bold mb-0 text-white">Door-to-Door Dining</h5>
                            </div>
                        </div>
                        <div class="service-card-body">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <span class="fw-bold text-dark fs-5">A La Carte<span class="text-muted fw-normal small"> + $15 tray</span></span>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> 24/7 Available</span>
                            </div>
                            <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                                Gourmet silver-service meals plated directly to your room or poolside cabana with tailored wine delivery.
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                                <span class="spec-tag">Heated Tray</span>
                                <span class="spec-tag">24-Hour</span>
                                <span class="spec-tag">Private Butler</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                                Order to Room &rarr;
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TODAY'S SCHEDULED SERVICE ORDERS LEDGER -->
            <div class="card bg-white border-1 overflow-hidden" style="border-color: var(--mv-border); border-radius: 8px;">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Today's Service Manifest</h6>
                        <span class="text-muted small" style="font-size: 0.74rem;">Active itinerary and orders dispatch</span>
                    </div>
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.75rem; border-color: #D3CABA;">
                        <i class="bi bi-printer me-1"></i> Print Manifest
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table service-table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Booking ID / Time</th>
                                <th>Guest &amp; Unit</th>
                                <th>Selected Service</th>
                                <th>Details &amp; Notes</th>
                                <th>Folio Charge</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Order 1: Spa -->
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">#SRV-4182</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Today, 14:00 PM</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Tariq Al-Hassan</div>
                                    <span class="text-muted" style="font-size: 0.72rem;">Villa 02 &middot; Platinum</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><i class="bi bi-flower1 text-success me-1"></i> Pavilion Spas</span>
                                    <div class="text-muted" style="font-size: 0.7rem;">90-min Deep Tissue Herbal (2 Guests)</div>
                                </td>
                                <td><span class="text-muted small">Therapist: Mei L. &amp; Sarah K.</span></td>
                                <td><span class="fw-bold text-dark">$360.00</span></td>
                                <td>
                                    <span class="status-pill status-pill-confirmed">
                                        <i class="bi bi-check-circle-fill small"></i> Confirmed
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Modify</button>
                                    <button class="btn btn-sm btn-link text-secondary p-1 ms-1"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                            <!-- Order 2: Sunset Dinner -->
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">#SRV-4189</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Today, 18:00 PM</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Kenji Tanaka</div>
                                    <span class="text-muted" style="font-size: 0.72rem;">Room 202 &middot; Gold</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><i class="bi bi-sunset text-warning me-1"></i> Sunset Dinner</span>
                                    <div class="text-muted" style="font-size: 0.7rem;">Cliffside Table 3 (Anniversary)</div>
                                </td>
                                <td><span class="text-muted small">Vegetarian substitution for 1 guest</span></td>
                                <td><span class="fw-bold text-dark">$220.00</span></td>
                                <td>
                                    <span class="status-pill status-pill-inprep">
                                        <i class="bi bi-hourglass-split small"></i> Table In Prep
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Modify</button>
                                    <button class="btn btn-sm btn-link text-secondary p-1 ms-1"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                            <!-- Order 3: Temple Tour -->
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">#SRV-4177</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Today, 09:00 AM</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Astrid Lindqvist</div>
                                    <span class="text-muted" style="font-size: 0.72rem;">Room 303 &middot; Gold</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><i class="bi bi-bank text-primary me-1"></i> Ancient Temple Tour</span>
                                    <div class="text-muted" style="font-size: 0.7rem;">Half-Day Private Chauffeur + Guide</div>
                                </td>
                                <td><span class="text-muted small">Guide: Somnang (Chauffeur returned)</span></td>
                                <td><span class="fw-bold text-dark">$320.00</span></td>
                                <td>
                                    <span class="status-pill status-pill-completed">
                                        <i class="bi bi-check2-all small"></i> Completed
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-secondary px-2 py-1 rounded" style="font-size: 0.75rem;">Folio Billed</button>
                                    <button class="btn btn-sm btn-link text-secondary p-1 ms-1"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                            <!-- Order 4: Door to Door Food -->
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">#SRV-4194</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Today, 12:45 PM</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Priya Nair</div>
                                    <span class="text-muted" style="font-size: 0.72rem;">Room 104 &middot; Silver</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><i class="bi bi-bell-fill text-danger me-1"></i> Door-to-Door Dining</span>
                                    <div class="text-muted" style="font-size: 0.7rem;">Artisanal Club Sandwich + Detox Juice</div>
                                </td>
                                <td><span class="text-muted small">Leave on patio table with hot cover</span></td>
                                <td><span class="fw-bold text-dark">$48.00</span></td>
                                <td>
                                    <span class="status-pill status-pill-inprep">
                                        <i class="bi bi-fire small"></i> Kitchen Plating
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Track</button>
                                    <button class="btn btn-sm btn-link text-secondary p-1 ms-1"><i class="bi bi-three-dots-vertical"></i></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- ==================== EXPERIENCE BOOKING MODAL ==================== -->
    <div class="modal fade" id="bookServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 8px;">
                <div class="modal-header" style="background-color: var(--mv-primary); color: white;">
                    <h5 class="modal-title font-script">Book Guest Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <!-- Select Experience -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">Experience Selection</label>
                            <select class="form-select text-dark small" style="background-color: #FAFAF8;">
                                <option value="1">Pavilion Spas &amp; Thermal Wellness ($180)</option>
                                <option value="2">Cliffside Private Sunset Dinner ($220)</option>
                                <option value="3">Sacred Ancient Temple Tour ($160)</option>
                                <option value="4">Door-to-Door In-Room Dining (A La Carte)</option>
                            </select>
                        </div>

                        <!-- Guest & Room -->
                        <div class="row g-2 mb-3">
                            <div class="col-7">
                                <label class="form-label text-muted small fw-semibold">Assign to Guest</label>
                                <input type="text" class="form-control small" style="background-color: #FAFAF8;" value="Tariq Al-Hassan" />
                            </div>
                            <div class="col-5">
                                <label class="form-label text-muted small fw-semibold">Unit</label>
                                <input type="text" class="form-control small" style="background-color: #FAFAF8;" value="Villa 02" />
                            </div>
                        </div>

                        <!-- Date & Time Slot -->
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label text-muted small fw-semibold">Date</label>
                                <input type="date" class="form-control small" style="background-color: #FAFAF8;" value="2026-09-09" />
                            </div>
                            <div class="col-6">
                                <label class="form-label text-muted small fw-semibold">Time Slot</label>
                                <input type="time" class="form-control small" style="background-color: #FAFAF8;" value="16:00" />
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-semibold">Special Dietary / Concierge Notes</label>
                            <textarea class="form-control small" rows="2" style="background-color: #FAFAF8;" placeholder="Add dietary alerts, anniversary setup, private therapist preference..."></textarea>
                        </div>

                        <!-- Billing Toggle -->
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="chargeFolio" checked>
                            <label class="form-check-label small fw-semibold text-dark" for="chargeFolio">Charge directly to Room Folio</label>
                        </div>

                        <button type="button" class="btn btn-theme-primary w-100 py-2">Confirm &amp; Dispatch Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Help Button (Bottom Right) -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <button class="btn btn-dark rounded-circle shadow d-flex align-items-center justify-content-center"
            style="width: 36px; height: 36px; background-color: #212529;">
            <i class="bi bi-question fs-5"></i>
        </button>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>