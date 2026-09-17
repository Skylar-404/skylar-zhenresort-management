<nav class="navbar top-navbar px-3 px-lg-4">
    <div class="container-fluid p-0 d-flex align-items-center justify-content-between">

        <!-- Left: Mobile Sidebar Trigger & Global Search Bar -->
        <div class="d-flex align-items-center gap-2 flex-grow-1 me-3">
            <button class="btn btn-sm d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2" style="color: var(--resort-green);"></i>
            </button>

            <form action="{{ route('admin.search') }}" method="GET" class="search-form flex-grow-1" style="max-width: 460px;">
                <div class="search-container position-relative">
                    <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.88rem; color: var(--resort-gold) !important;"></i>
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           class="search-input form-control"
                           placeholder="Search guests, villas, reservations, folios..."
                           required />
                </div>
            </form>
        </div>

        <!-- Right: Dynamic Date & Alerts Indicator -->
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <div class="fw-bold small text-dark" style="font-size: 0.84rem; line-height: 1.2;">
                    {{ now()->format('l, j F Y') }}
                </div>
                <div style="font-size: 0.65rem; letter-spacing: 0.8px; color: var(--resort-green);" class="text-uppercase fw-semibold">
                    <i class="bi bi-circle-fill text-success me-1" style="font-size: 0.5rem;"></i> Zhen PMS Terminal Live
                </div>
            </div>

            <!-- Notifications / Alert Trigger -->
            <a href="{{ route('admin.reservations') }}" class="btn btn-link text-dark p-1 position-relative text-decoration-none" title="Notifications"
               style="width: 36px; height: 36px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; background: rgba(4, 62, 53, 0.05); transition: all 0.3s ease;">
                <i class="bi bi-bell fs-5" style="color: var(--resort-green);"></i>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </a>

            <!-- Quick Website Link -->
            <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary d-none d-md-inline-flex align-items-center gap-1" style="font-size: 0.78rem; padding: 0.35rem 0.8rem;">
                <i class="bi bi-globe"></i> Website
            </a>
        </div>

    </div>
</nav>
