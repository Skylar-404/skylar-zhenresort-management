@extends('admin.layout.app')

@section('title', 'Guests CRM')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Action Buttons -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Guest Profiles &amp; CRM</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">06</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Guest Profiles &amp; Preferences Directory</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <!-- Action Tools -->
        <div class="d-flex gap-2">
            <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createGuestModal">
                <i class="bi bi-person-plus"></i> Add New Profile
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total Guest Profiles</div>
                <div class="value mt-1">{{ $totalGuests }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Registered in PMS directory</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Currently In-House</div>
                <div class="value text-success mt-1">{{ $inHouseGuestsCount }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">
                    <span class="text-success fw-bold">{{ $occupiedRoomsCount }}</span> rooms occupied
                </div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">Club VIP Members</div>
                <div class="value mt-1 gradient-text-gold">{{ $vipGuests }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Platinum &amp; Gold tiers</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="label">Average Lifetime Spend</div>
                <div class="value mt-1" style="color: var(--resort-green);">${{ number_format($avgLifetimeSpend, 2) }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Per guest profile</div>
            </div>
        </div>
    </div>

    <!-- Main CRM Card -->
    <div class="guest-card overflow-hidden" data-aos="fade-up" data-aos-delay="300">

        <!-- Table Toolbar: Filters & Views -->
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">

            <!-- Category Filter Tabs -->
            <div class="btn-group filter-btn-group shadow-sm rounded">
                <button type="button" class="btn active guest-filter-btn" data-vip="ALL">All Profiles ({{ $totalGuests }})</button>
                <button type="button" class="btn guest-filter-btn" data-vip="PLATINUM">Platinum</button>
                <button type="button" class="btn guest-filter-btn" data-vip="GOLD">Gold</button>
                <button type="button" class="btn guest-filter-btn" data-vip="SILVER">Silver</button>
                <button type="button" class="btn guest-filter-btn" data-vip="STANDARD">Standard</button>
            </div>

            <!-- In-Table Quick Search -->
            <div class="d-flex gap-2">
                <input type="text" id="guestTableSearch" class="form-control form-control-sm" placeholder="Search name, phone, email..." style="width: 240px;">
            </div>
        </div>

        <!-- Guest Records Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="guestsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Full Name</th>
                        <th>Contact</th>
                        <th>Identification Document</th>
                        <th>Country / City</th>
                        <th>VIP Tier</th>
                        <th>Account Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $guest)
                    @php
                    $vipBadges = [
                        'STANDARD' => 'bg-secondary',
                        'SILVER'   => 'bg-info text-dark',
                        'GOLD'     => 'bg-warning text-dark',
                        'PLATINUM' => 'bg-dark text-white',
                    ];
                    $badgeClass = $vipBadges[$guest->vip_status] ?? 'bg-secondary';
                    @endphp
                    <tr class="guest-row" data-vip="{{ $guest->vip_status }}">
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($guest->first_name, 0, 1) . substr($guest->last_name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $guest->full_name }}</div>
                                    @if($guest->special_requests)
                                    <small class="text-muted d-block text-truncate" style="max-width: 220px;">
                                        Note: {{ $guest->special_requests }}
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $guest->phone }}</div>
                            <small class="text-muted">{{ $guest->email ?? 'No email' }}</small>
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
                                    data-active="{{ $guest->is_active ? '1' : '0' }}">
                                    Edit
                                </button>

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

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $guests->count() }}</span> of <span class="fw-bold text-dark">{{ $totalGuests }}</span> guest profiles
            </span>
        </div>

    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE GUEST MODAL -->
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
                        <option value="STANDARD" selected>STANDARD</option>
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
                        <option value="1" selected>Active</option>
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
                <button type="submit" class="btn btn-theme-primary">Save Guest</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT GUEST MODAL -->
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
                <button type="submit" class="btn btn-theme-primary">Update Guest</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-guest-btn');
        const form = document.getElementById('editGuestForm');

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                form.action = `/admin/guests/${id}`;

                document.getElementById('edit_first_name').value = button.getAttribute('data-first') || '';
                document.getElementById('edit_last_name').value = button.getAttribute('data-last') || '';
                document.getElementById('edit_phone').value = button.getAttribute('data-phone') || '';
                document.getElementById('edit_email').value = button.getAttribute('data-email') || '';
                document.getElementById('edit_id_type').value = button.getAttribute('data-idtype') || 'PASSPORT';
                document.getElementById('edit_id_no').value = button.getAttribute('data-idno') || '';
                document.getElementById('edit_country').value = button.getAttribute('data-country') || '';
                document.getElementById('edit_city').value = button.getAttribute('data-city') || '';
                document.getElementById('edit_address').value = button.getAttribute('data-address') || '';
                document.getElementById('edit_vip').value = button.getAttribute('data-vip') || 'STANDARD';
                document.getElementById('edit_requests').value = button.getAttribute('data-requests') || '';
                document.getElementById('edit_is_active').value = button.getAttribute('data-active') || '1';
            });
        });

        // Filter tabs
        const filterButtons = document.querySelectorAll('.guest-filter-btn');
        const rows = document.querySelectorAll('.guest-row');

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const targetVip = btn.getAttribute('data-vip');

                rows.forEach(row => {
                    if (targetVip === 'ALL' || row.getAttribute('data-vip') === targetVip) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // In-table search
        const searchInput = document.getElementById('guestTableSearch');
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