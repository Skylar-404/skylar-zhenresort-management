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
                <ul class="nav nav-pills flex-column">
                    <li><a href="#" class="nav-link active"><i class="bi bi-display link-icon"></i> Overview</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-calendar-event link-icon"></i> Reservations</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-box-seam link-icon"></i> Front Office</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-house link-icon"></i> Property</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-wrench link-icon"></i> Operations</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-bell link-icon"></i> Services</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-people link-icon"></i> Guests</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-graph-up link-icon"></i> Finance</a></li>
                    <li><a href="#" class="nav-link"><i class="bi bi-person-gear link-icon"></i> Administration</a></li>
                </ul>
            </nav>
        </div>

        <!-- User Info -->
        <div class="user-block pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="mb-3 d-flex align-items-center">
                <i class="bi bi-arrow-bar-left me-2"></i> Collapse
            </div>
            <div class="d-flex align-items-center">
                <div class="initials me-2" style="width: 36px; height: 36px; border-radius: 50%; background-color: var(--mv-accent-gold); color: white; display:flex; align-items:center; justify-content:center;">AV</div>
                <div>
                    <div>JohnPork</div>
                    <div style="color:rgba(255,255,255,0.7); font-size:0.8rem;">Front Desk Manager</div>
                </div>
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

            <!-- METRIC GRID (Top Row) -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-6 g-4 mb-5">
                <!-- Metric Card 1: Occupancy -->
                <div class="col">
                    <div class="metric-card">
                        <div class="label">OCCUPANCY</div>
                        <div class="value">43%</div>
                        <div class="text-muted" style="font-size:0.8rem;">9 of 21 rooms</div>
                        <div class="w-100 bg-light mt-2" style="height: 4px; border-radius: 2px;">
                            <div class="bg-secondary" style="height: 100%; width: 43%; border-radius: 2px;"></div>
                        </div>
                    </div>
                </div>
                <!-- Metric Card 2: RevPAR -->
                <div class="col">
                    <div class="metric-card">
                        <div class="label">REVPAR</div>
                        <div class="value">$225</div>
                        <div class="text-muted" style="font-size:0.8rem;">Revenue per avail. room</div>
                    </div>
                </div>
                <!-- Metric Card 3: Today's Arrivals -->
                <div class="col">
                    <div class="metric-card">
                        <div class="label">TODAY'S ARRIVALS</div>
                        <div class="value">5</div>
                        <div class="text-muted" style="font-size:0.8rem;">Expected check-ins</div>
                    </div>
                </div>
                <!-- Metric Card 4: Today's Departures -->
                <div class="col">
                    <div class="metric-card">
                        <div class="label">TODAY'S DEPARTURES</div>
                        <div class="value">1</div>
                        <div class="text-muted" style="font-size:0.8rem;">Expected check-outs</div>
                    </div>
                </div>
                <!-- Metric Card 5: Rooms Dirty -->
                <div class="col">
                    <div class="metric-card">
                        <div class="label">ROOMS DIRTY</div>
                        <div class="value">2</div>
                        <div class="text-muted" style="font-size:0.8rem;">Pending housekeeping</div>
                    </div>
                </div>
                <!-- Metric Card 6: Out of Order -->
                <div class="col">
                    <div class="metric-card border border-dark" style="background-color: #f2f2f2;">
                        <div class="label">OUT OF ORDER</div>
                        <div class="value">2</div>
                        <div class="text-muted" style="font-size:0.8rem;">Unavailable rooms</div>
                    </div>
                </div>
            </div>

            <!-- LOWER GRID (Left and Right Lists) -->
            <div class="row g-4">

                <!-- Left: Arrivals List -->
                <div class="col-lg-7">
                    <div class="dashboard-card">
                        <div class="section-title">
                            <div>
                                <span class="fs-6 text-uppercase text-muted fw-bold me-2">ARRIVALS TODAY</span>
                                <span class="fs-4 fw-bold">5 check-ins</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm rounded-pill px-3">Front Office &rarr;</button>
                        </div>

                        <ul class="list-unstyled mb-0">
                            <li class="list-item">
                                <div class="initials">AL</div>
                                <div class="details">
                                    <div class="fw-bold fs-6">Al-Hassan</div>
                                    <div class="text-muted" style="font-size:0.8rem;">Villa 02 &middot; 4 guests</div>
                                </div>
                                <div><span class="status-badge status-confirmed">Confirmed</span></div>
                            </li>
                            <li class="list-item">
                                <div class="initials">TA</div>
                                <div class="details">
                                    <div class="fw-bold fs-6">Tanaka</div>
                                    <div class="text-muted" style="font-size:0.8rem;">202 &middot; 2 guests</div>
                                </div>
                                <div><span class="status-badge status-confirmed">Confirmed</span></div>
                            </li>
                            <li class="list-item">
                                <div class="initials">LI</div>
                                <div class="details">
                                    <div class="fw-bold fs-6">Lindqvist</div>
                                    <div class="text-muted" style="font-size:0.8rem;">303 &middot; 2 guests</div>
                                </div>
                                <div><span class="status-badge status-confirmed">Confirmed</span></div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right: Housekeeping List -->
                <div class="col-lg-5">
                    <div class="dashboard-card">
                        <div class="section-title mb-1">
                            <div>
                                <span class="fs-6 text-uppercase text-muted fw-bold me-2">HOUSEKEEPING STATUS</span>
                                <span class="fs-4 fw-bold">6 tasks open</span>
                            </div>
                            <button class="btn btn-outline-dark btn-sm rounded-pill px-3">Operations &rarr;</button>
                        </div>

                        <ul class="list-unstyled mb-0 mt-4">
                            <li class="list-item">
                                <div class="initials border border-danger">102</div>
                                <div class="details<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
                                    </script>">
                                    <div class="fw-bold fs-6">Room 102</div>
                                    <div class="text-muted" style="font-size:0.8rem;">Full Clean + Turndown</div>
                                </div>
                                <div class="text-end">
                                    <div style="font-size:0.8rem;">Rosa M.</div>
                                    <div><span class="status-badge status-pending">Pending</span></div>
                                </div>
                            </li>
                            <li class="list-item border-left border-3 border-danger">
                                <div class="initials">205</div>
                                <div class="details">
                                    <div class="fw-bold fs-6">Room 205</div>
                                    <div class="text-muted" style="font-size:0.8rem;">Departure Clean</div>
                                </div>
                                <div class="text-end">
                                    <div style="font-size:0.8rem;">Anya B.

                                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>