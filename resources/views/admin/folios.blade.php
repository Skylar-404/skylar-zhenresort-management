<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Maison Verde - Finance & Guest Payment</title>

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

    /* ==================== FINANCE COMPONENTS ==================== */
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

    .finance-card {
      background: #ffffff;
      border: 1px solid var(--mv-border);
      border-radius: 8px;
    }

    .btn-theme-primary {
      background-color: var(--mv-primary);
      color: #ffffff;
      border: none;
      font-size: 0.9rem;
      font-weight: 600;
      border-radius: 6px;
      padding: 0.65rem 1.25rem;
      transition: background 0.2s;
    }

    .btn-theme-primary:hover {
      background-color: #13271c;
      color: #ffffff;
    }

    /* Payment Method Toggle Buttons */
    .pay-method-card {
      border: 1px solid var(--mv-border);
      border-radius: 6px;
      padding: 0.75rem 0.5rem;
      text-align: center;
      cursor: pointer;
      background-color: #FCFAF7;
      transition: all 0.15s ease;
    }

    .pay-method-card:hover {
      border-color: var(--mv-primary);
    }

    .pay-method-card.active {
      border-color: var(--mv-primary);
      background-color: #F1EFE8;
      box-shadow: 0 0 0 1px var(--mv-primary);
    }

    .pay-method-card i {
      font-size: 1.35rem;
      display: block;
      margin-bottom: 4px;
      color: var(--mv-primary);
    }

    .pay-method-card span {
      font-size: 0.72rem;
      font-weight: 600;
      color: #333;
    }

    /* Tip Button Group */
    .tip-btn-group .btn {
      font-size: 0.78rem;
      font-weight: 600;
      border: 1px solid #E0DAD0;
      background-color: #fff;
      color: #3b3d39;
      padding: 0.35rem 0.65rem;
    }

    .tip-btn-group .btn.active {
      background-color: var(--mv-primary);
      color: #fff;
      border-color: var(--mv-primary);
    }

    /* Form Fields */
    .pay-input {
      background-color: #FAFAF8;
      border: 1px solid #E0DAD0;
      font-size: 0.85rem;
      border-radius: 5px;
      padding: 0.55rem 0.75rem;
    }

    .pay-input:focus {
      background-color: #ffffff;
      border-color: var(--mv-primary);
      box-shadow: none;
    }

    /* Itemized Receipt Table */
    .statement-table th {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: #8A8D86;
      border-bottom: 1px solid var(--mv-border);
      padding: 0.65rem 0.5rem;
      background-color: #FAFAF8;
    }

    .statement-table td {
      font-size: 0.82rem;
      padding: 0.75rem 0.5rem;
      border-bottom: 1px solid #F0ECE4;
      vertical-align: middle;
    }

    .service-badge {
      font-size: 0.65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 2px 6px;
      border-radius: 3px;
      background-color: #F1EFE8;
      color: var(--mv-primary);
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
          <a href="#" class="nav-link"><span class="index-num">06</span><i class="bi bi-star me-2"></i> Services</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link"><span class="index-num">07</span><i class="bi bi-people me-2"></i> Guests</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link active"><span class="index-num">08</span><i class="bi bi-receipt me-2"></i> Finance</a>
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
            <input type="text" class="search-input" placeholder="Search folio #, transaction ID, invoice, room..." />
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
            <h2 class="fw-bold mb-1">Folios & Itemized Charges</h2>
            <p class="text-muted small mb-0">Expand any folio row to inspect line charges, post tabs, and manage guest accounts</p>
          </div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFolioModal">
            + Open New Folio
          </button>
        </div>

        {{-- Aggregate Counters --}}
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
              <small class="text-muted text-uppercase fw-bold">Total Invoices</small>
              <h3 class="fw-bold text-dark mt-1">{{ $totalFolios }}</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
              <small class="text-muted text-uppercase fw-bold">Open Accounts</small>
              <h3 class="fw-bold text-danger mt-1">{{ $openFolios }}</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
              <small class="text-muted text-uppercase fw-bold">Total Charges</small>
              <h3 class="fw-bold text-primary mt-1">${{ number_format($totalCharges, 2) }}</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3 shadow-sm border-0">
              <small class="text-muted text-uppercase fw-bold">Total Payments</small>
              <h3 class="fw-bold text-success mt-1">${{ number_format($totalCollected, 2) }}</h3>
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

        {{-- Master Table with Collapsible Child Charges --}}
        <div class="card border-0 shadow-sm">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th style="width: 40px;"></th>
                  <th class="ps-2">Folio #</th>
                  <th>Guest</th>
                  <th>Reservation / Villa</th>
                  <th>Type</th>
                  <th>Billed Charges</th>
                  <th>Payments</th>
                  <th>Balance Due</th>
                  <th>Status</th>
                  <th class="text-end pe-4">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($folios as $folio)
                @php
                $typeBadges = [
                'ROOM' => 'bg-primary',
                'MASTER' => 'bg-dark',
                'INCIDENTAL' => 'bg-info text-dark',
                'NON_GUEST' => 'bg-secondary',
                ];
                $statusBadges = [
                'OPEN' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                'SETTLED' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                'CLOSED' => 'bg-success-subtle text-success border border-success-subtle',
                'VOID' => 'bg-danger-subtle text-danger border border-danger-subtle',
                ];
                @endphp
                {{-- Parent Folio Row --}}
                <tr class="table-group-divider">
                  <td class="text-center">
                    <button class="btn btn-sm btn-outline-secondary py-0 px-1"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#charges-{{ $folio->id }}"
                      title="View itemized line charges">
                      &#9660;
                    </button>
                  </td>
                  <td class="ps-2 fw-bold text-dark">{{ $folio->folio_no }}</td>
                  <td>
                    <div class="fw-semibold">{{ $folio->guest->full_name ?? 'N/A' }}</div>
                    <small class="text-muted">{{ $folio->guest->phone ?? '' }}</small>
                  </td>
                  <td>
                    @if($folio->reservation)
                    <div>{{ $folio->reservation->reservation_no }}</div>
                    <small class="text-muted">Villa {{ $folio->reservation->room->room_number ?? 'N/A' }}</small>
                    @else
                    <small class="text-muted">Non-Guest</small>
                    @endif
                  </td>
                  <td><span class="badge {{ $typeBadges[$folio->folio_type] ?? 'bg-secondary' }}">{{ $folio->folio_type }}</span></td>
                  <td class="fw-semibold">${{ number_format($folio->total_charges, 2) }}</td>
                  <td class="text-success fw-semibold">${{ number_format($folio->total_payments, 2) }}</td>
                  <td>
                    @if($folio->balance > 0)
                    <span class="text-danger fw-bold">${{ number_format($folio->balance, 2) }}</span>
                    @else
                    <span class="text-success fw-bold">$0.00</span>
                    @endif
                  </td>
                  <td><span class="badge {{ $statusBadges[$folio->status] ?? 'bg-secondary' }}">{{ $folio->status }}</span></td>
                  <td class="text-end pe-4">
                    <div class="d-inline-flex gap-2">
                      <button type="button"
                        class="btn btn-sm btn-outline-primary post-charge-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#postChargeModal"
                        data-folio-id="{{ $folio->id }}"
                        data-folio-no="{{ $folio->folio_no }}">
                        + Charge
                      </button>
                      <button type="button"
                        class="btn btn-sm btn-outline-secondary edit-folio-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editFolioModal"
                        data-id="{{ $folio->id }}"
                        data-no="{{ $folio->folio_no }}"
                        data-guest="{{ $folio->guest_id }}"
                        data-res="{{ $folio->reservation_id }}"
                        data-type="{{ $folio->folio_type }}"
                        data-status="{{ $folio->status }}"
                        data-charges="{{ $folio->total_charges }}"
                        data-payments="{{ $folio->total_payments }}">
                        Edit
                      </button>
                      <form action="{{ route('admin.folios.destroy', $folio->id) }}" method="POST" onsubmit="return confirm('Delete folio {{ $folio->folio_no }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>

                {{-- Child Row: Itemized Folio Charges --}}
                <tr class="collapse bg-white" id="charges-{{ $folio->id }}">
                  <td colspan="10" class="p-3 bg-light">
                    <div class="card card-body border-0 shadow-sm p-3">
                      <h6 class="fw-bold mb-3 text-muted">
                        Itemized Charges on {{ $folio->folio_no }} ({{ $folio->charges->count() }} items)
                      </h6>
                      @if($folio->charges->isEmpty())
                      <p class="text-muted small mb-0">No itemized charges posted to this account yet.</p>
                      @else
                      <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0 small">
                          <thead class="table-light">
                            <tr>
                              <th>Ref #</th>
                              <th>Category</th>
                              <th>Item Description</th>
                              <th>Price & Quantity</th>
                              <th>Tax</th>
                              <th>Total</th>
                              <th>Posted By / At</th>
                              <th>Status</th>
                              <th class="text-end">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($folio->charges as $charge)
                            <tr class="{{ $charge->is_voided ? 'text-decoration-line-through text-muted' : '' }}">
                              <td class="fw-bold">{{ $charge->charge_no }}</td>
                              <td><span class="badge bg-secondary-subtle text-secondary border">{{ $charge->service_category }}</span></td>
                              <td>{{ $charge->item_description }}</td>
                              <td>${{ number_format($charge->unit_price, 2) }} &times; {{ $charge->quantity }}</td>
                              <td>${{ number_format($charge->tax_amount, 2) }}</td>
                              <td class="fw-bold">${{ number_format($charge->total_amount, 2) }}</td>
                              <td>
                                <div>{{ $charge->postedBy->username ?? 'Staff' }}</div>
                                <small class="text-muted">{{ $charge->posted_at ? $charge->posted_at->format('M d, H:i') : '-' }}</small>
                              </td>
                              <td>
                                @if($charge->is_voided)
                                <span class="badge bg-danger">Voided</span>
                                @else
                                <span class="badge bg-success">Active</span>
                                @endif
                              </td>
                              <td class="text-end">
                                <form action="{{ route('admin.folios.charges.void', $charge->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <button type="submit" class="btn btn-sm btn-outline-warning py-0" style="font-size: 0.75rem;">
                                    {{ $charge->is_voided ? 'Restore' : 'Void' }}
                                  </button>
                                </form>
                              </td>
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
                  <td colspan="10" class="text-center py-5 text-muted">No folios generated yet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ========================================================================= -->
      <!-- 1. CREATE FOLIO MODAL                                                     -->
      <!-- ========================================================================= -->
      <div class="modal fade" id="createFolioModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <form action="{{ route('admin.folios.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Open Master Folio</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Folio Number</label>
                <input type="text" name="folio_no" class="form-control" placeholder="FOL-2026-0001" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Registered Guest</label>
                <select name="guest_id" class="form-select" required>
                  <option value="">-- Choose guest --</option>
                  @foreach($guests as $guest)
                  <option value="{{ $guest->id }}">{{ $guest->full_name }} ({{ $guest->phone }})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Linked Reservation (Optional)</label>
                <select name="reservation_id" class="form-select">
                  <option value="">-- None (Walk-in / Outlets) --</option>
                  @foreach($reservations as $res)
                  <option value="{{ $res->id }}">
                    {{ $res->reservation_no }} - {{ $res->guest->full_name ?? '' }} (Villa {{ $res->room->room_number ?? '-' }})
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Folio Type</label>
                <select name="folio_type" class="form-select" required>
                  <option value="ROOM" selected>ROOM</option>
                  <option value="MASTER">MASTER</option>
                  <option value="INCIDENTAL">INCIDENTAL</option>
                  <option value="NON_GUEST">NON_GUEST</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Starting Charges ($)</label>
                <input type="number" step="0.01" name="total_charges" class="form-control" value="0.00">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Starting Payments ($)</label>
                <input type="number" step="0.01" name="total_payments" class="form-control" value="0.00">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Initial Status</label>
                <select name="status" class="form-select" required>
                  <option value="OPEN" selected>OPEN</option>
                  <option value="SETTLED">SETTLED</option>
                  <option value="CLOSED">CLOSED</option>
                  <option value="VOID">VOID</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Generate Folio</button>
            </div>
          </form>
        </div>
      </div>

      <!-- ========================================================================= -->
      <!-- 2. EDIT FOLIO MODAL                                                       -->
      <!-- ========================================================================= -->
      <div class="modal fade" id="editFolioModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <form id="editFolioForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Modify Folio Ledger</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Folio Number</label>
                <input type="text" name="folio_no" id="edit_folio_no" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Guest</label>
                <select name="guest_id" id="edit_guest_id" class="form-select" required>
                  @foreach($guests as $guest)
                  <option value="{{ $guest->id }}">{{ $guest->full_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Linked Reservation</label>
                <select name="reservation_id" id="edit_reservation_id" class="form-select">
                  <option value="">-- None --</option>
                  @foreach($reservations as $res)
                  <option value="{{ $res->id }}">
                    {{ $res->reservation_no }} - Villa {{ $res->room->room_number ?? '-' }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Folio Type</label>
                <select name="folio_type" id="edit_folio_type" class="form-select" required>
                  <option value="ROOM">ROOM</option>
                  <option value="MASTER">MASTER</option>
                  <option value="INCIDENTAL">INCIDENTAL</option>
                  <option value="NON_GUEST">NON_GUEST</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Total Charges ($)</label>
                <input type="number" step="0.01" name="total_charges" id="edit_total_charges" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Total Payments ($)</label>
                <input type="number" step="0.01" name="total_payments" id="edit_total_payments" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold">Status</label>
                <select name="status" id="edit_status" class="form-select" required>
                  <option value="OPEN">OPEN</option>
                  <option value="SETTLED">SETTLED</option>
                  <option value="CLOSED">CLOSED</option>
                  <option value="VOID">VOID</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update Folio</button>
            </div>
          </form>
        </div>
      </div>

      <!-- ========================================================================= -->
      <!-- 3. POST ITEM CHARGE MODAL                                                 -->
      <!-- ========================================================================= -->
      <div class="modal fade" id="postChargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
          <form id="postChargeForm" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title fw-bold">Post Line Charge (<span id="charge_target_folio"></span>)</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-12">
                <label class="form-label small fw-bold">Charge Reference #</label>
                <input type="text" name="charge_no" class="form-control" placeholder="CHG-2026-0001" required>
              </div>
              <div class="col-12">
                <label class="form-label small fw-bold">Category</label>
                <select name="service_category" class="form-select" required>
                  <option value="FOOD_BEVERAGE">FOOD_BEVERAGE</option>
                  <option value="SPA">SPA</option>
                  <option value="ACTIVITY">ACTIVITY</option>
                  <option value="ROOM">ROOM</option>
                  <option value="OTHER">OTHER</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label small fw-bold">Item Description</label>
                <input type="text" name="item_description" class="form-control" placeholder="e.g. 2x Signature Mojito" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Unit Price ($)</label>
                <input type="number" step="0.01" name="unit_price" class="form-control" placeholder="0.00" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="1" min="1" required>
              </div>
              <div class="col-12">
                <label class="form-label small fw-bold">Tax Amount ($)</label>
                <input type="number" step="0.01" name="tax_amount" class="form-control" value="0.00">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add to Bill</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Bootstrap JS Bundle -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', () => {
          // Edit Folio Action Binding
          const editButtons = document.querySelectorAll('.edit-folio-btn');
          const editForm = document.getElementById('editFolioForm');

          editButtons.forEach(button => {
            button.addEventListener('click', () => {
              const id = button.getAttribute('data-id');
              editForm.action = `/admin/folios/${id}`;

              document.getElementById('edit_folio_no').value = button.getAttribute('data-no');
              document.getElementById('edit_guest_id').value = button.getAttribute('data-guest');
              document.getElementById('edit_reservation_id').value = button.getAttribute('data-res') || '';
              document.getElementById('edit_folio_type').value = button.getAttribute('data-type');
              document.getElementById('edit_status').value = button.getAttribute('data-status');
              document.getElementById('edit_total_charges').value = button.getAttribute('data-charges');
              document.getElementById('edit_total_payments').value = button.getAttribute('data-payments');
            });
          });

          // Add Charge Action Binding
          const chargeButtons = document.querySelectorAll('.post-charge-btn');
          const chargeForm = document.getElementById('postChargeForm');
          const chargeTargetText = document.getElementById('charge_target_folio');

          chargeButtons.forEach(button => {
            button.addEventListener('click', () => {
              const folioId = button.getAttribute('data-folio-id');
              const folioNo = button.getAttribute('data-folio-no');

              chargeTargetText.textContent = folioNo;
              chargeForm.action = `/admin/folios/${folioId}/charges`;
            });
          });
        });
      </script>
</body>

</html>