<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use App\Models\Guest;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with([
            'guest',
            'folio.reservation.room',
            'payments.processedBy'
        ])->latest('issue_date')->get();

        $guests = Guest::where('is_active', 1)->orderBy('last_name')->get();
        $folios = Folio::with('guest')->whereIn('status', ['OPEN', 'SETTLED'])->get();

        // Operational Aggregates
        $totalInvoices  = Invoice::count();
        $paidInvoices   = Invoice::where('status', 'PAID')->count();
        $unpaidInvoices = Invoice::whereIn('status', ['DRAFT', 'ISSUED'])->count();
        $totalRevenue   = Payment::where('payment_status', 'SUCCESS')->sum('amount');

        return view('admin.invoices', compact(
            'invoices',
            'guests',
            'folios',
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'totalRevenue'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_no'      => 'required|string|max:64|unique:invoices,invoice_no',
            'folio_id'        => 'required|exists:folios,id',
            'guest_id'        => 'required|exists:guests,id',
            'issue_date'      => 'required|date',
            'subtotal'        => 'required|numeric|min:0',
            'tax_amount'      => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'status'          => 'required|in:DRAFT,ISSUED,PAID,VOID,REFUNDED',
        ]);

        $subtotal = (float) $validated['subtotal'];
        $tax      = (float) ($validated['tax_amount'] ?? 0);
        $discount = (float) ($validated['discount_amount'] ?? 0);

        $validated['tax_amount']      = $tax;
        $validated['discount_amount'] = $discount;
        $validated['grand_total']     = max(0, ($subtotal + $tax) - $discount);

        Invoice::create($validated);

        return redirect()->route('admin.invoices')->with('success', 'Tax invoice generated successfully.');
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'invoice_no'      => ['required', 'string', 'max:64', Rule::unique('invoices')->ignore($invoice->id)],
            'folio_id'        => 'required|exists:folios,id',
            'guest_id'        => 'required|exists:guests,id',
            'issue_date'      => 'required|date',
            'subtotal'        => 'required|numeric|min:0',
            'tax_amount'      => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
            'status'          => 'required|in:DRAFT,ISSUED,PAID,VOID,REFUNDED',
        ]);

        $subtotal = (float) $validated['subtotal'];
        $tax      = (float) $validated['tax_amount'];
        $discount = (float) $validated['discount_amount'];

        $validated['grand_total'] = max(0, ($subtotal + $tax) - $discount);

        $invoice->update($validated);

        return redirect()->route('admin.invoices')->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.invoices')->with('success', 'Invoice deleted.');
    }

    /**
     * Record a child payment against this invoice and sync totals.
     */
    public function storePayment(Request $request, $invoiceId)
    {
        $invoice = Invoice::with('folio')->findOrFail($invoiceId);

        $validated = $request->validate([
            'payment_no'            => 'required|string|max:64|unique:payments,payment_no',
            'amount'                => 'required|numeric|min:0.01',
            'payment_method'        => 'required|in:CASH,CREDIT_CARD,DEBIT_CARD,BANK_TRANSFER',
            'transaction_reference' => 'nullable|string|max:128',
            'payment_status'        => 'required|in:SUCCESS,FAILED,PENDING,REFUNDED',
        ]);

        DB::transaction(function () use ($invoice, $validated) {
            Payment::create([
                'payment_no'            => $validated['payment_no'],
                'folio_id'              => $invoice->folio_id,
                'invoice_id'            => $invoice->id,
                'amount'                => $validated['amount'],
                'payment_method'        => $validated['payment_method'],
                'transaction_reference' => $validated['transaction_reference'] ?? null,
                'payment_status'        => $validated['payment_status'],
                'paid_at'               => now(),
                'processed_by'          => auth()->id() ?? 1,
            ]);

            // If successful payment meets or exceeds the grand total, mark invoice as PAID
            if ($validated['payment_status'] === 'SUCCESS') {
                $totalPaid = Payment::where('invoice_id', $invoice->id)
                    ->where('payment_status', 'SUCCESS')
                    ->sum('amount');

                if ($totalPaid >= $invoice->grand_total) {
                    $invoice->update(['status' => 'PAID']);
                }

                // Also sync total_payments into the parent folio
                if ($invoice->folio) {
                    $invoice->folio->increment('total_payments', $validated['amount']);
                }
            }
        });

        return redirect()->route('admin.invoices')->with('success', 'Payment recorded successfully.');
    }
}
