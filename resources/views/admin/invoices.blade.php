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
            <div class="container-fluid px-lg-5">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Invoices & Payment Settlement</h2>
                        <p class="text-muted small mb-0">Manage guest tax invoices and reconcile settlement payment transactions</p>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvoiceModal">
                        + Issue New Invoice
                    </button>
                </div>

                {{-- Aggregate Counters --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0">
                            <small class="text-muted text-uppercase fw-bold">Total Invoices</small>
                            <h3 class="fw-bold text-dark mt-1">{{ $totalInvoices }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0">
                            <small class="text-muted text-uppercase fw-bold">Paid & Settled</small>
                            <h3 class="fw-bold text-success mt-1">{{ $paidInvoices }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0">
                            <small class="text-muted text-uppercase fw-bold">Pending Collection</small>
                            <h3 class="fw-bold text-danger mt-1">{{ $unpaidInvoices }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 shadow-sm border-0">
                            <small class="text-muted text-uppercase fw-bold">Total Revenue Paid</small>
                            <h3 class="fw-bold text-primary mt-1">${{ number_format($totalRevenue, 2) }}</h3>
                        </div>
                    </div>
                </div>

                {{-- Alerts --}}
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

                {{-- Master Invoices Table --}}
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;"></th>
                                    <th class="ps-2">Invoice #</th>
                                    <th>Guest</th>
                                    <th>Folio Ref</th>
                                    <th>Issue Date</th>
                                    <th>Subtotal</th>
                                    <th>Tax / Disc</th>
                                    <th>Grand Total</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                @php
                                $statusBadges = [
                                'DRAFT' => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                                'ISSUED' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                'PAID' => 'bg-success-subtle text-success border border-success-subtle',
                                'VOID' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                'REFUNDED' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                                ];
                                @endphp
                                <tr class="table-group-divider">
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-secondary py-0 px-1"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#payments-{{ $invoice->id }}"
                                            title="View Payments">
                                            &#9660;
                                        </button>
                                    </td>
                                    <td class="ps-2 fw-bold text-dark">{{ $invoice->invoice_no }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $invoice->guest->full_name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $invoice->guest->email ?? '' }}</small>
                                    </td>
                                    <td>
                                        <div>{{ $invoice->folio->folio_no ?? 'N/A' }}</div>
                                        <small class="text-muted">Villa {{ $invoice->folio->reservation->room->room_number ?? '-' }}</small>
                                    </td>
                                    <td>{{ $invoice->issue_date->format('M d, Y') }}</td>
                                    <td>${{ number_format($invoice->subtotal, 2) }}</td>
                                    <td>
                                        <div>Tax: ${{ number_format($invoice->tax_amount, 2) }}</div>
                                        <small class="text-muted">Disc: -${{ number_format($invoice->discount_amount, 2) }}</small>
                                    </td>
                                    <td class="fw-bold text-primary">${{ number_format($invoice->grand_total, 2) }}</td>
                                    <td><span class="badge {{ $statusBadges[$invoice->status] ?? 'bg-secondary' }}">{{ $invoice->status }}</span></td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-success add-payment-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addPaymentModal"
                                                data-invoice-id="{{ $invoice->id }}"
                                                data-invoice-no="{{ $invoice->invoice_no }}">
                                                + Pay
                                            </button>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary edit-invoice-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editInvoiceModal"
                                                data-id="{{ $invoice->id }}"
                                                data-no="{{ $invoice->invoice_no }}"
                                                data-folio="{{ $invoice->folio_id }}"
                                                data-guest="{{ $invoice->guest_id }}"
                                                data-date="{{ $invoice->issue_date->format('Y-m-d') }}"
                                                data-subtotal="{{ $invoice->subtotal }}"
                                                data-tax="{{ $invoice->tax_amount }}"
                                                data-discount="{{ $invoice->discount_amount }}"
                                                data-status="{{ $invoice->status }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Delete invoice {{ $invoice->invoice_no }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Child Row: Itemized Payments --}}
                                <tr class="collapse bg-white" id="payments-{{ $invoice->id }}">
                                    <td colspan="10" class="p-3 bg-light">
                                        <div class="card card-body border-0 shadow-sm p-3">
                                            <h6 class="fw-bold mb-3 text-muted">
                                                Settlement Transactions for {{ $invoice->invoice_no }} ({{ $invoice->payments->count() }} payments)
                                            </h6>
                                            @if($invoice->payments->isEmpty())
                                            <p class="text-muted small mb-0">No payment receipts logged for this invoice yet.</p>
                                            @else
                                            <div class="table-responsive">
                                                <table class="table table-sm align-middle mb-0 small">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Payment #</th>
                                                            <th>Method</th>
                                                            <th>Transaction Ref</th>
                                                            <th>Amount Paid</th>
                                                            <th>Status</th>
                                                            <th>Processed By</th>
                                                            <th>Timestamp</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($invoice->payments as $payment)
                                                        <tr>
                                                            <td class="fw-bold">{{ $payment->payment_no }}</td>
                                                            <td><span class="badge bg-dark">{{ str_replace('_', ' ', $payment->payment_method) }}</span></td>
                                                            <td>{{ $payment->transaction_reference ?? 'N/A' }}</td>
                                                            <td class="fw-bold text-success">${{ number_format($payment->amount, 2) }}</td>
                                                            <td>
                                                                <span class="badge {{ $payment->payment_status === 'SUCCESS' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                                    {{ $payment->payment_status }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $payment->processedBy->username ?? 'Staff' }}</td>
                                                            <td class="text-muted">{{ $payment->paid_at ? $payment->paid_at->format('M d, Y H:i') : '-' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5 text-muted">No tax invoices generated yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 1. CREATE INVOICE MODAL                                                   -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="createInvoiceModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <form action="{{ route('admin.invoices.store') }}" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Issue New Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Invoice Number</label>
                                <input type="text" name="invoice_no" class="form-control" placeholder="INV-2026-0001" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Source Folio</label>
                                <select name="folio_id" class="form-select" required>
                                    <option value="">-- Choose Folio --</option>
                                    @foreach($folios as $folio)
                                    <option value="{{ $folio->id }}">{{ $folio->folio_no }} ({{ $folio->guest->full_name ?? 'Guest' }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Billed Guest</label>
                                <select name="guest_id" class="form-select" required>
                                    <option value="">-- Choose Guest --</option>
                                    @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}">{{ $guest->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Issue Date</label>
                                <input type="date" name="issue_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Subtotal ($)</label>
                                <input type="number" step="0.01" name="subtotal" class="form-control" placeholder="0.00" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Tax Amount ($)</label>
                                <input type="number" step="0.01" name="tax_amount" class="form-control" value="0.00">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Discount Amount ($)</label>
                                <input type="number" step="0.01" name="discount_amount" class="form-control" value="0.00">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="ISSUED" selected>ISSUED</option>
                                    <option value="DRAFT">DRAFT</option>
                                    <option value="PAID">PAID</option>
                                    <option value="VOID">VOID</option>
                                    <option value="REFUNDED">REFUNDED</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Generate Invoice</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 2. EDIT INVOICE MODAL                                                     -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="editInvoiceModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <form id="editInvoiceForm" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Modify Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Invoice Number</label>
                                <input type="text" name="invoice_no" id="edit_invoice_no" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Source Folio</label>
                                <select name="folio_id" id="edit_folio_id" class="form-select" required>
                                    @foreach($folios as $folio)
                                    <option value="{{ $folio->id }}">{{ $folio->folio_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Billed Guest</label>
                                <select name="guest_id" id="edit_guest_id" class="form-select" required>
                                    @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}">{{ $guest->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Issue Date</label>
                                <input type="date" name="issue_date" id="edit_issue_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Subtotal ($)</label>
                                <input type="number" step="0.01" name="subtotal" id="edit_subtotal" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Tax Amount ($)</label>
                                <input type="number" step="0.01" name="tax_amount" id="edit_tax_amount" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Discount Amount ($)</label>
                                <input type="number" step="0.01" name="discount_amount" id="edit_discount_amount" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="DRAFT">DRAFT</option>
                                    <option value="ISSUED">ISSUED</option>
                                    <option value="PAID">PAID</option>
                                    <option value="VOID">VOID</option>
                                    <option value="REFUNDED">REFUNDED</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Invoice</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- 3. ADD PAYMENT MODAL                                                      -->
            <!-- ========================================================================= -->
            <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <form id="addPaymentForm" method="POST" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Record Payment (<span id="payment_target_invoice"></span>)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Payment Receipt #</label>
                                <input type="text" name="payment_no" class="form-control" placeholder="PAY-2026-0001" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Amount Paid ($)</label>
                                <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="CASH">CASH</option>
                                    <option value="CREDIT_CARD">CREDIT_CARD</option>
                                    <option value="DEBIT_CARD">DEBIT_CARD</option>
                                    <option value="BANK_TRANSFER">BANK_TRANSFER</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Transaction / Card Ref (Optional)</label>
                                <input type="text" name="transaction_reference" class="form-control" placeholder="e.g. TXN-VISA-9821">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Payment Status</label>
                                <select name="payment_status" class="form-select" required>
                                    <option value="SUCCESS" selected>SUCCESS</option>
                                    <option value="PENDING">PENDING</option>
                                    <option value="FAILED">FAILED</option>
                                    <option value="REFUNDED">REFUNDED</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Record Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Edit Invoice Binding
            const editButtons = document.querySelectorAll('.edit-invoice-btn');
            const editForm = document.getElementById('editInvoiceForm');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    editForm.action = `/admin/invoices/${id}`;

                    document.getElementById('edit_invoice_no').value = button.getAttribute('data-no');
                    document.getElementById('edit_folio_id').value = button.getAttribute('data-folio');
                    document.getElementById('edit_guest_id').value = button.getAttribute('data-guest');
                    document.getElementById('edit_issue_date').value = button.getAttribute('data-date');
                    document.getElementById('edit_subtotal').value = button.getAttribute('data-subtotal');
                    document.getElementById('edit_tax_amount').value = button.getAttribute('data-tax');
                    document.getElementById('edit_discount_amount').value = button.getAttribute('data-discount');
                    document.getElementById('edit_status').value = button.getAttribute('data-status');
                });
            });

            // Add Payment Binding
            const payButtons = document.querySelectorAll('.add-payment-btn');
            const payForm = document.getElementById('addPaymentForm');
            const targetInvoiceText = document.getElementById('payment_target_invoice');

            payButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const invoiceId = button.getAttribute('data-invoice-id');
                    const invoiceNo = button.getAttribute('data-invoice-no');

                    targetInvoiceText.textContent = invoiceNo;
                    payForm.action = `/admin/invoices/${invoiceId}/payments`;
                });
            });
        });
    </script>
</body>

</html>
<!-- script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Edit Invoice Binding
        const editButtons = document.querySelectorAll('.edit-invoice-btn');
        const editForm = document.getElementById('editInvoiceForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                editForm.action = `/admin/invoices/${id}`;

                document.getElementById('edit_invoice_no').value = button.getAttribute('data-no');
                document.getElementById('edit_folio_id').value = button.getAttribute('data-folio');
                document.getElementById('edit_guest_id').value = button.getAttribute('data-guest');
                document.getElementById('edit_issue_date').value = button.getAttribute('data-date');
                document.getElementById('edit_subtotal').value = button.getAttribute('data-subtotal');
                document.getElementById('edit_tax_amount').value = button.getAttribute('data-tax');
                document.getElementById('edit_discount_amount').value = button.getAttribute('data-discount');
                document.getElementById('edit_status').value = button.getAttribute('data-status');
            });
        });

        // Add Payment Binding
        const payButtons = document.querySelectorAll('.add-payment-btn');
        const payForm = document.getElementById('addPaymentForm');
        const targetInvoiceText = document.getElementById('payment_target_invoice');

        payButtons.forEach(button => {
            button.addEventListener('click', () => {
                const invoiceId = button.getAttribute('data-invoice-id');
                const invoiceNo = button.getAttribute('data-invoice-no');

                targetInvoiceText.textContent = invoiceNo;
                payForm.action = `/admin/invoices/${invoiceId}/payments`;
            });
        });
    });
</script>
</body>

</html>