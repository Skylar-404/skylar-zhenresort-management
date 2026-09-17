@extends('admin.layout.app')

@section('title', 'Experiences & Guest Services')

@push('styles')
<style>
    /* ==================== SERVICES COMPONENTS ==================== */
    .service-card {
        background: #ffffff;
        border: 1px solid var(--resort-border-gold);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(1, 32, 32, 0.12);
        border-color: var(--resort-gold);
    }

    .service-card-header {
        height: 160px;
        position: relative;
        display: flex;
        align-items: flex-end;
        padding: 1rem;
        color: #ffffff;
    }

    /* Gradient Backdrops representing each service */
    .bg-spa {
        background: linear-gradient(135deg, rgba(27, 53, 39, 0.9), rgba(43, 98, 74, 0.75)), url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=600&q=80') center/cover;
    }

    .bg-dinner {
        background: linear-gradient(135deg, rgba(74, 38, 20, 0.85), rgba(196, 154, 58, 0.75)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=600&q=80') center/cover;
    }

    .bg-temple {
        background: linear-gradient(135deg, rgba(30, 42, 56, 0.9), rgba(58, 79, 97, 0.75)), url('https://images.unsplash.com/photo-1528181304800-259b08848526?auto=format&fit=crop&w=600&q=80') center/cover;
    }

    .bg-dining {
        background: linear-gradient(135deg, rgba(35, 31, 32, 0.9), rgba(100, 85, 75, 0.75)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=600&q=80') center/cover;
    }

    .service-badge-pill {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 4px;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .service-card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .spec-tag {
        font-size: 0.7rem;
        color: #6d726a;
        border: 1px solid #e7e4dc;
        border-radius: 4px;
        padding: 2px 7px;
        background: #faf8f5;
    }

    /* Service Orders Table */
    .service-table th {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 600;
        color: #8A8D86;
        border-bottom: 1px solid var(--mv-border);
        padding: 0.85rem 1rem;
        background-color: #FAFAF8;
    }

    .service-table td {
        font-size: 0.85rem;
        padding: 0.95rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0ECE4;
    }

    .status-pill {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 3px 9px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .status-pill-confirmed {
        background-color: var(--status-confirmed-bg);
        color: var(--status-confirmed-txt);
    }

    .status-pill-inprep {
        background-color: var(--status-inprep-bg);
        color: var(--status-inprep-txt);
    }

    .status-pill-completed {
        background-color: var(--status-completed-bg);
        color: var(--status-completed-txt);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">

    <!-- Section Title & Action Buttons -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3" data-aos="fade-down" data-aos-duration="700">
        <div>
            <h1 class="display-6 font-script fw-bold mb-1" style="color: var(--resort-green);">Services &amp; Experiences</h1>
            <div class="d-flex align-items-center gap-2 mt-2">
                <span class="fw-bold small" style="color: var(--resort-gold) !important; font-size: 0.78rem;">08</span>
                <span class="text-uppercase fw-semibold" style="letter-spacing: 1.8px; font-size: 0.68rem; color: #72756F;">Curated Resort Concierge &amp; Spa Offerings</span>
                <span class="border-top" style="width: 35px; border-color: var(--resort-border-gold) !important;"></span>
            </div>
        </div>

        <!-- Action Tools -->
        <div class="d-flex gap-2">
            <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.82rem; border-color: #D3CABA; background-color: #fff;">
                <i class="bi bi-calendar-week me-1" style="color: var(--resort-gold);"></i> Today's Schedule
            </button>
            <button class="btn btn-theme-primary shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                <i class="bi bi-plus-lg"></i> Book Guest Experience
            </button>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="label">Booked Experiences Today</div>
                <div class="value mt-1">14</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">8 Completed &middot; 6 Upcoming</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-card">
                <div class="label">Spa &amp; Tour Availability</div>
                <div class="value mt-1" style="color: var(--resort-green);">4 Slots</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">2 Spa &middot; 2 In-Room Dining holds</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="label">Experience Revenue (Today)</div>
                <div class="value mt-1 gradient-text-gold">$3,840</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">+24% vs. weekly average</div>
            </div>
        </div>
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-card" style="border-left: 3px solid #1C7C4C;">
                <div class="label text-success">Guest Satisfaction Score</div>
                <div class="value mt-1 text-success">4.96</div>
                <div class="text-muted small mt-1" style="font-size: 0.75rem;">Based on 82 post-stay reviews</div>
            </div>
        </div>
    </div>

    <!-- 4 CURATED SERVICE OPTIONS (Grid) -->
    <h6 class="text-uppercase fw-bold text-muted small mb-3" style="letter-spacing: 1px; font-size: 0.72rem;">Available Resort Services</h6>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-5">

        <!-- Service 1: Spas -->
        <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
                <div class="service-card-header bg-spa">
                    <div>
                        <span class="service-badge-pill mb-1 d-inline-block">Wellness &amp; Health</span>
                        <h5 class="fw-bold mb-0 text-white">Pavilion Spas</h5>
                    </div>
                </div>
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <span class="fw-bold text-dark fs-5">$180<span class="text-muted fw-normal small">/treatment</span></span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> 60 - 90 min</span>
                    </div>
                    <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                        Hydrotherapy baths, organic herbal compresses, and deep tissue holistic treatments under pavilion gardens.
                    </p>
                    <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                        <span class="spec-tag">Couples Suites</span>
                        <span class="spec-tag">Aromatherapy</span>
                        <span class="spec-tag">Sauna</span>
                    </div>
                    <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                        Reserve Spa &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- Service 2: Sunset Dinner -->
        <div class="col" data-aos="fade-up" data-aos-delay="150">
            <div class="service-card">
                <div class="service-card-header bg-dinner">
                    <div>
                        <span class="service-badge-pill mb-1 d-inline-block">Fine Dining</span>
                        <h5 class="fw-bold mb-0 text-white">Sunset Dinner</h5>
                    </div>
                </div>
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <span class="fw-bold text-dark fs-5">$220<span class="text-muted fw-normal small">/couple</span></span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> 17:30 - 21:00</span>
                    </div>
                    <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                        Five-course culinary voyage on the ocean cliffside with vintage sommelier wine pairings and acoustic strings.
                    </p>
                    <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                        <span class="spec-tag">Private Cabana</span>
                        <span class="spec-tag">5-Course</span>
                        <span class="spec-tag">Live Cello</span>
                    </div>
                    <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                        Reserve Table &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- Service 3: Ancient Temple Tour -->
        <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
                <div class="service-card-header bg-temple">
                    <div>
                        <span class="service-badge-pill mb-1 d-inline-block">Cultural Excursion</span>
                        <h5 class="fw-bold mb-0 text-white">Ancient Temple Tour</h5>
                    </div>
                </div>
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <span class="fw-bold text-dark fs-5">$160<span class="text-muted fw-normal small">/person</span></span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> Half-Day (4.5h)</span>
                    </div>
                    <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                        Private historic expedition to sacred 12th-century forest ruins guided by certified archaeologists and monk blessing.
                    </p>
                    <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                        <span class="spec-tag">Chauffeured</span>
                        <span class="spec-tag">Historian Guide</span>
                        <span class="spec-tag">VIP Pass</span>
                    </div>
                    <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                        Book Excursion &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- Service 4: Food - Door to Door -->
        <div class="col" data-aos="fade-up" data-aos-delay="250">
            <div class="service-card">
                <div class="service-card-header bg-dining">
                    <div>
                        <span class="service-badge-pill mb-1 d-inline-block">In-Villa Experience</span>
                        <h5 class="fw-bold mb-0 text-white">Door-to-Door Dining</h5>
                    </div>
                </div>
                <div class="service-card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <span class="fw-bold text-dark fs-5">A La Carte<span class="text-muted fw-normal small"> + $15 tray</span></span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> 24/7 Available</span>
                    </div>
                    <p class="text-muted small mb-3" style="font-size: 0.78rem; line-height: 1.4;">
                        Gourmet silver-service meals plated directly to your room or poolside cabana with tailored wine delivery.
                    </p>
                    <div class="d-flex flex-wrap gap-1 mb-4 mt-auto">
                        <span class="spec-tag">Heated Tray</span>
                        <span class="spec-tag">24-Hour</span>
                        <span class="spec-tag">Private Butler</span>
                    </div>
                    <button class="btn btn-outline-dark btn-sm w-100 rounded" data-bs-toggle="modal" data-bs-target="#bookServiceModal">
                        Order to Room &rarr;
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- TODAY'S SCHEDULED SERVICE ORDERS LEDGER -->
    <div class="res-card overflow-hidden" data-aos="fade-up" data-aos-delay="300">
        <div class="p-3 bg-white border-bottom border-1 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold mb-0 text-dark">Today's Service Manifest</h6>
                <span class="text-muted small" style="font-size: 0.74rem;">Active itinerary and orders dispatch &middot; {{ date('D, j M Y') }}</span>
            </div>
            <button class="btn btn-outline-dark btn-sm rounded px-3" style="font-size: 0.75rem; border-color: #D3CABA;" onclick="window.print()">
                <i class="bi bi-printer me-1" style="color: var(--resort-gold);"></i> Print Manifest
            </button>
        </div>

        <div class="table-responsive">
            <table class="table service-table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Booking ID / Time</th>
                        <th>Guest &amp; Unit</th>
                        <th>Selected Service</th>
                        <th>Details &amp; Notes</th>
                        <th>Folio Charge</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Order 1: Spa -->
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">#SRV-4182</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Today, 14:00 PM</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">Tariq Al-Hassan</div>
                            <span class="text-muted" style="font-size: 0.72rem;">Villa 02 &middot; Platinum</span>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark"><i class="bi bi-flower1 text-success me-1"></i> Pavilion Spas</span>
                            <div class="text-muted" style="font-size: 0.7rem;">90-min Deep Tissue Herbal (2 Guests)</div>
                        </td>
                        <td><span class="text-muted small">Therapist: Mei L. &amp; Sarah K.</span></td>
                        <td><span class="fw-bold text-dark">$360.00</span></td>
                        <td>
                            <span class="status-pill status-pill-confirmed">
                                <i class="bi bi-check-circle-fill small"></i> Confirmed
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Track</button>
                        </td>
                    </tr>

                    <!-- Order 2: Dinner -->
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">#SRV-4183</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Today, 18:30 PM</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">Elena Rostova</div>
                            <span class="text-muted" style="font-size: 0.72rem;">Villa 07 &middot; Gold</span>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark"><i class="bi bi-moon-stars text-warning me-1"></i> Sunset Dinner</span>
                            <div class="text-muted" style="font-size: 0.7rem;">Cliffside Cabana 3 &middot; Sommelier Pairing</div>
                        </td>
                        <td><span class="text-muted small">Notes: Anniversary cake after main</span></td>
                        <td><span class="fw-bold text-dark">$220.00</span></td>
                        <td>
                            <span class="status-pill status-pill-inprep">
                                <i class="bi bi-hourglass-split small"></i> In Preparation
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Modify</button>
                        </td>
                    </tr>

                    <!-- Order 3: Temple Tour -->
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">#SRV-4177</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Today, 09:00 AM</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">Astrid Lindqvist</div>
                            <span class="text-muted" style="font-size: 0.72rem;">Room 303 &middot; Gold</span>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark"><i class="bi bi-bank text-primary me-1"></i> Ancient Temple Tour</span>
                            <div class="text-muted" style="font-size: 0.7rem;">Half-Day Private Chauffeur + Guide</div>
                        </td>
                        <td><span class="text-muted small">Guide: Somnang (Chauffeur returned)</span></td>
                        <td><span class="fw-bold text-dark">$320.00</span></td>
                        <td>
                            <span class="status-pill status-pill-completed">
                                <i class="bi bi-check2-all small"></i> Completed
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-secondary px-2 py-1 rounded" style="font-size: 0.75rem;">Folio Billed</button>
                        </td>
                    </tr>

                    <!-- Order 4: Door to Door Food -->
                    <tr>
                        <td>
                            <div class="fw-bold text-dark">#SRV-4194</div>
                            <div class="text-muted" style="font-size: 0.72rem;">Today, 12:45 PM</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">Priya Nair</div>
                            <span class="text-muted" style="font-size: 0.72rem;">Room 104 &middot; Silver</span>
                        </td>
                        <td>
                            <span class="fw-semibold text-dark"><i class="bi bi-bell-fill text-danger me-1"></i> Door-to-Door Dining</span>
                            <div class="text-muted" style="font-size: 0.7rem;">Artisanal Club Sandwich + Detox Juice</div>
                        </td>
                        <td><span class="text-muted small">Leave on patio table with hot cover</span></td>
                        <td><span class="fw-bold text-dark">$48.00</span></td>
                        <td>
                            <span class="status-pill status-pill-inprep">
                                <i class="bi bi-fire small"></i> Kitchen Plating
                            </span>
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-dark px-2 py-1 rounded" style="font-size: 0.75rem;">Track</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('modals')
<!-- ==================== EXPERIENCE BOOKING MODAL ==================== -->
<div class="modal fade" id="bookServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 8px;">
            <div class="modal-header" style="background-color: var(--resort-green); color: white;">
                <h5 class="modal-title font-script">Book Guest Service</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <!-- Select Experience -->
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Experience Selection</label>
                        <select class="form-select text-dark small" style="background-color: #FAFAF8;">
                            <option value="1">Pavilion Spas &amp; Thermal Wellness ($180)</option>
                            <option value="2">Cliffside Private Sunset Dinner ($220)</option>
                            <option value="3">Sacred Ancient Temple Tour ($160)</option>
                            <option value="4">Door-to-Door In-Room Dining (A La Carte)</option>
                        </select>
                    </div>

                    <!-- Guest & Room -->
                    <div class="row g-2 mb-3">
                        <div class="col-7">
                            <label class="form-label text-muted small fw-semibold">Assign to Guest</label>
                            <input type="text" class="form-control small" style="background-color: #FAFAF8;" placeholder="Guest Name" />
                        </div>
                        <div class="col-5">
                            <label class="form-label text-muted small fw-semibold">Unit</label>
                            <input type="text" class="form-control small" style="background-color: #FAFAF8;" placeholder="Villa / Room #" />
                        </div>
                    </div>

                    <!-- Date & Time Slot -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-semibold">Date</label>
                            <input type="date" class="form-control small" style="background-color: #FAFAF8;" value="{{ date('Y-m-d') }}" />
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-semibold">Time Slot</label>
                            <input type="time" class="form-control small" style="background-color: #FAFAF8;" value="{{ date('H:i') }}" />
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">Special Dietary / Concierge Notes</label>
                        <textarea class="form-control small" rows="2" style="background-color: #FAFAF8;" placeholder="Add dietary alerts, anniversary setup, private therapist preference..."></textarea>
                    </div>

                    <!-- Billing Toggle -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="chargeFolio" checked>
                        <label class="form-check-label small fw-semibold text-dark" for="chargeFolio">Charge directly to Room Folio</label>
                    </div>

                    <button type="button" class="btn btn-theme-primary w-100 py-2" data-bs-dismiss="modal">Confirm &amp; Dispatch Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection