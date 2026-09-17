@extends('admin.layout.app')

@section('title', 'Reservations')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Action Buttons -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Reservations</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">02</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Booking Manifest &amp; Stays</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <!-- Action Tools -->
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                <i class="bi bi-calendar-range me-1" style="color: var(--resort-gold);"></i> {{ now()->format('d M') }} - {{ now()->addDays(7)->format('d M Y') }}
            </button>
            <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createReservationModal">
                <i class="bi bi-plus-lg"></i> New Reservation
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row with Staggered AOS -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total On Books</div>
                <div class="value mt-1">{{ $totalBookings }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Total stays logged in system</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card">
                <div class="label">Arriving Today</div>
                <div class="value mt-1 gradient-text-gold">{{ $arrivingToday }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">
                    <span class="text-success fw-bold">{{ $checkedInToday }}</span> checked in &middot; {{ $arrivingToday }} expected
                </div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">Pacing Revenue</div>
                <div class="value mt-1" style="color: var(--resort-green);">${{ number_format($pacingRevenue, 2) }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Confirmed &amp; In-house revenue</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="label">Avg. Length of Stay</div>
                <div class="value mt-1 gradient-text-gold">{{ $avgStayLength }}d</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Average duration across stays</div>
            </div>
        </div>
    </div>

    <!-- Main Ledger Card with AOS -->
    <div class="res-card overflow-hidden" data-aos="fade-up" data-aos-delay="300">

        <!-- Table Toolbar: Filters & Quick Search -->
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

            <!-- Status Filter Tabs -->
            <div class="btn-group filter-btn-group shadow-sm rounded">
                <button type="button" class="btn active status-filter-btn" data-status="ALL">All ({{ $totalBookings }})</button>
                <button type="button" class="btn status-filter-btn" data-status="CONFIRMED">Confirmed ({{ $confirmedStays }})</button>
                <button type="button" class="btn status-filter-btn" data-status="CHECKED_IN">Checked In ({{ $activeCheckIns }})</button>
                <button type="button" class="btn status-filter-btn" data-status="PENDING">Pending ({{ $pendingStays }})</button>
                <button type="button" class="btn status-filter-btn" data-status="CANCELLED">Cancelled ({{ $cancelledStays }})</button>
            </div>

            <!-- In-Table Quick Filter -->
            <div class="d-flex gap-2">
                <input type="text" id="reservationTableSearch" class="form-control form-control-sm" placeholder="Filter by guest or room..." style="width: 220px;">
            </div>
        </div>

        <!-- Reservation Records Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="reservationsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Reference #</th>
                        <th>Guest Information</th>
                        <th>Room / Villa</th>
                        <th>Stay Dates</th>
                        <th>Rate / Night</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    @php
                    $statusStyles = [
                        'CONFIRMED'   => 'status-pill-confirmed',
                        'CHECKED_IN'  => 'status-pill-checkedin',
                        'CHECKED_OUT' => 'bg-secondary text-white',
                        'CANCELLED'   => 'status-pill-cancelled',
                        'PENDING'     => 'status-pill-pending',
                        'NO_SHOW'     => 'bg-dark text-white',
                    ];
                    @endphp
                    <tr class="res-row" data-status="{{ $res->status }}">
                        <td class="ps-4 fw-bold text-dark">
                            {{ $res->reservation_no }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($res->guest->first_name ?? 'G', 0, 1) . substr($res->guest->last_name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $res->guest->full_name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $res->guest->phone ?? '' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($res->room)
                            <span class="room-assigned-tag">Villa {{ $res->room->room_number }}</span>
                            <small class="text-muted d-block">{{ $res->room->room_type }}</small>
                            @else
                            <span class="text-muted">Unassigned</span>
                            @endif
                        </td>
                        <td>
                            <div>
                                {{ $res->check_in_date ? $res->check_in_date->format('M d, Y') : '-' }} &rarr;
                                {{ $res->check_out_date ? $res->check_out_date->format('M d, Y') : '-' }}
                            </div>
                            <small class="text-muted">
                                {{ $res->check_in_date && $res->check_out_date ? max(1, $res->check_in_date->diffInDays($res->check_out_date)) : 1 }} night(s) &bull; {{ $res->adults_count }} Ad / {{ $res->children_count }} Ch
                            </small>
                        </td>
                        <td class="fw-bold text-dark">
                            ${{ number_format($res->nightly_rate, 2) }}
                        </td>
                        <td>
                            <span class="badge bg-light text-secondary border">{{ $res->booking_source }}</span>
                        </td>
                        <td>
                            <span class="status-pill {{ $statusStyles[$res->status] ?? 'bg-secondary text-white' }}">
                                {{ $res->status }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-2">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary edit-res-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editReservationModal"
                                    data-id="{{ $res->id }}"
                                    data-no="{{ $res->reservation_no }}"
                                    data-guest="{{ $res->guest_id }}"
                                    data-room="{{ $res->room_id }}"
                                    data-checkin="{{ $res->check_in_date ? $res->check_in_date->format('Y-m-d') : '' }}"
                                    data-checkout="{{ $res->check_out_date ? $res->check_out_date->format('Y-m-d') : '' }}"
                                    data-rate="{{ $res->nightly_rate }}"
                                    data-status="{{ $res->status }}"
                                    data-source="{{ $res->booking_source }}"
                                    data-adults="{{ $res->adults_count }}"
                                    data-children="{{ $res->children_count }}"
                                    data-instructions="{{ $res->special_instructions }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('Cancel/Delete reservation {{ $res->reservation_no }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">No reservations booked.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $reservations->count() }}</span> of <span class="fw-bold text-dark">{{ $totalBookings }}</span> total bookings
            </span>
        </div>

    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE RESERVATION MODAL -->
<div class="modal fade" id="createReservationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('admin.reservations.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">New Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Reservation Reference</label>
                    <input type="text" name="reservation_no" class="form-control" placeholder="e.g. RES-{{ date('Y') }}-{{ rand(100, 999) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Booking Source</label>
                    <select name="booking_source" class="form-select" required>
                        <option value="DIRECT">DIRECT</option>
                        <option value="WEBSITE">WEBSITE</option>
                        <option value="OTA_BOOKING">OTA_BOOKING</option>
                        <option value="OTA_EXPEDIA">OTA_EXPEDIA</option>
                        <option value="PHONE">PHONE</option>
                        <option value="WALK_IN">WALK_IN</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Select Guest</label>
                    <select name="guest_id" class="form-select" required>
                        <option value="">-- Choose registered guest --</option>
                        @foreach($guests as $guest)
                        <option value="{{ $guest->id }}">{{ $guest->last_name }}, {{ $guest->first_name }} ({{ $guest->phone }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Assign Villa / Room</label>
                    <select name="room_id" class="form-select" required>
                        <option value="">-- Choose villa --</option>
                        @foreach($availableRooms as $room)
                        <option value="{{ $room->id }}">Villa {{ $room->room_number }} - {{ $room->room_type }} (${{ number_format($room->price_per_night, 2) }}/night)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Check-In Date</label>
                    <input type="date" name="check_in_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Check-Out Date</label>
                    <input type="date" name="check_out_date" class="form-control" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Nightly Rate ($)</label>
                    <input type="number" step="0.01" name="nightly_rate" class="form-control" placeholder="250.00" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Adults Count</label>
                    <input type="number" name="adults_count" class="form-control" value="2" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Children Count</label>
                    <input type="number" name="children_count" class="form-control" value="0" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Booking Status</label>
                    <select name="status" class="form-select" required>
                        <option value="CONFIRMED" selected>CONFIRMED</option>
                        <option value="CHECKED_IN">CHECKED_IN</option>
                        <option value="CHECKED_OUT">CHECKED_OUT</option>
                        <option value="CANCELLED">CANCELLED</option>
                        <option value="NO_SHOW">NO_SHOW</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Special Requests</label>
                    <textarea name="special_instructions" class="form-control" rows="2" placeholder="Airport transfer, extra pillow, honeymoon setup..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Save Booking</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT RESERVATION MODAL -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="editReservationForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Modify Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Reservation Reference</label>
                    <input type="text" name="reservation_no" id="edit_reservation_no" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Booking Source</label>
                    <select name="booking_source" id="edit_booking_source" class="form-select" required>
                        <option value="DIRECT">DIRECT</option>
                        <option value="WEBSITE">WEBSITE</option>
                        <option value="OTA_BOOKING">OTA_BOOKING</option>
                        <option value="OTA_EXPEDIA">OTA_EXPEDIA</option>
                        <option value="PHONE">PHONE</option>
                        <option value="WALK_IN">WALK_IN</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Guest</label>
                    <select name="guest_id" id="edit_guest_id" class="form-select" required>
                        @foreach($guests as $guest)
                        <option value="{{ $guest->id }}">{{ $guest->last_name }}, {{ $guest->first_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Villa / Room</label>
                    <select name="room_id" id="edit_room_id" class="form-select" required>
                        @foreach($availableRooms as $room)
                        <option value="{{ $room->id }}">Villa {{ $room->room_number }} - {{ $room->room_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Check-In Date</label>
                    <input type="date" name="check_in_date" id="edit_check_in_date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Check-Out Date</label>
                    <input type="date" name="check_out_date" id="edit_check_out_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Nightly Rate ($)</label>
                    <input type="number" step="0.01" name="nightly_rate" id="edit_nightly_rate" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Adults Count</label>
                    <input type="number" name="adults_count" id="edit_adults_count" class="form-control" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Children Count</label>
                    <input type="number" name="children_count" id="edit_children_count" class="form-control" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" id="edit_status" class="form-select" required>
                        <option value="CONFIRMED">CONFIRMED</option>
                        <option value="CHECKED_IN">CHECKED_IN</option>
                        <option value="CHECKED_OUT">CHECKED_OUT</option>
                        <option value="CANCELLED">CANCELLED</option>
                        <option value="NO_SHOW">NO_SHOW</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Special Requests</label>
                    <textarea name="special_instructions" id="edit_special_instructions" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Update Booking</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-res-btn');
        const form = document.getElementById('editReservationForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                form.action = `/admin/reservations/${id}`;

                document.getElementById('edit_reservation_no').value = button.getAttribute('data-no') || '';
                document.getElementById('edit_booking_source').value = button.getAttribute('data-source') || 'DIRECT';
                document.getElementById('edit_guest_id').value = button.getAttribute('data-guest') || '';
                document.getElementById('edit_room_id').value = button.getAttribute('data-room') || '';
                document.getElementById('edit_check_in_date').value = button.getAttribute('data-checkin') || '';
                document.getElementById('edit_check_out_date').value = button.getAttribute('data-checkout') || '';
                document.getElementById('edit_nightly_rate').value = button.getAttribute('data-rate') || '';
                document.getElementById('edit_adults_count').value = button.getAttribute('data-adults') || '1';
                document.getElementById('edit_children_count').value = button.getAttribute('data-children') || '0';
                document.getElementById('edit_status').value = button.getAttribute('data-status') || 'CONFIRMED';
                document.getElementById('edit_special_instructions').value = button.getAttribute('data-instructions') || '';
            });
        });

        // Client-side quick status filtering
        const filterButtons = document.querySelectorAll('.status-filter-btn');
        const rows = document.querySelectorAll('.res-row');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const targetStatus = btn.getAttribute('data-status');

                rows.forEach(row => {
                    if (targetStatus === 'ALL' || row.getAttribute('data-status') === targetStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Search in table
        const searchInput = document.getElementById('reservationTableSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const val = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(val) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush