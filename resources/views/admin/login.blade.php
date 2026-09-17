<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zhen Resort — Staff Portal Sign In</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins, Kaushan Script, Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Kaushan+Script&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --resort-green: #043e35;
            --resort-green-light: #065e50;
            --resort-green-dark: #012424;
            --resort-gold: #e5a93c;
            --resort-gold-hover: #cf932b;
            --resort-gold-light: #f7d58a;
            --resort-bg: #f8f6f0;
            --resort-cream: #fffdf7;
            --resort-border: rgba(229, 169, 60, 0.22);
        }

        /* 11. Custom Luxury Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #011d1d;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--resort-gold), var(--resort-gold-hover));
            border-radius: 8px;
        }

        body {
            background: linear-gradient(155deg, #011717 0%, #012e2e 35%, #013e35 70%, #011d1d 100%);
            font-family: 'Poppins', 'DM Sans', sans-serif;
            color: #2b2b2b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glowing Background Orbs */
        body::before {
            content: '';
            position: absolute;
            top: 15%;
            left: 15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(229, 169, 60, 0.08) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: 15%;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(6, 94, 80, 0.15) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* 1. Loading Screen */
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
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #page-loader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-brand {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(36px, 5.5vw, 56px);
            color: #ffffff;
            letter-spacing: 2px;
            margin-bottom: 22px;
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
            width: 56px;
            height: 56px;
            margin-bottom: 20px;
        }

        .gold-spinner {
            width: 100%;
            height: 100%;
            border: 3px solid rgba(229, 169, 60, 0.15);
            border-top: 3px solid var(--resort-gold);
            border-right: 3px solid var(--resort-gold-light);
            border-radius: 50%;
            animation: spinRing 1.1s linear infinite;
        }

        .gold-spinner-inner {
            position: absolute;
            top: 9px;
            left: 9px;
            right: 9px;
            bottom: 9px;
            border: 2px dashed rgba(229, 169, 60, 0.5);
            border-radius: 50%;
            animation: spinRingRev 2.2s linear infinite;
        }

        @keyframes spinRing {
            to { transform: rotate(360deg); }
        }

        @keyframes spinRingRev {
            to { transform: rotate(-360deg); }
        }

        .loader-tagline {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.72rem;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        /* 7. Glassmorphism Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--resort-border);
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35), 0 0 35px rgba(229, 169, 60, 0.08);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .login-card:hover {
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.45), 0 0 45px rgba(229, 169, 60, 0.14);
            border-color: rgba(229, 169, 60, 0.45);
        }

        /* Card Top Gradient Accent Line */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--resort-gold), var(--resort-gold-light), var(--resort-gold));
        }

        /* Brand Crest Monogram */
        .brand-monogram {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg, var(--resort-gold) 0%, #cf932b 100%);
            color: #012828;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(229, 169, 60, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.4);
            animation: pulseGlow 3s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 6px 20px rgba(229, 169, 60, 0.35);
            }
            50% {
                box-shadow: 0 8px 30px rgba(229, 169, 60, 0.6), 0 0 15px rgba(229, 169, 60, 0.4);
            }
        }

        .brand-title {
            font-family: 'Kaushan Script', cursive;
            color: #ffffff;
            font-size: 2.2rem;
            line-height: 1.1;
            text-shadow: 0 3px 15px rgba(0, 0, 0, 0.3);
        }

        /* 8. Accessible Gold Focus Rings */
        .form-control-theme {
            background-color: #faf8f2;
            border: 1.5px solid #dcd6c8;
            font-size: 0.9rem;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #2b2b2b;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .form-control-theme:focus {
            background-color: #ffffff;
            border-color: var(--resort-gold);
            box-shadow: 0 0 0 4px rgba(229, 169, 60, 0.22);
            outline: none;
        }

        .form-control-theme::placeholder {
            color: #9c978b;
            font-size: 0.85rem;
        }

        /* 4. Interactive Buttons with Shimmer & Lift */
        .btn-theme-primary {
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: #ffffff;
            border: none;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            border-radius: 10px;
            padding: 0.8rem 1.4rem;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px rgba(4, 62, 53, 0.3);
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .btn-theme-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .btn-theme-primary:hover {
            background: linear-gradient(135deg, #022e27 0%, var(--resort-green-light) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(4, 62, 53, 0.45);
            color: #ffffff;
        }

        .btn-theme-primary:hover::before {
            left: 100%;
        }

        .btn-theme-primary:active {
            transform: translateY(1px) scale(0.98);
        }

        .form-check-input:checked {
            background-color: var(--resort-green);
            border-color: var(--resort-green);
        }

        .form-check-input:focus {
            border-color: var(--resort-gold);
            box-shadow: 0 0 0 3px rgba(229, 169, 60, 0.25);
        }

        .gradient-text-gold {
            background: linear-gradient(135deg, #f7d58a 0%, #e5a93c 50%, #cf932b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .client-web-link {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            font-size: 0.82rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .client-web-link:hover {
            color: var(--resort-gold);
            transform: translateX(-3px);
        }
    </style>
</head>

<body>

    <!-- 1. Animated Loading Screen -->
    <div id="page-loader">
        <div class="loader-brand">真 <span>ZHEN</span></div>
        <div class="gold-spinner-wrapper">
            <div class="gold-spinner"></div>
            <div class="gold-spinner-inner"></div>
        </div>
        <div class="loader-tagline">Staff Terminal &middot; PMS Portal</div>
    </div>

    <div class="container py-4 position-relative" style="z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <!-- Brand Header -->
                <div class="text-center mb-4" data-aos="fade-down" data-aos-duration="800">
                    <div class="brand-monogram fw-bold mb-3">
                        真
                    </div>
                    <h2 class="brand-title mb-1">Zhen Resort</h2>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <span class="text-uppercase" style="font-size: 0.68rem; letter-spacing: 2.4px; color: rgba(255, 255, 255, 0.7); font-weight: 500;">
                            PROPERTY MANAGEMENT SYSTEM &middot; TERMINAL
                        </span>
                    </div>
                </div>

                <!-- 7. Login Card with Lift Shadow and Border Accent -->
                <div class="login-card p-4 p-sm-5" data-aos="zoom-in" data-aos-duration="700" data-aos-delay="150">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-0 text-dark" style="color: var(--resort-green) !important;">Staff Sign In</h5>
                            <span class="text-muted small" style="font-size: 0.78rem;">Enter your verified PMS credentials</span>
                        </div>
                        <span class="badge px-2 py-1" style="background: rgba(4, 62, 53, 0.1); color: var(--resort-green); font-size: 0.7rem; border-radius: 6px;">
                            <i class="bi bi-shield-lock-fill me-1" style="color: var(--resort-gold);"></i> Secured
                        </span>
                    </div>

                    <hr class="opacity-10 mb-4 mt-2">

                    <!-- Flash Messages -->
                    @if(session('success'))
                    <div class="alert alert-success border-0 small py-2 px-3 mb-3 d-flex align-items-center justify-content-between" style="background-color: #E2F4EA; color: #1C7C4C; border-radius: 8px;" role="alert">
                        <div><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
                        <button type="button" class="btn-close py-0" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger border-0 small py-2 px-3 mb-3" style="background-color: #FDE8E8; color: #DC3545; border-radius: 8px;" role="alert">
                        <div class="d-flex justify-content-between align-items-start">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close py-0" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                    @endif

                    <!-- Sign In Form -->
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                Username or Email
                            </label>
                            <div class="position-relative">
                                <input type="text"
                                    name="login"
                                    class="form-control form-control-theme @error('login') is-invalid @enderror"
                                    value="{{ old('login') }}"
                                    placeholder="e.g. adela.v or staff@zhenresort.com"
                                    required
                                    autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label small fw-semibold text-muted mb-0" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                    Password
                                </label>
                                <a href="#" class="text-decoration-none small" style="color: var(--resort-gold); font-size: 0.75rem; font-weight: 600;">
                                    Forgot?
                                </a>
                            </div>
                            <input type="password"
                                name="password"
                                class="form-control form-control-theme"
                                placeholder="••••••••"
                                required>
                        </div>

                        <div class="mb-4 form-check d-flex align-items-center gap-2">
                            <input type="checkbox" name="remember" class="form-check-input mt-0" id="remember">
                            <label class="form-check-label text-muted" for="remember" style="font-size: 0.82rem;">
                                Keep me signed in on this station
                            </label>
                        </div>

                        <button type="submit" class="btn btn-theme-primary w-100 py-2">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In to Terminal
                        </button>
                    </form>

                </div>

                <!-- Footer Navigation Link to Client Website -->
                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="250">
                    <a href="{{ route('home') }}" class="client-web-link">
                        <i class="bi bi-arrow-left"></i> Return to Guest Website
                    </a>
                    <div class="mt-2 text-white-50" style="font-size: 0.72rem;">
                        &copy; {{ date('Y') }} Zhen Private Resort &middot; All Rights Reserved
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Floating Help Button -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <a href="{{ route('home') }}" class="btn btn-dark rounded-circle shadow d-flex align-items-center justify-content-center text-white"
            style="width: 42px; height: 42px; background: linear-gradient(135deg, var(--resort-green), #012424); border: 1.5px solid rgba(229, 169, 60, 0.4);"
            title="Guest Website">
            <i class="bi bi-house-door" style="color: var(--resort-gold);"></i>
        </a>
    </div>

    <!-- Bootstrap 5.3 JS Bundle & AOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Dismiss loading screen smoothly
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) loader.classList.add('loaded');
            }, 500);
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            disable: window.innerWidth < 768 ? 'phone' : false
        });
    </script>
</body>

</html>