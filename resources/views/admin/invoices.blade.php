@extends('admin.layout.app')

@section('title', 'Invoices & Payments')

@section('content')
<div class="container-fluid px-0">

    <!-- Section Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Invoices &amp; Settlement</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">07</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Billing Statements &amp; Payment Receipts</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>
        <button type="button" class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createInvoiceModal">
            <i class="bi bi-plus-lg"></i> Issue New Invoice
        </button>
    </div>

    <!-- Aggregate Counters -->
    <div class="row g-3 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Total Invoices</div>
                <div class="value mt-1">{{ $totalInvoices }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">All generated statements</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Paid & Settled</div>
                <div class="value text-success mt-1">{{ $paidInvoices }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Fully reconciled</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card" style="border-left: 3px solid #DC3545;">
                <div class="label text-danger">Pending Collection</div>
                <div class="value text-danger mt-1">{{ $unpaidInvoices }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Draft / Issued awaiting payment</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card">
                <div class="label">Total Revenue Paid</div>
                <div class="value mt-1 gradient-text-gold">${{ number_format($totalRevenue, 2) }}</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Successful payments received</div>
            </div>
        </div>
    </div>

    <!-- Master Invoices Table -->
    <div class="res-card overflow-hidden" data-aos="fade-up" data-aos-delay="300">
        <div class="p-3 bg-white border-bottom border-1 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <span class="fw-bold text-dark">Invoice Settlement Registry</span>
            <input type="text" id="invoiceTableSearch" class="form-control form-control-sm" placeholder="Search invoice # or guest..." style="width: 240px;">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="invoicesTable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 40px;"></th>
                        <th class="ps-2">Invoice #</th>
                        <th>Guest Information</th>
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
                        'DRAFT'    => 'bg-secondary',
                        'ISSUED'   => 'bg-warning text-dark',
                        'PAID'     => 'bg-success',
                        'VOID'     => 'bg-danger',
                        'REFUNDED' => 'bg-info text-dark',
                    ];
                    @endphp
                    <tr class="invoice-row table-group-divider">
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-secondary py-0 px-2"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#payments-{{ $invoice->id }}"
                                title="View settlement payment transactions">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </td>
                        <td class="ps-2 fw-bold text-dark">{{ $invoice->invoice_no }}</td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $invoice->guest->full_name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $invoice->guest->phone ?? '' }}</small>
                        </td>
                        <td>
                            @if($invoice->folio)
                            <div>{{ $invoice->folio->folio_no }}</div>
                            @if($invoice->folio->reservation && $invoice->folio->reservation->room)
                            <small class="text-muted">Villa {{ $invoice->folio->reservation->room->room_number }}</small>
                            @endif
                            @else
                            <small class="text-muted">Manual Invoice</small>
                            @endif
                        </td>
                        <td>
                            {{ $invoice->issue_date ? $invoice->issue_date->format('M d, Y') : '-' }}
                        </td>
                        <td>${{ number_format($invoice->subtotal, 2) }}</td>
                        <td>
                            <small class="text-muted">
                                +${{ number_format($invoice->tax_amount, 2) }} / -${{ number_format($invoice->discount_amount, 2) }}
                            </small>
                        </td>
                        <td class="fw-bold text-dark fs-6">
                            ${{ number_format($invoice->grand_total, 2) }}
                        </td>
                        <td>
                            <span class="badge {{ $statusBadges[$invoice->status] ?? 'bg-secondary' }}">
                                {{ $invoice->status }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-inline-flex gap-2">
                                @if($invoice->status !== 'PAID' && $invoice->status !== 'VOID')
                                <button type="button"
                                    class="btn btn-sm btn-outline-success add-payment-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addPaymentModal"
                                    data-invoice-id="{{ $invoice->id }}"
                                    data-invoice-no="{{ $invoice->invoice_no }}">
                                    + Pay
                                </button>
                                @endif
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary edit-invoice-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editInvoiceModal"
                                    data-id="{{ $invoice->id }}"
                                    data-no="{{ $invoice->invoice_no }}"
                                    data-folio="{{ $invoice->folio_id }}"
                                    data-guest="{{ $invoice->guest_id }}"
                                    data-date="{{ $invoice->issue_date ? $invoice->issue_date->format('Y-m-d') : '' }}"
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

                    {{-- Child Row: Payment Ledger --}}
                    <tr class="collapse bg-white" id="payments-{{ $invoice->id }}">
                        <td colspan="10" class="p-3 bg-light">
                            <div class="card card-body border-0 shadow-sm p-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        Settlement Transactions for {{ $invoice->invoice_no }} ({{ $invoice->payments->count() }} payments)
                                    </h6>
                                    @if($invoice->status !== 'PAID' && $invoice->status !== 'VOID')
                                    <button type="button"
                                        class="btn btn-sm btn-theme-primary add-payment-btn py-1 px-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addPaymentModal"
                                        data-invoice-id="{{ $invoice->id }}"
                                        data-invoice-no="{{ $invoice->invoice_no }}"
                                        style="font-size: 0.78rem;">
                                        + Record Payment
                                    </button>
                                    @endif
                                </div>
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

        <!-- Table Footer -->
        <div class="p-3 bg-white border-top border-1 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span class="text-muted small" style="font-size: 0.78rem;">
                Showing <span class="fw-bold text-dark">{{ $invoices->count() }}</span> of <span class="fw-bold text-dark">{{ $totalInvoices }}</span> invoices
            </span>
        </div>
    </div>

</div>
@endsection

@section('modals')
<!-- 1. CREATE INVOICE MODAL -->
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
                    <input type="text" name="invoice_no" class="form-control" placeholder="INV-{{ date('Y') }}-{{ rand(1000, 9999) }}" required>
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
                <button type="submit" class="btn btn-theme-primary">Generate Invoice</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT INVOICE MODAL -->
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
                <button type="submit" class="btn btn-theme-primary">Update Invoice</button>
            </div>
        </form>
    </div>
</div>

<!-- 3. ADD PAYMENT MODAL -->
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
                    <input type="text" name="payment_no" class="form-control" placeholder="PAY-{{ date('Y') }}-{{ rand(1000, 9999) }}" required>
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
@endsection

@push('scripts')
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

        // In-table search
        const searchInput = document.getElementById('invoiceTableSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const val = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('.invoice-row');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(val) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush