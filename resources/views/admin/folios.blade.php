@extends('admin.layout.app')

@section('title', 'Finance & Guest Folios')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Finance &amp; Folios</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">05</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Guest Ledgers &amp; Itemized Billing</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>
        <button type="button" class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createFolioModal">
            <i class="bi bi-plus-lg"></i> Open New Folio
        </button>
    </div>

    <!-- Aggregate Counters -->
    <div class="row g-3 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total Folios</div>
                <div class="value mt-1">{{ $totalFolios }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Active ledger accounts</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #DC3545;">
                <div class="label text-danger">Open Accounts</div>
                <div class="value text-danger mt-1">{{ $openFolios }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Pending final checkout / settlement</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">Billed Charges</div>
                <div class="value mt-1 gradient-text-gold">${{ number_format($totalCharges, 2) }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">All line charges posted</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Total Payments</div>
                <div class="value text-success mt-1">${{ number_format($totalCollected, 2) }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Collected &amp; reconciled</div>
            </div>
        </div>
    </div>

    <!-- Master Table with Collapsible Child Charges -->
    <div class="res-card overflow-hidden" data-aos="fade-up" data-aos-delay="300">
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <span class="fw-bold text-dark">Folio Accounts Registry</span>
            <input type="text" id="folioTableSearch" class="form-control form-control-sm" placeholder="Search folio # or guest..." style="width: 240px;">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="foliosTable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;"></th>
                        <th class="ps-2">Folio #</th>
                        <th>Guest Information</th>
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
                        'ROOM'       => 'bg-primary',
                        'MASTER'     => 'bg-dark',
                        'INCIDENTAL' => 'bg-info text-dark',
                        'NON_GUEST'  => 'bg-secondary',
                    ];
                    $statusBadges = [
                        'OPEN'    => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                        'SETTLED' => 'bg-info-subtle text-info-emphasis border border-info-subtle',
                        'CLOSED'  => 'bg-success-subtle text-success border border-success-subtle',
                        'VOID'    => 'bg-danger-subtle text-danger border border-danger-subtle',
                    ];
                    @endphp
                    <tr class="folio-row table-group-divider">
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-0 px-2"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#charges-{{ $folio->id }}"
                                title="View itemized line charges">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </td>
                        <td class="ps-2 fw-bold text-dark">{{ $folio->folio_no }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $folio->guest->full_name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $folio->guest->phone ?? '' }}</small>
                        </td>
                        <td>
                            @if($folio->reservation)
                            <div>{{ $folio->reservation->reservation_no }}</div>
                            <small class="text-muted">Villa {{ $folio->reservation->room->room_number ?? 'N/A' }}</small>
                            @else
                            <small class="text-muted">Non-Guest / Direct Tab</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $typeBadges[$folio->folio_type] ?? 'bg-secondary' }}">{{ $folio->folio_type }}</span>
                        </td>
                        <td class="fw-semibold">${{ number_format($folio->total_charges, 2) }}</td>
                        <td class="text-success fw-semibold">${{ number_format($folio->total_payments, 2) }}</td>
                        <td>
                            @if($folio->balance > 0)
                            <span class="text-danger fw-bold">${{ number_format($folio->balance, 2) }}</span>
                            @else
                            <span class="text-success fw-bold">$0.00</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $statusBadges[$folio->status] ?? 'bg-secondary' }}">{{ $folio->status }}</span>
                        </td>
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
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        Itemized Charges on {{ $folio->folio_no }} ({{ $folio->charges->count() }} items)
                                    </h6>
                                    <button type="button"
                                        class="btn btn-sm btn-theme-primary post-charge-btn py-1 px-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#postChargeModal"
                                        data-folio-id="{{ $folio->id }}"
                                        data-folio-no="{{ $folio->folio_no }}"
                                        style="font-size: 0.78rem;">
                                        + Add Item Charge
                                    </button>
                                </div>
                                @if($folio->charges->isEmpty())
                                <p class="text-muted small mb-0">No itemized line charges posted to this account yet.</p>
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
                                                    <small class="text-muted">{{ $charge->posted_at ? $charge->posted_at->format('M d, Y H:i') : '-' }}</small>
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

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $folios->count() }}</span> of <span class="fw-bold text-dark">{{ $totalFolios }}</span> registered folios
            </span>
        </div>
    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE FOLIO MODAL -->
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
                    <input type="text" name="folio_no" class="form-control" placeholder="FOL-{{ date('Y') }}-{{ rand(1000, 9999) }}" required>
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
                <button type="submit" class="btn btn-theme-primary">Generate Folio</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT FOLIO MODAL -->
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
                <button type="submit" class="btn btn-theme-primary">Update Folio</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. POST ITEM CHARGE MODAL -->
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
                    <input type="text" name="charge_no" class="form-control" placeholder="CHG-{{ date('Y') }}-{{ rand(100, 999) }}" required>
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
                    <input type="text" name="item_description" class="form-control" placeholder="e.g. 2x Signature Cocktail" required>
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
                <button type="submit" class="btn btn-theme-primary">Add to Bill</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
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

        // Search in table
        const searchInput = document.getElementById('folioTableSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const val = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('.folio-row');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(val) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush