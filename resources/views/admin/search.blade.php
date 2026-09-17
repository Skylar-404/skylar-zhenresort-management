@extends('admin.layout.app')

@section('title', 'Search Results: ' . ($query ?: 'All'))

@section('content')
<div class="container-fluid px-0">

    <!-- Header & Search Summary -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Search Results</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">PMS</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">
                    @if(!empty($query))
                        Showing {{ $totalResults }} match(es) for &ldquo;<strong class="text-dark">{{ $query }}</strong>&rdquo;
                    @else
                        Enter a keyword to search across all resort modules
                    @endif
                </span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark btn-sm rounded px-3" style="border-color: #D3CABA; background-color: #fff;">
                <i class="bi bi-arrow-left me-1" style="color: var(--resort-gold);"></i> Return to Dashboard
            </a>
        </div>
    </div>

    <!-- Category Counters Badges -->
    <div class="d-flex flex-wrap gap-2 mb-4" data-aos="fade-up" data-aos-delay="100">
        <span class="badge bg-dark py-2 px-3">Total: {{ $totalResults }}</span>
        <a href="#section-reservations" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Reservations ({{ $reservations->count() }})
        </a>
        <a href="#section-guests" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Guests ({{ $guests->count() }})
        </a>
        <a href="#section-rooms" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Rooms / Villas ({{ $rooms->count() }})
        </a>
        <a href="#section-folios" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Folios ({{ $folios->count() }})
        </a>
        <a href="#section-invoices" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Invoices ({{ $invoices->count() }})
        </a>
        <a href="#section-maintenance" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Maintenance ({{ $maintenanceTickets->count() }})
        </a>
        <a href="#section-users" class="badge bg-white text-dark border py-2 px-3 text-decoration-none shadow-sm">
            Staff Users ({{ $users->count() }})
        </a>
    </div>

    @if($totalResults === 0 && !empty($query))
    <div class="res-card p-5 text-center my-4" data-aos="fade-up">
        <div class="text-muted mb-3"><i class="bi bi-search display-4" style="color: var(--resort-gold);"></i></div>
        <h4 class="fw-bold text-dark">No records found matching &ldquo;{{ $query }}&rdquo;</h4>
        <p class="text-muted small mb-3">Try checking for typos or searching by guest name, room number, reservation ID, or phone number.</p>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-theme-primary">Go to Dashboard</a>
        </div>
    </div>
    @endif

    <!-- 1. RESERVATIONS MATCHES -->
    @if($reservations->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-reservations" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-calendar3 me-2 text-primary"></i>Reservations ({{ $reservations->count() }})
            </h6>
            <a href="{{ route('admin.reservations') }}" class="small text-decoration-none">View All Reservations &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Res #</th>
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                    <tr>
                        <td class="ps-3 fw-bold">{{ $res->reservation_no }}</td>
                        <td>{{ $res->guest->full_name ?? 'N/A' }}</td>
                        <td>Villa {{ $res->room->room_number ?? '-' }} ({{ $res->room->room_type ?? '' }})</td>
                        <td>{{ \Carbon\Carbon::parse($res->check_in_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($res->check_out_date)->format('M d, Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $res->status }}</span></td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.reservations') }}" class="btn btn-sm btn-outline-dark">Manage</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 2. GUESTS MATCHES -->
    @if($guests->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-guests" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-people me-2 text-success"></i>Guests ({{ $guests->count() }})
            </h6>
            <a href="{{ route('admin.guests') }}" class="small text-decoration-none">View All Guests &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>ID Document</th>
                        <th>VIP Tier</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guests as $guest)
                    <tr>
                        <td class="ps-3 fw-bold text-dark">{{ $guest->full_name }}</td>
                        <td>{{ $guest->phone }}</td>
                        <td>{{ $guest->email ?? '-' }}</td>
                        <td>{{ $guest->identification_type }}: {{ $guest->identification_no }}</td>
                        <td><span class="badge bg-warning text-dark">{{ $guest->vip_status }}</span></td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.guests') }}" class="btn btn-sm btn-outline-dark">CRM Profile</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 3. ROOMS MATCHES -->
    @if($rooms->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-rooms" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-building me-2 text-info"></i>Property / Rooms ({{ $rooms->count() }})
            </h6>
            <a href="{{ route('admin.rooms') }}" class="small text-decoration-none">View All Property &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Villa / Room #</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Rate / Night</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td class="ps-3 fw-bold">Villa {{ $room->room_number }}</td>
                        <td>{{ $room->room_type }}</td>
                        <td>{{ $room->capacity }} Guests</td>
                        <td class="fw-bold">${{ number_format($room->price_per_night, 2) }}</td>
                        <td><span class="badge bg-primary">{{ $room->status }}</span></td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.rooms') }}" class="btn btn-sm btn-outline-dark">Inventory</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 4. FOLIOS MATCHES -->
    @if($folios->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-folios" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-star me-2 text-warning"></i>Folios & Billing ({{ $folios->count() }})
            </h6>
            <a href="{{ route('admin.folios') }}" class="small text-decoration-none">View All Folios &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Folio #</th>
                        <th>Guest</th>
                        <th>Type</th>
                        <th>Billed Charges</th>
                        <th>Payments</th>
                        <th>Balance</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($folios as $folio)
                    <tr>
                        <td class="ps-3 fw-bold">{{ $folio->folio_no }}</td>
                        <td>{{ $folio->guest->full_name ?? 'N/A' }}</td>
                        <td><span class="badge bg-secondary">{{ $folio->folio_type }}</span></td>
                        <td>${{ number_format($folio->total_charges, 2) }}</td>
                        <td class="text-success">${{ number_format($folio->total_payments, 2) }}</td>
                        <td class="fw-bold {{ $folio->balance > 0 ? 'text-danger' : 'text-success' }}">${{ number_format($folio->balance, 2) }}</td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.folios') }}" class="btn btn-sm btn-outline-dark">Open Folio</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 5. INVOICES MATCHES -->
    @if($invoices->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-invoices" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-receipt me-2 text-primary"></i>Invoices ({{ $invoices->count() }})
            </h6>
            <a href="{{ route('admin.invoices') }}" class="small text-decoration-none">View All Invoices &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Invoice #</th>
                        <th>Guest</th>
                        <th>Issue Date</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $inv)
                    <tr>
                        <td class="ps-3 fw-bold">{{ $inv->invoice_no }}</td>
                        <td>{{ $inv->guest->full_name ?? 'N/A' }}</td>
                        <td>{{ $inv->issue_date ? $inv->issue_date->format('M d, Y') : '-' }}</td>
                        <td class="fw-bold">${{ number_format($inv->grand_total, 2) }}</td>
                        <td><span class="badge {{ $inv->status === 'PAID' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $inv->status }}</span></td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.invoices') }}" class="btn btn-sm btn-outline-dark">Settlement</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 6. MAINTENANCE MATCHES -->
    @if($maintenanceTickets->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-maintenance" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-wrench me-2 text-danger"></i>Maintenance Tickets ({{ $maintenanceTickets->count() }})
            </h6>
            <a href="{{ route('admin.maintenance') }}" class="small text-decoration-none">View All Work Orders &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Room</th>
                        <th>Issue</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintenanceTickets as $ticket)
                    <tr>
                        <td class="ps-3 fw-bold">Villa {{ $ticket->room->room_number ?? 'N/A' }}</td>
                        <td>
                            <div class="fw-semibold">{{ $ticket->issue_title }}</div>
                            <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">{{ $ticket->description }}</small>
                        </td>
                        <td><span class="badge bg-danger">{{ $ticket->priority }}</span></td>
                        <td><span class="badge bg-secondary">{{ $ticket->status }}</span></td>
                        <td>{{ $ticket->assignee->full_name ?? 'Unassigned' }}</td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.maintenance') }}" class="btn btn-sm btn-outline-dark">Work Order</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- 7. USERS MATCHES -->
    @if($users->isNotEmpty())
    <div class="res-card overflow-hidden mb-4" id="section-users" data-aos="fade-up">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-gear me-2 text-secondary"></i>Staff Members ({{ $users->count() }})
            </h6>
            <a href="{{ route('admin.users') }}" class="small text-decoration-none">View All Users &rarr;</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="ps-3 fw-bold text-dark">{{ $user->full_name }}</td>
                        <td>&#64;{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge bg-dark">{{ $user->role }}</span></td>
                        <td>
                            <span class="badge {{ $user->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-dark">Staff Directory</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
@endsection
