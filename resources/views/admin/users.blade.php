<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administration</title>

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

        /* ==================== ADMIN UI COMPONENTS ==================== */
        .admin-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
            padding: 1.25rem;
        }

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

        /* Primary Buttons */
        .btn-theme-primary {
            background-color: var(--mv-primary);
            color: #ffffff;
            border: none;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 5px;
            padding: 0.5rem 1rem;
        }

        .btn-theme-primary:hover {
            background-color: #13271c;
            color: #ffffff;
        }

        /* Custom Switch Toggle */
        .form-check-input:checked {
            background-color: var(--mv-primary);
            border-color: var(--mv-primary);
        }

        /* Table custom styles */
        .admin-table th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            color: #8A8D86;
            border-bottom: 1px solid var(--mv-border);
            padding: 0.75rem 1rem;
            background-color: #FAFAF8;
        }

        .admin-table td {
            font-size: 0.85rem;
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F0ECE4;
        }

        .role-badge {
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 4px;
            padding: 2px 8px;
            display: inline-block;
        }

        .role-admin {
            background-color: #E2F4EA;
            color: #1C7C4C;
        }

        .role-manager {
            background-color: #FBF3D8;
            color: #AD8322;
        }

        .role-staff {
            background-color: #E5EFFF;
            color: #3B71CA;
        }

        .avatar-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.78rem;
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

                <!-- Search Input -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                        <i class="bi bi-list fs-3 text-dark"></i>
                    </button>

                    <div class="search-container">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.85rem;"></i>
                        <input type="text" class="search-input" placeholder="Search staff, permissions, logs, system config..." />
                    </div>
                </div>

                <!-- Right: Status and Notification -->
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
                    <h1 class="display-6 font-script fw-bold mb-1">Administration</h1>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="fw-bold small" style="color: var(--mv-gold) !important; font-size: 0.75rem;">09</span>
                        <span class="text-uppercase fw-semibold" style="letter-spacing: 1.5px; font-size: 0.68rem; color: #72756F;">System & Personnel Governance</span>
                        <span class="border-top" style="width: 35px; border-color: #D6D0C4 !important;"></span>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                        <i class="bi bi-download me-1"></i> Export Logs
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        <i class="bi bi-plus-lg"></i> Add Staff Member
                    </button>
                </div>
            </div>

            <!-- Quick Metrics Row -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Total Personnel</div>
                        <div class="value mt-1">{{ $totalUsers }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Across 6 departments</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Active Sessions Now</div>
                        <div class="value mt-1">{{ $totalActiveUsers }}</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">All MFA authenticated</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">System Integrations</div>
                        <div class="value mt-1 text-success">99.8%</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Channel Manager & POS live</div>
                    </div>
                </div>
                <div class="col">
                    <div class="stat-card">
                        <div class="label">Security Alerts</div>
                        <div class="value mt-1" style="color: var(--mv-gold);">0</div>
                        <div class="text-muted small mt-1" style="font-size: 0.75rem;">Last audit completed today</div>
                    </div>
                </div>
            </div>

            <!-- Main Layout: Left Staff Table (8 cols), Right System Settings (4 cols) -->
            <div class="row g-4">

                <!-- Left: Staff Members & Roles Table -->
                <div class="col-12 col-xl-8">
                    <div class="admin-card p-0 overflow-hidden">
                        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Staff Directory & Roles</h6>
                                <span class="text-muted small" style="font-size: 0.75rem;">Manage active access levels and permissions</span>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-secondary active" style="font-size: 0.75rem;">All</button>
                                <button class="btn btn-outline-secondary" style="font-size: 0.75rem;">Front Office</button>
                                <button class="btn btn-outline-secondary" style="font-size: 0.75rem;">Operations</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table admin-table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Staff Member</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>System Access</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--  -->
                                    @forelse($users as $user)
                                    @php
                                    $roleBadges = [
                                    'ADMIN' => 'bg-dark',
                                    'MANAGER' => 'bg-primary',
                                    'RECEPTIONIST' => 'bg-info text-dark',
                                    'MAINTENANCE' => 'bg-warning text-dark',
                                    'SERVER' => 'bg-secondary',
                                    ];
                                    $badgeClass = $roleBadges[$user->role] ?? 'bg-secondary';
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $user->full_name }}</div>
                                            <div class="text-muted small">&#64;{{ $user->username }}</div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $badgeClass }}">{{ $user->role }}</span>
                                        </td>
                                        <td>
                                            @if($user->is_active)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                                            @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-inline-flex gap-2">
                                                <!-- Edit Button with dynamic data attributes -->
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-secondary edit-user-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal"
                                                    data-id="{{ $user->id }}"
                                                    data-username="{{ $user->username }}"
                                                    data-email="{{ $user->email }}"
                                                    data-fullname="{{ $user->full_name }}"
                                                    data-role="{{ $user->role }}"
                                                    data-active="{{ $user->is_active }}">
                                                    Edit
                                                </button>

                                                <!-- Delete Form -->
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete user {{ $user->username }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">No users found.</td>
                                    </tr>
                                    @endforelse
                                    <!--  -->
                                </tbody>
                            </table>
                        </div>

                        <!-- 1. CREATE USER MODAL                                                      -->
                        <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Create User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" placeholder="e.g. Sokha Phan" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Username</label>
                                            <input type="text" name="username" class="form-control" placeholder="e.g. sokha_p" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Email Address</label>
                                            <input type="email" name="email" class="form-control" placeholder="user@villasunset.com" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Role</label>
                                            <select name="role" class="form-select" required>
                                                <option value="ADMIN">ADMIN</option>
                                                <option value="MANAGER">MANAGER</option>
                                                <option value="RECEPTIONIST">RECEPTIONIST</option>
                                                <option value="MAINTENANCE">MAINTENANCE</option>
                                                <option value="SERVER">SERVER</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Status</label>
                                            <select name="is_active" class="form-select" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Create User</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- 2. EDIT USER MODAL (Dynamically populated)                                -->
                        <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form id="editUserForm" method="POST" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Full Name</label>
                                            <input type="text" name="full_name" id="edit_full_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Username</label>
                                            <input type="text" name="username" id="edit_username" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Email Address</label>
                                            <input type="email" name="email" id="edit_email" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">New Password</label>
                                            <input type="password" name="password" id="edit_password" class="form-control" placeholder="Leave blank to keep current">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Role</label>
                                            <select name="role" id="edit_role" class="form-select" required>
                                                <option value="ADMIN">ADMIN</option>
                                                <option value="MANAGER">MANAGER</option>
                                                <option value="RECEPTIONIST">RECEPTIONIST</option>
                                                <option value="MAINTENANCE">MAINTENANCE</option>
                                                <option value="SERVER">SERVER</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Status</label>
                                            <select name="is_active" id="edit_is_active" class="form-select" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--  -->
                        <!--  -->


                        <div class="p-3 bg-white border-top border-1 text-center">
                            <a href="#" class="text-decoration-none fw-semibold small" style="color: var(--mv-primary); font-size: 0.8rem;">
                                View All {{ $totalUsers }} Personnel &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Operational Policies & System Preferences -->
                <div class="col-12 col-xl-4 d-flex flex-column gap-3">

                    <!-- Property Settings Toggles -->
                    <div class="admin-card">
                        <h6 class="fw-bold text-dark mb-1">Resort Rules & Automation</h6>
                        <p class="text-muted small mb-4" style="font-size: 0.75rem;">Global toggles affecting PMS workflow</p>

                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold small">Automatic Housekeeping Queue</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Dispatch rooms immediately on check-out</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <div class="fw-semibold small">Overbooking Buffer (2%)</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Permit peak season overflow holds</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <div class="fw-semibold small">Guest Arrival SMS Dispatch</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Send concierge link 2h prior to check-in</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <div class="fw-semibold small">Daily Night Audit Auto-Run</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">Close daily books at 03:00 AM</div>
                                </div>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" role="switch" checked>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Activity Snippet -->
                    <div class="admin-card">
                        <h6 class="fw-bold text-dark mb-1">Recent Security Log</h6>
                        <p class="text-muted small mb-3" style="font-size: 0.75rem;">Latest administrative events</p>

                        <div class="d-flex flex-column gap-2 small">
                            <div class="d-flex gap-2">
                                <i class="bi bi-shield-check text-success"></i>
                                <div>
                                    <span class="fw-semibold text-dark">Adela V.</span> changed Villa 02 rate override.
                                    <div class="text-muted" style="font-size: 0.68rem;">14 minutes ago</div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 border-top pt-2">
                                <i class="bi bi-key text-secondary"></i>
                                <div>
                                    <span class="fw-semibold text-dark">Rosa M.</span> unlocked Master Key Set B.
                                    <div class="text-muted" style="font-size: 0.68rem;">1 hour ago</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
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