<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use App\Models\FolioCharge;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FolioController extends Controller
{
    public function index()
    {
        // Eager load nested relations to prevent N+1 queries
        $folios = Folio::with([
            'guest',
            'reservation.room',
            'charges.postedBy'
        ])->latest('opened_at')->get();

        $guests = Guest::where('is_active', 1)->orderBy('last_name')->get();
        $reservations = Reservation::with(['guest', 'room'])
            ->whereIn('status', ['CONFIRMED', 'CHECKED_IN'])
            ->get();

        $totalFolios    = Folio::count();
        $openFolios     = Folio::where('status', 'OPEN')->count();
        $totalCharges   = Folio::sum('total_charges');
        $totalCollected = Folio::sum('total_payments');

        return view('admin.folios', compact(
            'folios',
            'guests',
            'reservations',
            'totalFolios',
            'openFolios',
            'totalCharges',
            'totalCollected'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'folio_no'       => 'required|string|max:64|unique:folios,folio_no',
            'guest_id'       => 'required|exists:guests,id',
            'reservation_id' => 'nullable|exists:reservation,id',
            'folio_type'     => 'required|in:ROOM,MASTER,INCIDENTAL,NON_GUEST',
            'status'         => 'required|in:OPEN,SETTLED,CLOSED,VOID',
            'total_charges'  => 'nullable|numeric|min:0',
            'total_payments' => 'nullable|numeric|min:0',
        ]);

        $validated['total_charges']  = $validated['total_charges'] ?? 0.00;
        $validated['total_payments'] = $validated['total_payments'] ?? 0.00;
        $validated['opened_at']      = now();

        if (in_array($validated['status'], ['SETTLED', 'CLOSED'])) {
            $validated['closed_at'] = now();
        }

        Folio::create($validated);

        return redirect()->route('admin.folios')->with('success', 'Master folio created.');
    }

    public function update(Request $request, $id)
    {
        $folio = Folio::findOrFail($id);

        $validated = $request->validate([
            'folio_no'       => ['required', 'string', 'max:64', Rule::unique('folios')->ignore($folio->id)],
            'guest_id'       => 'required|exists:guests,id',
            'reservation_id' => 'nullable|exists:reservation,id',
            'folio_type'     => 'required|in:ROOM,MASTER,INCIDENTAL,NON_GUEST',
            'status'         => 'required|in:OPEN,SETTLED,CLOSED,VOID',
            'total_charges'  => 'required|numeric|min:0',
            'total_payments' => 'required|numeric|min:0',
        ]);

        if (in_array($validated['status'], ['SETTLED', 'CLOSED']) && !$folio->closed_at) {
            $validated['closed_at'] = now();
        } elseif ($validated['status'] === 'OPEN') {
            $validated['closed_at'] = null;
        }

        $folio->update($validated);

        return redirect()->route('admin.folios')->with('success', 'Folio account updated.');
    }

    public function destroy($id)
    {
        $folio = Folio::findOrFail($id);
        $folio->delete();

        return redirect()->route('admin.folios')->with('success', 'Folio deleted.');
    }

    /**
     * Post a charge into folio_charges and update folio total_charges.
     */
    public function storeCharge(Request $request, $folioId)
    {
        $folio = Folio::findOrFail($folioId);

        $validated = $request->validate([
            'charge_no'             => 'required|string|max:64|unique:folio_charges,charge_no',
            'service_category'      => 'required|in:ROOM,FOOD_BEVERAGE,SPA,ACTIVITY,OTHER',
            'food_service_order_id' => 'nullable|integer',
            'item_description'      => 'required|string|max:255',
            'unit_price'            => 'required|numeric|min:0',
            'quantity'              => 'required|integer|min:1',
            'tax_amount'            => 'nullable|numeric|min:0',
        ]);

        $unitPrice = (float) $validated['unit_price'];
        $quantity  = (int) $validated['quantity'];
        $taxAmount = (float) ($validated['tax_amount'] ?? 0.00);
        $itemTotal = ($unitPrice * $quantity) + $taxAmount;

        DB::transaction(function () use ($folio, $validated, $unitPrice, $quantity, $taxAmount, $itemTotal) {
            FolioCharge::create([
                'charge_no'             => $validated['charge_no'],
                'folio_id'              => $folio->id,
                'service_category'      => $validated['service_category'],
                'food_service_order_id' => $validated['food_service_order_id'] ?? null,
                'item_description'      => $validated['item_description'],
                'unit_price'            => $unitPrice,
                'quantity'              => $quantity,
                'tax_amount'            => $taxAmount,
                'total_amount'          => $itemTotal,
                'is_voided'             => 0,
                'posted_by'             => auth()->id() ?? 1,
                'posted_at'             => now(),
            ]);

            // Sync sum of active line items back into parent folio charges
            $newTotal = FolioCharge::where('folio_id', $folio->id)
                ->where('is_voided', 0)
                ->sum('total_amount');

            $folio->update(['total_charges' => $newTotal]);
        });

        return redirect()->route('admin.folios')->with('success', "Charge successfully posted to Folio {$folio->folio_no}.");
    }

    /**
     * Toggle void status of a charge and adjust folio total.
     */
    public function voidCharge($id)
    {
        $charge = FolioCharge::findOrFail($id);
        $folio = Folio::findOrFail($charge->folio_id);

        DB::transaction(function () use ($charge, $folio) {
            $charge->update(['is_voided' => !$charge->is_voided]);

            $newTotal = FolioCharge::where('folio_id', $folio->id)
                ->where('is_voided', 0)
                ->sum('total_amount');

            $folio->update(['total_charges' => $newTotal]);
        });

        return redirect()->route('admin.folios')->with('success', 'Charge void status updated.');
    }
}
