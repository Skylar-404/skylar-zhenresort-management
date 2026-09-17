<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Zhen Resort Management</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins, Kaushan Script, Playfair Display, DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Kaushan+Script&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        /* ==========================================================================
           1. ROOT VARIABLES & GLOBAL STYLING
           ========================================================================== */
        :root {
            --resort-green: #043e35;
            --resort-green-light: #065e50;
            --resort-green-dark: #012424;
            --resort-gold: #e5a93c;
            --resort-gold-hover: #cf932b;
            --resort-gold-light: #f7d58a;
            --resort-bg: #f8f6f0;
            --resort-cream: #fffdf7;
            --resort-border: rgba(4, 62, 53, 0.1);
            --resort-border-gold: rgba(229, 169, 60, 0.25);

            /* Legacy PMS mapping */
            --mv-primary: #043e35;
            --mv-sidebar-bg: #012828;
            --mv-bg: #f8f6f0;
            --mv-navbar-bg: rgba(255, 255, 255, 0.9);
            --mv-gold: #e5a93c;
            --mv-border: rgba(4, 62, 53, 0.1);
            --mv-topbar-border: rgba(229, 169, 60, 0.2);
            --mv-accent-red: #A31B2C;
            --mv-status-blue: #0A3251;
            --mv-status-green: #2B624A;
            --mv-status-gray: #707070;

            /* Status Pill Colors */
            --status-confirmed-bg: #E6EEF3;
            --status-confirmed-txt: #0A3251;
            --status-checkedin-bg: #E2F4EA;
            --status-checkedin-txt: #1C7C4C;
            --status-pending-bg: #FBF3D8;
            --status-pending-txt: #AD8322;
            --status-cancelled-bg: #FDE8E8;
            --status-cancelled-txt: #DC3545;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--resort-bg);
            font-family: 'Poppins', 'DM Sans', sans-serif;
            color: #2b2b2b;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* 11. Custom Luxury Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #011d1d;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--resort-gold), var(--resort-gold-hover));
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--resort-gold-light), var(--resort-gold));
        }

        /* ==========================================================================
           1. LOADING SCREEN
           ========================================================================== */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(145deg, #011d1d 0%, #013636 50%, #012424 100%);
            z-index: 99999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.55s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.55s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #page-loader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-brand {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(36px, 5vw, 54px);
            color: #ffffff;
            letter-spacing: 2px;
            margin-bottom: 20px;
            animation: brandPulse 2s ease-in-out infinite;
        }

        .loader-brand span {
            color: var(--resort-gold);
            text-shadow: 0 0 25px rgba(229, 169, 60, 0.5);
        }

        @keyframes brandPulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.96;
            }
            50% {
                transform: scale(1.04);
                opacity: 0.8;
            }
        }

        .gold-spinner-wrapper {
            position: relative;
            width: 54px;
            height: 54px;
            margin-bottom: 18px;
        }

        .gold-spinner {
            width: 100%;
            height: 100%;
            border: 3px solid rgba(229, 169, 60, 0.15);
            border-top: 3px solid var(--resort-gold);
            border-right: 3px solid var(--resort-gold-light);
            border-radius: 50%;
            animation: spinRing 1s linear infinite;
        }

        .gold-spinner-inner {
            position: absolute;
            top: 9px;
            left: 9px;
            right: 9px;
            bottom: 9px;
            border: 2px dashed rgba(229, 169, 60, 0.5);
            border-radius: 50%;
            animation: spinRingRev 2s linear infinite;
        }

        @keyframes spinRing {
            to { transform: rotate(360deg); }
        }

        @keyframes spinRingRev {
            to { transform: rotate(-360deg); }
        }

        .loader-tagline {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.7rem;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        .font-script {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--resort-green);
        }

        .font-kaushan {
            font-family: 'Kaushan Script', cursive;
        }

        /* ==========================================================================
           2. SIDEBAR (Glassmorphism & Sliding Gold Underline/Indicator)
           ========================================================================== */
        .sidebar {
            width: 255px;
            background: linear-gradient(180deg, #012020 0%, #013838 55%, #012424 100%) !important;
            border-right: 1px solid rgba(229, 169, 60, 0.18);
            min-height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: rgba(248, 245, 238, 0.72);
            border-radius: 8px;
            padding: 0.65rem 0.95rem;
            margin-bottom: 0.25rem;
            font-size: 0.88rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            position: relative;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            overflow: hidden;
        }

        .sidebar .nav-link .index-num {
            font-size: 0.72rem;
            width: 24px;
            opacity: 0.4;
            letter-spacing: 0.5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .sidebar .nav-link:hover .index-num {
            color: var(--resort-gold);
            opacity: 0.9;
        }

        .sidebar .nav-link.active {
            color: var(--resort-gold);
            background: linear-gradient(90deg, rgba(229, 169, 60, 0.18) 0%, rgba(229, 169, 60, 0.04) 100%);
            border-left: 3.5px solid var(--resort-gold);
            font-weight: 600;
            box-shadow: inset 0 0 15px rgba(229, 169, 60, 0.08);
        }

        .sidebar .nav-link.active .index-num {
            color: var(--resort-gold-light);
            opacity: 1;
        }

        /* ==========================================================================
           MAIN CONTENT WRAPPER & TOP NAVBAR
           ========================================================================== */
        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--resort-bg);
            transition: margin-left 0.2s ease;
        }

        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: 255px;
            }
        }

        /* 2. Top Navbar (Glassmorphism blur backdrop & gold border) */
        .top-navbar {
            background-color: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(229, 169, 60, 0.2);
            min-height: 68px;
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .search-input {
            background-color: #f7f5ed;
            border: 1.5px solid #dfd9ce;
            border-radius: 25px;
            padding: 0.48rem 1.1rem 0.48rem 2.5rem;
            font-size: 0.86rem;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .search-input:focus {
            background-color: #ffffff;
            border-color: var(--resort-gold);
            box-shadow: 0 0 0 4px rgba(229, 169, 60, 0.2);
            outline: none;
        }

        /* ==========================================================================
           7. CARD COMPONENTS (Elevated lift shadow & rounded borders)
           ========================================================================== */
        .stat-card, .res-card, .wo-card, .guest-card, .admin-card, .card {
            background: #ffffff;
            border: 1px solid var(--resort-border);
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .stat-card:hover, .res-card:hover, .wo-card:hover, .guest-card:hover, .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(4, 62, 53, 0.1);
            border-color: rgba(229, 169, 60, 0.35);
        }

        .stat-card {
            padding: 1.35rem 1.5rem;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        /* Top subtle gold line on stat cards */
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--resort-gold), var(--resort-gold-light));
            opacity: 0.85;
        }

        .stat-card .label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 600;
            color: #7d827a;
            transition: letter-spacing 0.3s ease;
        }

        .stat-card:hover .label {
            letter-spacing: 1.8px;
            color: var(--resort-gold);
        }

        .stat-card .value {
            font-size: 1.95rem;
            font-weight: 700;
            line-height: 1.15;
            color: var(--resort-green);
        }

        /* 9. Gradient text for highlight numbers */
        .gradient-text-gold {
            background: linear-gradient(135deg, #f7d58a 0%, #e5a93c 50%, #cf932b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ==========================================================================
           4. BUTTONS (Shimmer sweep, lift shadow, active feedback)
           ========================================================================== */
        .btn-theme-primary {
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: #ffffff;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.4px;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 14px rgba(4, 62, 53, 0.25);
            text-decoration: none;
        }

        .btn-theme-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.55s ease;
        }

        .btn-theme-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(4, 62, 53, 0.38);
            color: #ffffff;
        }

        .btn-theme-primary:hover::before {
            left: 100%;
        }

        .btn-theme-primary:active {
            transform: translateY(1px) scale(0.98);
        }

        .btn-resort-gold {
            background: linear-gradient(135deg, #cf932b 0%, #e5a93c 50%, #f7d58a 100%);
            color: #121212;
            font-weight: 600;
            font-size: 0.85rem;
            border: none;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 14px rgba(229, 169, 60, 0.3);
        }

        .btn-resort-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(229, 169, 60, 0.45);
            color: #000000;
        }

        .btn-outline-primary {
            border: 1.5px solid var(--resort-green);
            color: var(--resort-green);
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--resort-green);
            border-color: var(--resort-green);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(4, 62, 53, 0.2);
        }

        /* Filter buttons */
        .filter-btn-group .btn {
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.42rem 1rem;
            border: 1px solid #E0DAD0;
            background-color: #FFFFFF;
            color: #3b3d39;
            transition: all 0.25s ease;
        }

        .filter-btn-group .btn:hover {
            border-color: var(--resort-gold);
            color: var(--resort-green);
        }

        .filter-btn-group .btn.active {
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: #FFFFFF;
            border-color: var(--resort-green);
            box-shadow: 0 3px 10px rgba(4, 62, 53, 0.2);
        }

        /* Avatar circle with gold ring hover */
        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #f0ede5;
            color: var(--resort-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.82rem;
            flex-shrink: 0;
            border: 2px solid rgba(229, 169, 60, 0.3);
            transition: all 0.3s ease;
        }

        .avatar-circle:hover {
            transform: scale(1.1);
            border-color: var(--resort-gold);
            box-shadow: 0 0 12px rgba(229, 169, 60, 0.35);
        }

        /* Status pills */
        .status-pill {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            letter-spacing: 0.3px;
        }

        /* ==========================================================================
           8. MODALS (Backdrop blur, slide-up animation, gold focus rings)
           ========================================================================== */
        .modal-backdrop.show {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background-color: rgba(1, 24, 24, 0.65);
        }

        .modal-content {
            border: 1px solid rgba(229, 169, 60, 0.28);
            border-radius: 18px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideUp 0.38s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(35px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            border-bottom: 1px solid rgba(4, 62, 53, 0.08);
            background: linear-gradient(135deg, #fffdf7 0%, #f7f4ea 100%);
            padding: 1.15rem 1.5rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--resort-gold);
            box-shadow: 0 0 0 4px rgba(229, 169, 60, 0.2);
            outline: none;
        }

        /* Tables */
        .table {
            --bs-table-hover-bg: rgba(229, 169, 60, 0.05);
            font-size: 0.88rem;
        }

        .table thead th {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #7d827a;
            border-bottom: 1.5px solid rgba(4, 62, 53, 0.1);
            padding: 0.85rem 1rem;
        }

        .table tbody td {
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid rgba(4, 62, 53, 0.05);
        }

        /* 10. Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: var(--resort-gold);
            border: 1.5px solid rgba(229, 169, 60, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 999;
            text-decoration: none;
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, var(--resort-gold) 0%, var(--resort-gold-hover) 100%);
            color: #012828;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(229, 169, 60, 0.45);
        }

        /* Admin Footer status line */
        .admin-footer {
            border-top: 1px solid rgba(229, 169, 60, 0.2);
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            color: #8c887f;
            background-color: #ffffff;
            margin-top: auto;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- 1. Animated Gold Loading Screen -->
    <div id="page-loader">
        <div class="loader-brand">真 <span>ZHEN</span></div>
        <div class="gold-spinner-wrapper">
            <div class="gold-spinner"></div>
            <div class="gold-spinner-inner"></div>
        </div>
        <div class="loader-tagline">Resort Management System</div>
    </div>

    <!-- 2. SIDEBAR -->
    @include('admin.layout.sidebar')

    <!-- MAIN CONTENT WRAPPER -->
    <div class="main-wrapper">
        <!-- 2. TOP NAVIGATION (Glassmorphism) -->
        @include('admin.layout.navbar')

        <!-- FEEDBACK ALERTS -->
        @include('admin.layout.alerts')

        <!-- MAIN PAGE CONTENT -->
        <main class="px-3 px-lg-4 py-4 flex-grow-1">
            @yield('content')
        </main>

        <!-- 10. Admin Footer -->
        <footer class="admin-footer d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>Zhen Private Resort &amp; Spa</strong> &middot; Property Management System
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="text-decoration-none text-muted" style="font-size: 0.75rem;">
                    <i class="bi bi-box-arrow-up-right me-1" style="color: var(--resort-gold);"></i> Guest Portal
                </a>
                <span>&bull;</span>
                <span class="text-success"><i class="bi bi-circle-fill me-1" style="font-size: 0.55rem;"></i> System Live</span>
            </div>
        </footer>
    </div>

    <!-- Modals Yield -->
    @yield('modals')

    <!-- 10. Back to Top Button -->
    <a href="#" class="back-to-top" id="adminBackToTop" aria-label="Back to top">
        <i class="bi bi-chevron-up"></i>
    </a>

    <!-- Bootstrap 5.3 JS Bundle & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Dismiss loading screen smoothly
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) loader.classList.add('loaded');
            }, 450);
        });

        // 5. Initialize AOS (mobile safe)
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 40,
            disable: window.innerWidth < 768 ? 'phone' : false
        });

        // Back to top scroll listener
        const backBtn = document.getElementById('adminBackToTop');
        if (backBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    backBtn.classList.add('show');
                } else {
                    backBtn.classList.remove('show');
                }
            });
            backBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
