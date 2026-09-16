<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::latest()->get();

        // Guest Directory Operational Aggregates
        $totalGuests    = Guest::count();
        $vipGuests      = Guest::whereIn('vip_status', ['SILVER', 'GOLD', 'PLATINUM'])->count();
        $activeProfiles = Guest::where('is_active', 1)->count();

        return view('admin.guests', compact(
            'guests',
            'totalGuests',
            'vipGuests',
            'activeProfiles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'          => 'required|string|max:80',
            'last_name'           => 'required|string|max:80',
            'email'               => 'nullable|email|max:191',
            'phone'               => 'required|string|max:32',
            'identification_type' => 'required|in:PASSPORT,NATIONAL_ID,DRIVING_LICENSE,OTHER',
            'identification_no'   => [
                'required',
                'string',
                'max:100',
                Rule::unique('guests')->where(
                    fn($query) =>
                    $query->where('identification_type', $request->identification_type)
                ),
            ],
            'country_code'        => 'required|string|size:2',
            'address'             => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:100',
            'vip_status'          => 'required|in:STANDARD,SILVER,GOLD,PLATINUM',
            'special_requests'    => 'nullable|string',
            'is_active'           => 'required|boolean',
        ]);

        Guest::create($validated);

        return redirect()->route('admin.guests')->with('success', 'Guest registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guest = Guest::findOrFail($id);

        $validated = $request->validate([
            'first_name'          => 'required|string|max:80',
            'last_name'           => 'required|string|max:80',
            'email'               => 'nullable|email|max:191',
            'phone'               => 'required|string|max:32',
            'identification_type' => 'required|in:PASSPORT,NATIONAL_ID,DRIVING_LICENSE,OTHER',
            'identification_no'   => [
                'required',
                'string',
                'max:100',
                Rule::unique('guests')->where(
                    fn($query) =>
                    $query->where('identification_type', $request->identification_type)
                )->ignore($guest->id),
            ],
            'country_code'        => 'required|string|size:2',
            'address'             => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:100',
            'vip_status'          => 'required|in:STANDARD,SILVER,GOLD,PLATINUM',
            'special_requests'    => 'nullable|string',
            'is_active'           => 'required|boolean',
        ]);

        $guest->update($validated);

        return redirect()->route('admin.guests')->with('success', 'Guest details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete(); // Soft deletes record

        return redirect()->route('admin.guests')->with('success', 'Guest record archived.');
    }
}
