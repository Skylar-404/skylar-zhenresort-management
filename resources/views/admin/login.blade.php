<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison Verde - Staff Portal Login</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts: DM Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">

    <style>
        :root {
            --mv-primary: #1B3527;
            /* Deep Forest Green */
            --mv-bg: #F8F5EE;
            /* Cream/Beige Background */
            --mv-gold: #C49A3A;
            /* Accent Gold */
            --mv-border: #E8E3D8;
            --mv-input-bg: #FCFAF7;
        }

        body {
            background-color: var(--mv-bg);
            font-family: 'DM Sans', sans-serif;
            color: #2b2b2b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1.5rem;
        }

        /* Elegant Serif Brand Font */
        .font-script {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--mv-primary);
        }

        /* Login Card */
        .login-card {
            background: #ffffff;
            border: 1px solid var(--mv-border);
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(27, 53, 39, 0.05);
        }

        /* Form Inputs */
        .form-control-theme {
            background-color: var(--mv-input-bg);
            border: 1px solid #DFD9CE;
            font-size: 0.88rem;
            border-radius: 6px;
            padding: 0.65rem 0.85rem;
            color: #2b2b2b;
            transition: all 0.2s ease;
        }

        .form-control-theme:focus {
            background-color: #ffffff;
            border-color: var(--mv-primary);
            box-shadow: 0 0 0 3px rgba(27, 53, 39, 0.1);
            outline: none;
        }

        .form-control-theme::placeholder {
            color: #A39E93;
            font-size: 0.85rem;
        }

        /* Primary Button */
        .btn-theme-primary {
            background-color: var(--mv-primary);
            color: #ffffff;
            border: none;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            border-radius: 6px;
            padding: 0.7rem 1.25rem;
            transition: all 0.2s ease;
        }

        .btn-theme-primary:hover {
            background-color: #13271c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(27, 53, 39, 0.15);
        }

        .btn-theme-primary:active {
            background-color: #0d1a13;
        }

        /* Checkbox Custom styling */
        .form-check-input:checked {
            background-color: var(--mv-primary);
            border-color: var(--mv-primary);
        }

        .form-check-input:focus {
            border-color: var(--mv-primary);
            box-shadow: 0 0 0 3px rgba(27, 53, 39, 0.1);
        }

        /* Top Monogram Logo Icon */
        .brand-monogram {
            width: 48px;
            height: 48px;
            background-color: var(--mv-gold);
            color: #1B3527;
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(196, 154, 58, 0.25);
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <!-- Brand Header -->
                <div class="text-center mb-4">
                    <div class="brand-monogram fw-bold mb-3">
                        M
                    </div>
                    <h2 class="font-script fw-bold mb-0 fs-3">Maison Verde</h2>
                    <div class="d-flex align-items-center justify-content-center gap-2 mt-1">
                        <span class="text-uppercase" style="font-size: 0.65rem; letter-spacing: 2px; color: #72756F; font-weight: 600;">
                            Resort &amp; Spa &middot; PMS Portal
                        </span>
                    </div>
                </div>

                <!-- Login Card -->
                <div class="login-card p-4 p-sm-5">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">Staff Sign In</h5>
                            <span class="text-muted small" style="font-size: 0.78rem;">Enter your internal credentials</span>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-2 py-1" style="font-size: 0.68rem;">
                            <i class="bi bi-shield-lock-fill me-1"></i> Secured
                        </span>
                    </div>

                    <hr class="border-secondary opacity-10 mb-4 mt-2">

                    <!-- Session Flash Messages -->
                    @if(session('success'))
                    <div class="alert alert-success border-0 small py-2 px-3 mb-3 d-flex align-items-center justify-content-between" style="background-color: #E2F4EA; color: #1C7C4C; border-radius: 6px;" role="alert">
                        <div><i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}</div>
                        <button type="button" class="btn-close py-0" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger border-0 small py-2 px-3 mb-3" style="background-color: #FDE8E8; color: #DC3545; border-radius: 6px;" role="alert">
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
                            <label class="form-label small fw-semibold text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                Username or Email
                            </label>
                            <div class="position-relative">
                                <input type="text"
                                    name="login"
                                    class="form-control form-control-theme @error('login') is-invalid @enderror"
                                    value="{{ old('login') }}"
                                    placeholder="e.g. adela.v or staff@maisonverde.com"
                                    required
                                    autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label small fw-semibold text-muted mb-0" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Password
                                </label>
                                <a href="#" class="text-decoration-none small" style="color: var(--mv-gold); font-size: 0.72rem; font-weight: 500;">
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
                            <label class="form-check-label text-muted" for="remember" style="font-size: 0.8rem;">
                                Keep me signed in on this station
                            </label>
                        </div>

                        <button type="submit" class="btn btn-theme-primary w-100 py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In to Terminal
                        </button>
                    </form>

                </div>

                <!-- Footer Copyright & Support Info -->
                <div class="text-center mt-4">
                    <small class="text-muted" style="font-size: 0.72rem;">
                        &copy; {{ date('Y') }} Maison Verde Resort &amp; Spa &middot; Property Management System
                    </small>
                </div>

            </div>
        </div>
    </div>

    <!-- Floating Help Button (Bottom Right) -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <button class="btn btn-dark rounded-circle shadow d-flex align-items-center justify-content-center"
            style="width: 36px; height: 36px; background-color: #212529;">
            <i class="bi bi-question fs-5"></i>
        </button>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>