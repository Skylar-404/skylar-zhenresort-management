<aside class="offcanvas-lg offcanvas-start sidebar text-white p-3" tabindex="-1" id="sidebarMenu">
    <div>
        <!-- Brand Logo Header with Glowing Crest -->
        <div class="d-flex align-items-center gap-2 logo-container mb-3 pb-2 border-bottom border-white border-opacity-10">
            <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold shadow-sm"
                style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--resort-gold), var(--resort-gold-hover)); color: #012828; font-family: 'Playfair Display', serif; font-size: 1.45rem; border: 1.5px solid rgba(255, 255, 255, 0.3);">
                真
            </div>
            <div>
                <h6 class="font-kaushan mb-0 text-white fs-4" style="letter-spacing: 0.5px; line-height: 1.1;">Zhen</h6>
                <span style="font-size: 0.6rem; letter-spacing: 2px; color: var(--resort-gold-light); display: block; text-transform: uppercase; font-weight: 500;">
                    Resort &amp; Spa &middot; PMS
                </span>
            </div>
            <button type="button" class="btn-close btn-close-white ms-auto d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>

        <!-- Navigation Links with Staggered Numbers & Gold Accents -->
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                    <span class="index-num">01</span><i class="bi bi-grid me-2"></i> Overview
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.reservations') }}" class="nav-link {{ request()->routeIs('admin.reservation*') ? 'active' : '' }}">
                    <span class="index-num">02</span><i class="bi bi-calendar3 me-2"></i> Reservations
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.rooms') }}" class="nav-link {{ request()->routeIs('admin.room*') || request()->routeIs('admin.property*') ? 'active' : '' }}">
                    <span class="index-num">03</span><i class="bi bi-building me-2"></i> Property
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.maintenance') }}" class="nav-link {{ request()->routeIs('admin.maintenance*') ? 'active' : '' }}">
                    <span class="index-num">04</span><i class="bi bi-wrench me-2"></i> Operations
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.folios') }}" class="nav-link {{ request()->routeIs('admin.folios*') ? 'active' : '' }}">
                    <span class="index-num">05</span><i class="bi bi-star me-2"></i> Finance
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.guests') }}" class="nav-link {{ request()->routeIs('admin.guests*') ? 'active' : '' }}">
                    <span class="index-num">06</span><i class="bi bi-people me-2"></i> Guests
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.invoices') }}" class="nav-link {{ request()->routeIs('admin.invoices*') ? 'active' : '' }}">
                    <span class="index-num">07</span><i class="bi bi-receipt me-2"></i> Payment
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.services') }}" class="nav-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <span class="index-num">08</span><i class="bi bi-compass me-2"></i> Services
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <span class="index-num">09</span><i class="bi bi-gear me-2"></i> Administration
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Bottom / User Footer & Client Portal Shortcut -->
    <div class="pt-3 border-top border-white border-opacity-10 px-1">
        <a href="{{ route('home') }}" target="_blank" class="d-flex align-items-center gap-2 text-decoration-none p-2 mb-2 rounded-2"
           style="background: rgba(229, 169, 60, 0.12); border: 1px solid rgba(229, 169, 60, 0.25); color: var(--resort-gold-light); font-size: 0.78rem;">
            <i class="bi bi-globe2" style="color: var(--resort-gold);"></i>
            <span class="text-truncate">Open Guest Website</span>
            <i class="bi bi-arrow-up-right ms-auto small"></i>
        </a>

        <div class="d-flex align-items-center justify-content-between gap-2 mt-2 pt-2 border-top border-white border-opacity-10">
            <div class="small text-truncate">
                <div class="fw-bold text-white text-truncate" style="font-size: 0.85rem;">{{ Auth::user()?->full_name ?? Auth::user()?->username ?? 'Administrator' }}</div>
                <div class="text-white-50" style="font-size: 0.72rem; letter-spacing: 0.5px;">Role: {{ Auth::user()?->role ?? 'Staff' }}</div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light py-1 px-2 border-opacity-50" style="font-size: 0.78rem; border-radius: 6px;" title="Sign out" onclick="return confirm('Sign out of PMS?');">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
