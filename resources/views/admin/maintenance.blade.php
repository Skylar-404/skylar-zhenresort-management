@extends('admin.layout.app')

@section('title', 'Maintenance & Operations')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Action Buttons -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Operations &amp; Maintenance</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">04</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Engineering &amp; Facility Work Orders</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <!-- Action Tools -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.rooms') }}" class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                <i class="bi bi-building me-1" style="color: var(--resort-gold);"></i> Villa Inventory
            </a>
            <button type="button" class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createTicketModal">
                <i class="bi bi-plus-lg"></i> Create Work Order
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row with Staggered AOS -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Open Work Orders</div>
                <div class="value mt-1">{{ $openTickets }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">
                    {{ $inProgressTickets }} in progress &middot; {{ $pendingTickets }} pending
                </div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #DC3545;">
                <div class="label text-danger">Out of Order Rooms</div>
                <div class="value mt-1 text-danger">{{ $maintenanceRoomsCount }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">
                    @if($maintenanceRooms->isNotEmpty())
                        @foreach($maintenanceRooms->take(2) as $mRoom)
                            <span class="fw-semibold text-dark">Villa {{ $mRoom->room_number }}</span>{{ !$loop->last ? ' & ' : '' }}
                        @endforeach
                        {{ $maintenanceRooms->count() > 2 ? ' + more' : '' }}
                    @else
                        All villas operational
                    @endif
                </div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">Urgent Priority</div>
                <div class="value mt-1 gradient-text-gold">{{ $urgentTicketsCount }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">High / Critical pending orders</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="label">Avg Resolution Time</div>
                <div class="value mt-1" style="color: var(--resort-green);">{{ $avgResolutionHours }}h</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Resort resolution benchmark</div>
            </div>
        </div>
    </div>

    <!-- Main Work Orders Card -->
    <div class="wo-card overflow-hidden">

        <!-- Table Toolbar: Filters & Views -->
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

            <!-- Category Filter Tabs -->
            <div class="btn-group filter-btn-group shadow-sm rounded">
                <button type="button" class="btn active ticket-filter-btn" data-status="ALL">All Tickets ({{ $totalTickets }})</button>
                <button type="button" class="btn ticket-filter-btn" data-status="IN_PROGRESS">In Progress ({{ $inProgressTickets }})</button>
                <button type="button" class="btn ticket-filter-btn" data-status="PENDING">Pending ({{ $pendingTickets }})</button>
                <button type="button" class="btn ticket-filter-btn" data-status="RESOLVED">Resolved ({{ $resolvedTicketsCount }})</button>
                <button type="button" class="btn ticket-filter-btn" data-status="CANCELLED">Cancelled ({{ $cancelledTicketsCount }})</button>
            </div>

            <!-- In-Table Quick Filter -->
            <div class="d-flex gap-2">
                <input type="text" id="ticketTableSearch" class="form-control form-control-sm" placeholder="Filter by villa or issue..." style="width: 220px;">
            </div>
        </div>

        <!-- Work Orders Ledger Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="ticketsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Villa / Room</th>
                        <th>Issue Summary</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned Tech</th>
                        <th>Cost</th>
                        <th>Logged At</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    @php
                    $priorityBadges = [
                        'LOW'      => 'bg-secondary',
                        'MEDIUM'   => 'bg-info text-dark',
                        'HIGH'     => 'bg-warning text-dark',
                        'CRITICAL' => 'bg-danger',
                    ];
                    $statusBadges = [
                        'PENDING'     => 'bg-danger-subtle text-danger border border-danger-subtle',
                        'IN_PROGRESS' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                        'RESOLVED'    => 'bg-success-subtle text-success border border-success-subtle',
                        'CANCELLED'   => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                    ];
                    $priorityClass = $priorityBadges[$ticket->priority] ?? 'bg-secondary';
                    $statusClass = $statusBadges[$ticket->status] ?? 'bg-secondary-subtle text-secondary';
                    @endphp
                    <tr class="ticket-row" data-status="{{ $ticket->status }}">
                        <td class="ps-4">
                            <span class="fw-bold text-dark">Villa {{ $ticket->room->room_number ?? 'N/A' }}</span>
                            <div class="text-muted small">{{ $ticket->room->room_type ?? '' }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $ticket->issue_title }}</div>
                            <div class="text-muted small text-truncate" style="max-width: 260px;">
                                {{ $ticket->description }}
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $priorityClass }}">{{ $ticket->priority }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $statusClass }}">{{ str_replace('_', ' ', $ticket->status) }}</span>
                        </td>
                        <td>
                            <div>{{ $ticket->assignee->full_name ?? 'Unassigned' }}</div>
                            <small class="text-muted">Logged by: {{ $ticket->reporter->full_name ?? 'System' }}</small>
                        </td>
                        <td>
                            @if($ticket->cost)
                            <span class="fw-bold text-dark">${{ number_format($ticket->cost, 2) }}</span>
                            @else
                            <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $ticket->created_at ? $ticket->created_at->format('M d, Y') : '-' }}
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-2">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary edit-ticket-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTicketModal"
                                    data-id="{{ $ticket->id }}"
                                    data-room="{{ $ticket->room_id }}"
                                    data-assigned="{{ $ticket->assigned_to }}"
                                    data-title="{{ $ticket->issue_title }}"
                                    data-description="{{ $ticket->description }}"
                                    data-priority="{{ $ticket->priority }}"
                                    data-status="{{ $ticket->status }}"
                                    data-cost="{{ $ticket->cost }}"
                                    data-started="{{ $ticket->started_at ? $ticket->started_at->format('Y-m-d\TH:i') : '' }}"
                                    data-resolved="{{ $ticket->resolved_at ? $ticket->resolved_at->format('Y-m-d\TH:i') : '' }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.maintenance.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Delete ticket #{{ $ticket->id }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">No maintenance work orders logged.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $tickets->count() }}</span> of <span class="fw-bold text-dark">{{ $totalTickets }}</span> total work orders
            </span>
        </div>

    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE TICKET MODAL -->
<div class="modal fade" id="createTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('admin.maintenance.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Create Maintenance Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Affected Room / Villa</label>
                    <select name="room_id" class="form-select" required>
                        <option value="">-- Choose Villa --</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">Villa {{ $room->room_number }} - {{ $room->room_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Assign Technician</label>
                    <select name="assigned_to" class="form-select">
                        <option value="">-- Unassigned --</option>
                        @foreach($technicians as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->full_name }} (&#64;{{ $tech->username }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Issue Title</label>
                    <input type="text" name="issue_title" class="form-control" placeholder="e.g. Master bathroom AC leaking" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Detailed Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Describe symptoms, equipment codes, or repair requirements..." required></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="LOW">LOW</option>
                        <option value="MEDIUM" selected>MEDIUM</option>
                        <option value="HIGH">HIGH</option>
                        <option value="CRITICAL">CRITICAL</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Initial Status</label>
                    <select name="status" class="form-select" required>
                        <option value="PENDING" selected>PENDING</option>
                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                        <option value="RESOLVED">RESOLVED</option>
                        <option value="CANCELLED">CANCELLED</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Estimated Cost ($)</label>
                    <input type="number" step="0.01" name="cost" class="form-control" placeholder="0.00">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Started At</label>
                    <input type="datetime-local" name="started_at" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Resolved At</label>
                    <input type="datetime-local" name="resolved_at" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Create Ticket</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT TICKET MODAL -->
<div class="modal fade" id="editTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="editTicketForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Maintenance Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Room / Villa</label>
                    <select name="room_id" id="edit_room_id" class="form-select" required>
                        @foreach($rooms as $room)
                        <option value="{{ $room->id }}">Villa {{ $room->room_number }} - {{ $room->room_type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Assign Technician</label>
                    <select name="assigned_to" id="edit_assigned_to" class="form-select">
                        <option value="">-- Unassigned --</option>
                        @foreach($technicians as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Issue Title</label>
                    <input type="text" name="issue_title" id="edit_issue_title" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Description</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Priority</label>
                    <select name="priority" id="edit_priority" class="form-select" required>
                        <option value="LOW">LOW</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="HIGH">HIGH</option>
                        <option value="CRITICAL">CRITICAL</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Ticket Status</label>
                    <select name="status" id="edit_status" class="form-select" required>
                        <option value="PENDING">PENDING</option>
                        <option value="IN_PROGRESS">IN_PROGRESS</option>
                        <option value="RESOLVED">RESOLVED</option>
                        <option value="CANCELLED">CANCELLED</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Repair Cost ($)</label>
                    <input type="number" step="0.01" name="cost" id="edit_cost" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Started At</label>
                    <input type="datetime-local" name="started_at" id="edit_started_at" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Resolved At</label>
                    <input type="datetime-local" name="resolved_at" id="edit_resolved_at" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Update Ticket</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-ticket-btn');
        const form = document.getElementById('editTicketForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                form.action = `/admin/maintenance/${id}`;

                document.getElementById('edit_room_id').value = button.getAttribute('data-room');
                document.getElementById('edit_assigned_to').value = button.getAttribute('data-assigned') || '';
                document.getElementById('edit_issue_title').value = button.getAttribute('data-title');
                document.getElementById('edit_description').value = button.getAttribute('data-description');
                document.getElementById('edit_priority').value = button.getAttribute('data-priority');
                document.getElementById('edit_status').value = button.getAttribute('data-status');
                document.getElementById('edit_cost').value = button.getAttribute('data-cost');
                document.getElementById('edit_started_at').value = button.getAttribute('data-started');
                document.getElementById('edit_resolved_at').value = button.getAttribute('data-resolved');
            });
        });

        // Filter tabs
        const filterButtons = document.querySelectorAll('.ticket-filter-btn');
        const rows = document.querySelectorAll('.ticket-row');

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
        const searchInput = document.getElementById('ticketTableSearch');
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