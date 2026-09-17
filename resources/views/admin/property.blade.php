@extends('admin.layout.app')

@section('title', 'Property & Villa Inventory')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Property &amp; Inventory</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">03</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Room &amp; Villa Inventory</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="button" class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                <i class="bi bi-plus-lg"></i> Add Villa / Room
            </button>
        </div>
    </div>

    <!-- Aggregate Counters with Staggered AOS -->
    <div class="row g-3 mb-4">
        <div class="col-md" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total Inventory</div>
                <div class="value mt-1">{{ $totalRooms }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">All resort units</div>
            </div>
        </div>
        <div class="col-md" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Available (Ready)</div>
                <div class="value text-success mt-1">{{ $availableRooms }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Ready for check-in</div>
            </div>
        </div>
        <div class="col-md" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card" style="border-left: 3px solid #0A3251;">
                <div class="label" style="color: #0A3251;">Occupied (In-House)</div>
                <div class="value mt-1" style="color: #0A3251;">{{ $occupiedRooms }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Currently occupied</div>
            </div>
        </div>
        <div class="col-md" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card" style="border-left: 3px solid #AD8322;">
                <div class="label" style="color: #AD8322;">Housekeeping (Dirty)</div>
                <div class="value mt-1" style="color: #AD8322;">{{ $dirtyRooms }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Awaiting cleaning</div>
            </div>
        </div>
        <div class="col-md" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card" style="border-left: 3px solid #DC3545;">
                <div class="label text-danger">Out of Order</div>
                <div class="value text-danger mt-1">{{ $maintenanceRooms }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Maintenance hold</div>
            </div>
        </div>
    </div>

    <!-- Room Inventory Card with AOS -->
    <div class="res-card overflow-hidden" data-aos="fade-up" data-aos-delay="350">
        <!-- Table Toolbar -->
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <!-- Filter buttons -->
            <div class="btn-group filter-btn-group shadow-sm rounded">
                <button type="button" class="btn active room-filter-btn" data-status="ALL">All ({{ $totalRooms }})</button>
                <button type="button" class="btn room-filter-btn" data-status="AVAILABLE">Available ({{ $availableRooms }})</button>
                <button type="button" class="btn room-filter-btn" data-status="OCCUPIED">Occupied ({{ $occupiedRooms }})</button>
                <button type="button" class="btn room-filter-btn" data-status="DIRTY">Dirty ({{ $dirtyRooms }})</button>
                <button type="button" class="btn room-filter-btn" data-status="MAINTENANCE">Maintenance ({{ $maintenanceRooms }})</button>
            </div>

            <!-- In-Table Quick Filter -->
            <div class="d-flex gap-2">
                <input type="text" id="roomTableSearch" class="form-control form-control-sm" placeholder="Filter villa or type..." style="width: 200px;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="roomsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Villa / Room #</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Nightly Rate</th>
                        <th>Status</th>
                        <th>Housekeeping Action</th>
                        <th>Features / Description</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                    @php
                    $statusClasses = [
                        'AVAILABLE'   => 'bg-success-subtle text-success border border-success-subtle',
                        'OCCUPIED'    => 'bg-primary-subtle text-primary border border-primary-subtle',
                        'DIRTY'       => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                        'MAINTENANCE' => 'bg-danger-subtle text-danger border border-danger-subtle',
                    ];
                    @endphp
                    <tr class="room-row" data-status="{{ $room->status }}">
                        <td class="ps-4 fw-bold fs-6">
                            Villa {{ $room->room_number }}
                        </td>
                        <td>{{ $room->room_type }}</td>
                        <td>{{ $room->capacity }} Guests</td>
                        <td class="fw-bold text-dark">${{ number_format($room->price_per_night, 2) }}</td>
                        <td>
                            <span class="badge {{ $statusClasses[$room->status] ?? 'bg-secondary' }}">
                                {{ $room->status }}
                            </span>
                        </td>
                        <td>
                            {{-- Quick One-Click Housekeeping State Transitions --}}
                            @if($room->status === 'DIRTY')
                            <form action="{{ route('admin.rooms.status.update', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="AVAILABLE">
                                <button type="submit" class="btn btn-sm btn-outline-success py-0 px-2" style="font-size: 0.75rem;">
                                    &#10003; Mark Cleaned
                                </button>
                            </form>
                            @elseif($room->status === 'AVAILABLE')
                            <form action="{{ route('admin.rooms.status.update', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="DIRTY">
                                <button type="submit" class="btn btn-sm btn-outline-warning py-0 px-2" style="font-size: 0.75rem;">
                                    Mark Dirty
                                </button>
                            </form>
                            @else
                            <span class="text-muted small">{{ $room->status === 'OCCUPIED' ? 'In-House Guest' : 'Under Repair' }}</span>
                            @endif
                        </td>
                        <td class="text-muted small text-truncate" style="max-width: 250px;">
                            {{ $room->description ?? '-' }}
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-2">
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary edit-room-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editRoomModal"
                                    data-id="{{ $room->id }}"
                                    data-no="{{ $room->room_number }}"
                                    data-type="{{ $room->room_type }}"
                                    data-cap="{{ $room->capacity }}"
                                    data-price="{{ $room->price_per_night }}"
                                    data-status="{{ $room->status }}"
                                    data-desc="{{ $room->description }}">
                                    Edit
                                </button>

                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Delete room {{ $room->room_number }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" {{ $room->status === 'OCCUPIED' ? 'disabled' : '' }}>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">No rooms found in inventory.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $rooms->count() }}</span> of <span class="fw-bold text-dark">{{ $totalRooms }}</span> units
            </span>
        </div>
    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE ROOM MODAL -->
<div class="modal fade" id="createRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.rooms.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Villa / Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Room / Villa #</label>
                    <input type="text" name="room_number" class="form-control" placeholder="e.g. V-101" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Room Type</label>
                    <input type="text" name="room_type" class="form-control" placeholder="e.g. Oceanfront Pool Villa" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Max Capacity</label>
                    <input type="number" name="capacity" class="form-control" value="2" min="1" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Price Per Night ($)</label>
                    <input type="number" step="0.01" name="price_per_night" class="form-control" placeholder="250.00" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Initial Status</label>
                    <select name="status" class="form-select" required>
                        <option value="AVAILABLE" selected>AVAILABLE (Ready)</option>
                        <option value="DIRTY">DIRTY (Needs Housekeeping)</option>
                        <option value="MAINTENANCE">MAINTENANCE (Out of Order)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Features / Notes</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="King bed, private pool, ocean view..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Create Room</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT ROOM MODAL -->
<div class="modal fade" id="editRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editRoomForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Villa Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Room / Villa #</label>
                    <input type="text" name="room_number" id="edit_room_number" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Room Type</label>
                    <input type="text" name="room_type" id="edit_room_type" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Max Capacity</label>
                    <input type="number" name="capacity" id="edit_capacity" class="form-control" min="1" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Price Per Night ($)</label>
                    <input type="number" step="0.01" name="price_per_night" id="edit_price_per_night" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" id="edit_status" class="form-select" required>
                        <option value="AVAILABLE">AVAILABLE (Ready)</option>
                        <option value="OCCUPIED">OCCUPIED (In-House)</option>
                        <option value="DIRTY">DIRTY (Needs Housekeeping)</option>
                        <option value="MAINTENANCE">MAINTENANCE (Out of Order)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold">Features / Notes</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-theme-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-room-btn');
        const form = document.getElementById('editRoomForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                form.action = `/admin/room/${id}`;

                document.getElementById('edit_room_number').value = button.getAttribute('data-no') || '';
                document.getElementById('edit_room_type').value = button.getAttribute('data-type') || '';
                document.getElementById('edit_capacity').value = button.getAttribute('data-cap') || '2';
                document.getElementById('edit_price_per_night').value = button.getAttribute('data-price') || '';
                document.getElementById('edit_status').value = button.getAttribute('data-status') || 'AVAILABLE';
                document.getElementById('edit_description').value = button.getAttribute('data-desc') || '';
            });
        });

        // Filter tabs
        const filterButtons = document.querySelectorAll('.room-filter-btn');
        const rows = document.querySelectorAll('.room-row');

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
        const searchInput = document.getElementById('roomTableSearch');
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