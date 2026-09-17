<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zhen Resort — Luxury Private Sanctuary</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        /* ==========================================================================
           1. ROOT VARIABLES & GLOBAL STYLING
           ========================================================================== */
        :root {
            --resort-green: #043e35;
            --resort-green-light: #065e50;
            --resort-gold: #e5a93c;
            --resort-gold-hover: #cf932b;
            --resort-gold-light: #f7d58a;
            --resort-bg: #faf9f5;
            --resort-cream: #fffdf7;
            --nav-bg-start: #012828;
            --nav-bg-end: #014040;
            --footer-dark: #12110f;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 75px;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--resort-bg);
            color: #2b2b2b;
            overflow-x: hidden;
        }

        /* 11. Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 9px;
        }

        ::-webkit-scrollbar-track {
            background: #141311;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--resort-gold), var(--resort-gold-hover));
            border-radius: 8px;
            border: 2px solid #141311;
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
            transition: opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #page-loader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .loader-brand {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(38px, 6vw, 62px);
            color: #ffffff;
            letter-spacing: 2px;
            margin-bottom: 24px;
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

        /* Animated Gold Spinner */
        .gold-spinner-wrapper {
            position: relative;
            width: 60px;
            height: 60px;
            margin-bottom: 22px;
        }

        .gold-spinner {
            width: 100%;
            height: 100%;
            border: 3px solid rgba(229, 169, 60, 0.15);
            border-top: 3px solid var(--resort-gold);
            border-right: 3px solid var(--resort-gold-light);
            border-radius: 50%;
            animation: spinnerRotate 1.1s linear infinite;
        }

        .gold-spinner-inner {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 2px dashed rgba(229, 169, 60, 0.5);
            border-radius: 50%;
            animation: spinnerRotateReverse 2.2s linear infinite;
        }

        @keyframes spinnerRotate {
            to { transform: rotate(360deg); }
        }

        @keyframes spinnerRotateReverse {
            to { transform: rotate(-360deg); }
        }

        .loader-tagline {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.72rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* ==========================================================================
           2. NAVIGATION BAR (Glassmorphism & Sliding Gold Underline)
           ========================================================================== */
        nav.resort-navbar {
            background: linear-gradient(135deg, rgba(1, 40, 40, 0.88) 0%, rgba(1, 64, 64, 0.82) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(229, 169, 60, 0.2);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
        }

        nav.resort-navbar.scrolled {
            background: linear-gradient(135deg, rgba(1, 30, 30, 0.98) 0%, rgba(1, 52, 52, 0.95) 100%);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.4);
            padding-top: 0.45rem;
            padding-bottom: 0.45rem;
            border-bottom-color: rgba(229, 169, 60, 0.35);
        }

        .navbar-brand-text {
            font-family: 'Kaushan Script', cursive;
            font-size: 24px;
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar-brand-text:hover {
            color: var(--resort-gold);
        }

        .nav-text {
            font-family: "Poppins", sans-serif;
            color: rgba(255, 255, 255, 0.86);
            font-size: 0.92rem;
            letter-spacing: 0.6px;
            transition: all 0.3s ease;
        }

        /* Sliding gold underline */
        .resort-navbar .nav-link {
            position: relative;
            padding: 0.55rem 1.15rem;
            transition: color 0.3s ease;
        }

        .resort-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--resort-gold), var(--resort-gold-light));
            border-radius: 2px;
            transform: translateX(-50%);
            transition: width 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .resort-navbar .nav-link:hover .nav-text,
        .resort-navbar .nav-link.active .nav-text {
            color: var(--resort-gold);
            text-shadow: 0 0 15px rgba(229, 169, 60, 0.4);
        }

        .resort-navbar .nav-link:hover::after,
        .resort-navbar .nav-link.active::after {
            width: 70%;
        }

        /* ==========================================================================
           3. COLOR GRADIENTS & HERO SECTION
           ========================================================================== */
        #home-id-1 {
            background: linear-gradient(165deg, #011a1a 0%, #013535 30%, #014242 60%, #012b2b 85%, #001616 100%);
            color: white;
            padding-top: 130px !important;
            padding-bottom: 90px !important;
            min-height: 85vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        #home-id-1::before {
            content: '';
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 750px;
            height: 750px;
            background: radial-gradient(circle, rgba(229, 169, 60, 0.08) 0%, rgba(4, 62, 53, 0.04) 50%, transparent 75%);
            pointer-events: none;
        }

        #home-id-1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top, var(--resort-bg), transparent);
            pointer-events: none;
        }

        /* 9. Typography Animations & Header Styling */
        .section-tag {
            font-size: 11px;
            letter-spacing: 3px;
            font-weight: 600;
            color: var(--resort-gold);
            text-transform: uppercase;
            display: inline-block;
            transition: letter-spacing 0.35s ease, color 0.35s ease;
        }

        .section-tag:hover {
            letter-spacing: 4.5px;
            color: var(--resort-gold-hover);
        }

        #zhen-quote {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(34px, 5.8vw, 62px);
            line-height: 1.22;
            margin: 1.4rem 0;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.4), 0 0 25px rgba(229, 169, 60, 0.2);
        }

        .hero-subtitle {
            font-size: 12px;
            letter-spacing: 2.5px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
        }

        /* Gradient text utility */
        .gradient-text-gold {
            background: linear-gradient(135deg, #f7d58a 0%, #e5a93c 50%, #cf932b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ==========================================================================
           4. BUTTONS (Glow pulse, shimmer sweep, lift shadow, press feedback)
           ========================================================================== */
        /* Primary Gold Buttons */
        .btn-resort-gold {
            background: linear-gradient(135deg, #cf932b 0%, #e5a93c 50%, #f7d58a 100%);
            color: #121212;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 0.85rem 2.2rem;
            border: none;
            border-radius: 50px;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 5px 20px rgba(229, 169, 60, 0.35);
            text-decoration: none;
            cursor: pointer;
        }

        .btn-resort-gold::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.65s ease;
        }

        .btn-resort-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(229, 169, 60, 0.55);
            color: #000000;
        }

        .btn-resort-gold:hover::before {
            left: 120%;
        }

        .btn-resort-gold:active {
            transform: translateY(1px) scale(0.98);
            box-shadow: 0 3px 10px rgba(229, 169, 60, 0.3);
        }

        /* Hero Button Pulse Glow */
        .btn-hero {
            animation: pulseGlow 2.8s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 5px 22px rgba(229, 169, 60, 0.35);
            }
            50% {
                box-shadow: 0 5px 38px rgba(229, 169, 60, 0.65), 0 0 20px rgba(229, 169, 60, 0.35);
            }
        }

        /* Reserve Button (Emerald green gradient with shimmer) */
        .btn-reserve {
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.8px;
            padding: 0.65rem 1.5rem;
            border: none;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(4, 62, 53, 0.2);
        }

        .btn-reserve::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.5s ease;
        }

        .btn-reserve:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(4, 62, 53, 0.35);
            color: #ffffff;
        }

        .btn-reserve:hover::before {
            left: 100%;
        }

        .btn-reserve:active {
            transform: translateY(1px) scale(0.98);
        }

        /* ==========================================================================
           SECTION 1: OUR PROMISE
           ========================================================================== */
        #our-promise {
            background-color: var(--resort-bg);
        }

        #zhen-promise {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(22px, 3.6vw, 30px);
            line-height: 1.65;
            color: #262626;
        }

        .gold-divider {
            width: 90px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--resort-gold), transparent);
            border: none;
            margin: 0 auto;
        }

        /* ==========================================================================
           7. CARD COMPONENTS & 6. IMAGE HOVER STATES (ACCOMMODATIONS)
           ========================================================================== */
        #zhen-accommodation {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(26px, 4vw, 34px);
        }

        .accommodation-card {
            background: #ffffff;
            border: 1px solid rgba(4, 62, 53, 0.08);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.05);
            transition: all 0.45s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .accommodation-card:hover {
            transform: translateY(-9px);
            box-shadow: 0 24px 48px rgba(4, 62, 53, 0.16);
            border-color: rgba(229, 169, 60, 0.35);
        }

        .accommodation-badge {
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: #ffffff;
            font-size: 0.76rem;
            letter-spacing: 1.5px;
            padding: 8px 16px;
            border-bottom-left-radius: 10px;
            position: absolute;
            top: 0;
            right: 0;
            z-index: 3;
            font-weight: 500;
        }

        /* 6. Image Hover: Scale up, brightness, golden tint overlay */
        .img-hover-container {
            position: relative;
            overflow: hidden;
            border-radius: 14px 14px 0 0;
        }

        .img-hover-container img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            display: block;
            transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1), filter 0.7s ease;
        }

        .img-hover-container::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(4, 62, 53, 0.4) 0%, rgba(229, 169, 60, 0.22) 60%, transparent 100%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            z-index: 2;
        }

        .accommodation-card:hover .img-hover-container img {
            transform: scale(1.08);
            filter: brightness(1.08) contrast(1.03);
        }

        .accommodation-card:hover .img-hover-container::after {
            opacity: 1;
        }

        .accommodation-list-item {
            font-size: 12.5px;
            color: #4a4a4a;
        }

        .price-currency {
            font-size: 11px;
            color: #888888;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .price-amount {
            font-size: 30px;
            font-weight: 700;
            color: var(--resort-green);
        }

        .feature-badge {
            background-color: rgba(4, 62, 53, 0.1);
            color: var(--resort-green);
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 50%;
        }

        /* ==========================================================================
           SECTION 3: EXPERIENCES (Interactive Zoom & Golden Overlay)
           ========================================================================== */
        #zhen-experience {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(26px, 4vw, 34px);
        }

        .experience-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            color: #ffffff;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .experience-card.small { height: 340px; }
        .experience-card.large { height: 460px; }

        .experience-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.8s cubic-bezier(0.25, 0.8, 0.25, 1), filter 0.8s ease;
        }

        /* Base dark overlay */
        .experience-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 9, 7, 0.8) 0%, rgba(10, 9, 7, 0.3) 50%, rgba(10, 9, 7, 0.05) 80%);
            z-index: 1;
            transition: opacity 0.5s ease;
        }

        /* 6. Golden tint overlay on hover */
        .experience-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(4, 62, 53, 0.7) 0%, rgba(229, 169, 60, 0.25) 50%, transparent 85%);
            z-index: 1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .experience-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.25);
        }

        .experience-card:hover img {
            transform: scale(1.08);
            filter: brightness(1.08);
        }

        .experience-card:hover::after {
            opacity: 1;
        }

        .experience-content {
            position: absolute;
            left: 36px;
            right: 36px;
            bottom: 34px;
            z-index: 2;
        }

        .experience-category {
            display: block;
            margin-bottom: 10px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 4px;
            color: var(--resort-gold-light);
            text-transform: uppercase;
        }

        .experience-title {
            margin: 0 0 10px;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.15;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .experience-description {
            max-width: 440px;
            margin: 0 0 20px;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.8);
        }

        .experience-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            color: #ffffff;
            text-decoration: none;
            transition: gap 0.35s ease, color 0.35s ease;
        }

        .experience-link:hover {
            color: var(--resort-gold);
            gap: 16px;
        }

        .experience-link i {
            font-size: 14px;
            letter-spacing: 0;
            transition: transform 0.3s ease;
        }

        .experience-link:hover i {
            transform: translateX(4px);
        }

        .experience-column .experience-card + .experience-card {
            margin-top: 20px;
        }

        /* ==========================================================================
           SECTION 4: WELLNESS / AMENITIES (Rich Gradient & Glass Cards)
           ========================================================================== */
        #section-id-4 {
            background: linear-gradient(145deg, #012222 0%, #013b3b 40%, #014545 70%, #012828 100%);
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        #section-id-4::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(229, 169, 60, 0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        #zhen-amenity {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(26px, 4vw, 36px);
        }

        .amenity-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 20px 12px;
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .amenity-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(229, 169, 60, 0.4);
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.28), 0 0 16px rgba(229, 169, 60, 0.15);
        }

        .amenity-card img {
            transition: transform 0.35s ease;
        }

        .amenity-card:hover img {
            transform: scale(1.18);
        }

        .stat-number {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(34px, 4.5vw, 48px);
            line-height: 1;
        }

        /* ==========================================================================
           SECTION 5: GALLERY
           ========================================================================== */
        #zhen-gallery {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(26px, 4vw, 34px);
        }

        .gallery-box {
            overflow: hidden;
            border-radius: 14px;
            position: relative;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .gallery-photo {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 14px;
            transition: transform 0.7s cubic-bezier(0.25, 0.8, 0.25, 1), filter 0.7s ease;
            display: block;
        }

        .gallery-box::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(4, 62, 53, 0.45) 0%, rgba(229, 169, 60, 0.2) 60%, transparent 100%);
            opacity: 0;
            transition: opacity 0.45s ease;
            border-radius: 14px;
            pointer-events: none;
        }

        .gallery-box:hover .gallery-photo {
            transform: scale(1.08);
            filter: brightness(1.08);
        }

        .gallery-box:hover::after {
            opacity: 1;
        }

        /* ==========================================================================
           SECTION 6: LEADERSHIP / TESTIMONIALS
           ========================================================================== */
        .zhen-ceo-word {
            font-family: "Kaushan Script", cursive;
            font-size: clamp(18px, 2.8vw, 24px);
            line-height: 1.7;
            color: #333333;
            max-width: 820px;
            margin: 0 auto;
        }

        .leader-portrait {
            width: 104px;
            height: 104px;
            object-fit: cover;
            border: 3px solid rgba(229, 169, 60, 0.2);
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .carousel-item:hover .leader-portrait,
        .carousel-item.active .leader-portrait {
            border-color: var(--resort-gold);
            box-shadow: 0 0 25px rgba(229, 169, 60, 0.4);
            transform: scale(1.04);
        }

        /* ==========================================================================
           8. MODALS (Backdrop Blur, Slide-Up Entrance, Accessible Gold Focus Rings)
           ========================================================================== */
        .modal-backdrop.show {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background-color: rgba(1, 24, 24, 0.65);
        }

        .modal-content.resort-modal {
            background-color: var(--resort-bg);
            border: 1px solid rgba(229, 169, 60, 0.3);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 0 0 30px rgba(229, 169, 60, 0.12);
            animation: modalSlideUp 0.45s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .resort-title {
            font-family: "Kaushan Script", cursive;
            font-weight: 600;
            color: var(--resort-green);
            letter-spacing: 0.5px;
        }

        .resort-subtitle {
            font-size: 0.78rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--resort-gold);
            font-weight: 600;
        }

        /* Accessible Gold Focus Rings */
        .resort-input {
            background-color: #ffffff;
            border: 1.5px solid #dcdad1;
            border-radius: 10px;
            font-size: 0.92rem;
            padding: 0.8rem 1.1rem;
            transition: all 0.3s ease;
        }

        .resort-input:focus {
            border-color: var(--resort-gold);
            box-shadow: 0 0 0 4px rgba(229, 169, 60, 0.25);
            outline: none;
        }

        .divider-text {
            display: flex;
            align-items: center;
            text-align: center;
            color: #8c8c8c;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 1.5rem 0;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd8cc;
        }

        .divider-text:not(:empty)::before {
            margin-right: 1em;
        }

        .divider-text:not(:empty)::after {
            margin-left: 1em;
        }

        .btn-social {
            border: 1.5px solid #e0ddd4;
            background-color: #ffffff;
            color: #333333;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.7rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
        }

        .btn-social:hover {
            background-color: #f7f5ed;
            border-color: var(--resort-gold);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            color: #000000;
        }

        .btn-social:focus {
            box-shadow: 0 0 0 4px rgba(229, 169, 60, 0.25);
            outline: none;
        }

        .resort-link {
            color: var(--resort-green);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .resort-link:hover {
            color: var(--resort-gold);
            text-decoration: underline;
        }

        /* ==========================================================================
           10. FOOTER (Hover slide effects, gradient divider, back-to-top button)
           ========================================================================== */
        footer {
            background: linear-gradient(180deg, #12110f 0%, #1a1815 60%, #100f0e 100%);
            position: relative;
            color: #89837a;
        }

        .footer-top-gradient {
            height: 2px;
            background: linear-gradient(90deg, transparent 5%, var(--resort-gold) 50%, transparent 95%);
        }

        .footer-brand h2 {
            font-size: 32px;
            font-weight: 600;
            letter-spacing: 8px;
            color: #e6e1d8;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            display: block;
            font-size: 9.5px;
            letter-spacing: 4px;
            color: var(--resort-gold-light);
            margin-bottom: 24px;
        }

        .footer-brand p {
            max-width: 300px;
            font-size: 13.5px;
            line-height: 2.1;
            margin: 0;
            color: #89837a;
        }

        .footer-title {
            color: var(--resort-gold);
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 4px;
            margin-bottom: 24px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        /* Hover slide effects on links */
        .footer-links a {
            color: #89837a;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--resort-gold);
            transform: translateX(8px);
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
            font-size: 14px;
            color: #89837a;
        }

        .contact-list i {
            font-size: 16px;
            color: var(--resort-gold);
            min-width: 18px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .contact-list li:hover i {
            transform: scale(1.25);
            color: var(--resort-gold-light);
        }

        .footer-divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.05), rgba(229, 169, 60, 0.25), rgba(255, 255, 255, 0.05));
            margin: 50px 0 35px;
        }

        .footer-bottom {
            font-size: 12.5px;
        }

        .copyright {
            margin: 0;
            color: #69645d;
        }

        .legal-links {
            display: flex;
            justify-content: flex-end;
            gap: 28px;
        }

        .legal-links a {
            color: #69645d;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .legal-links a:hover {
            color: var(--resort-gold);
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--resort-green) 0%, #065e50 100%);
            color: var(--resort-gold);
            border: 1.5px solid rgba(229, 169, 60, 0.4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
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
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(229, 169, 60, 0.45);
        }

        /* ==========================================================================
           11. RESPONSIVE POLISH & BREAKPOINTS
           ========================================================================== */
        @media (max-width: 991.98px) {
            .experience-card.small,
            .experience-card.large {
                height: 380px;
            }

            .experience-content {
                left: 28px;
                right: 28px;
                bottom: 28px;
            }

            .legal-links {
                justify-content: center;
                margin-top: 1rem;
            }
        }

        @media (max-width: 767.98px) {
            .experience-card.small,
            .experience-card.large {
                height: 360px;
            }

            .experience-column + .experience-column {
                margin-top: 20px;
            }

            .gallery-photo {
                height: 210px;
            }

            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 42px;
                height: 42px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- ==========================================================================
         1. LOADING SCREEN
         ========================================================================== -->
    <div id="page-loader">
        <div class="loader-brand">真 <span>ZHEN</span></div>
        <div class="gold-spinner-wrapper">
            <div class="gold-spinner"></div>
            <div class="gold-spinner-inner"></div>
        </div>
        <div class="loader-tagline">Private Sanctuary Resort</div>
    </div>

    <!-- ==========================================================================
         2. NAVIGATION BAR
         ========================================================================== -->
    <nav class="navbar navbar-expand-lg fixed-top resort-navbar" id="mainNavbar">
        <div class="container px-3">
            <a class="navbar-brand-text d-lg-none" href="#home">
                Zhen Resort
            </a>
            <button class="navbar-toggler text-white border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                <ul class="navbar-nav align-items-center w-100 justify-content-around py-2 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#wellness"><span class="nav-text">Wellness</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#experiences"><span class="nav-text">Experiences</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#home"><span class="nav-text fw-semibold">Zhen Resort</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#accommodations"><span class="nav-text">Accommodations</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery"><span class="nav-text">Gallery</span></a>
                    </li>
                </ul>
                <div class="d-lg-none text-center mt-3 mb-2">
                    <button type="button" class="btn btn-resort-gold btn-sm w-75" data-bs-toggle="modal" data-bs-target="#resortLoginModal" style="font-size: 0.78rem; padding: 10px 20px;">
                        <i class="bi bi-person me-1"></i> Client Sign In
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- ==========================================================================
         3. HERO SECTION
         ========================================================================== -->
    <section class="hero" id="home">
        <div class="container-fluid" id="home-id-1">
            <div class="container text-center py-4 position-relative" style="z-index: 2;">
                <p class="hero-subtitle mb-2" data-aos="fade-down" data-aos-duration="800">
                    LIVING IN PEACE | SIEMREAP CITY | ZHEN PARADISE RESORT
                </p>

                <h2 class="text-center text-white" id="zhen-quote" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    Where the World Falls Away
                </h2>

                <p class="hero-subtitle mb-5" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    ZHEN RESORT BY NEAK OKNHA BUNLEAP
                </p>

                <!-- 4. Interactive Hero Button (Glow pulse & Shimmer) -->
                <div class="d-flex justify-content-center" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="450">
                    <button type="button" class="btn btn-resort-gold btn-hero" data-bs-toggle="modal" data-bs-target="#resortLoginModal">
                        FIND YOUR STAY <i class="bi bi-chevron-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 1: OUR PROMISE
         ========================================================================== -->
    <section class="hero py-5" id="our-promise">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center" data-aos="fade-up" data-aos-duration="900">
                    <span class="section-tag mb-3">01 — OUR PROMISE</span>

                    <h3 class="text-center my-4" id="zhen-promise">
                        Zhen was conceived for those who seek not spectacle, but silence — the rare luxury of having nothing to do and every resource to do it beautifully.
                    </h3>

                    <div class="d-flex justify-content-center mb-4">
                        <div class="gold-divider"></div>
                    </div>

                    <p class="text-muted" data-aos="fade-up" data-aos-delay="200" style="font-size: 13.5px; line-height: 1.85;">
                        Twelve private villas and bungalows across a 3-hectares land in the suburb of the city. No crowds. No noise. Just the forest, the reef, and time made yours.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: ACCOMMODATIONS
         ========================================================================== -->
    <section class="hero" id="accommodations" style="background-color: var(--resort-cream);">
        <div class="container pt-5 pb-3">
            <span class="section-tag" data-aos="fade-right">02 — ACCOMMODATIONS</span>
            <h3 class="mt-2 mb-2" id="zhen-accommodation" data-aos="fade-right" data-aos-delay="100">
                Your Private Sanctuary
            </h3>
            <p class="text-muted" data-aos="fade-right" data-aos-delay="200" style="font-size: 13px;">
                Every accommodation at Zhen is designed to dissolve the boundary between interior and the silence nature.
            </p>
        </div>

        <div class="container pb-5">
            <div class="row g-4 mt-1">

                <!-- Card 1: Tropical Garden Suite -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card accommodation-card h-100 position-relative">
                        <span class="accommodation-badge">Signature</span>
                        <div class="img-hover-container">
                            <img src="{{ asset('images/premium.png') }}" alt="Tropical Garden Suite" />
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="color: var(--resort-green);">Tropical Garden Suite</h5>
                                <p class="text-muted mb-3" style="font-size: 12px; letter-spacing: 0.5px;">180 m² | 2 guests</p>
                                <p class="card-text text-secondary mb-4" style="font-size: 12.5px; line-height: 1.75;">
                                    Nestled within fragrant tropical gardens, this suite offers an immersive connection to nature — outdoor rain shower, private plunge pool, and a terrace alive with birdsong.
                                </p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Private infinity pool</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Outdoor rain shower</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Garden terrace</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Hammock lounge</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <hr class="opacity-25 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-currency">FROM</span><br>
                                        <span class="price-amount">$985</span><span class="text-muted" style="font-size: 12px;">/night</span>
                                    </div>
                                    <a href="#" class="btn btn-reserve">Reserve <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Ocean Pool Villa -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card accommodation-card h-100 position-relative">
                        <span class="accommodation-badge" style="background: linear-gradient(135deg, #a67c1e 0%, var(--resort-gold) 100%);">Most Sought After</span>
                        <div class="img-hover-container">
                            <img src="{{ asset('images/privatepool.png') }}" alt="Ocean Pool Villa" />
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="color: var(--resort-green);">Ocean Pool Villa</h5>
                                <p class="text-muted mb-3" style="font-size: 12px; letter-spacing: 0.5px;">280 m² | 2 guests</p>
                                <p class="card-text text-secondary mb-4" style="font-size: 12.5px; line-height: 1.75;">
                                    A private sanctuary perched at the water's edge, where your infinity pool dissolves seamlessly into the Indian Ocean. Butler service and a dedicated sun deck complete this retreat.
                                </p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Private infinity pool</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Overwater sun deck</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">24-hr butler</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Ocean Panorama</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <hr class="opacity-25 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-currency">FROM</span><br>
                                        <span class="price-amount">$1,850</span><span class="text-muted" style="font-size: 12px;">/night</span>
                                    </div>
                                    <a href="#" class="btn btn-reserve">Reserve <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Ultimate Suite Villa -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card accommodation-card h-100 position-relative">
                        <span class="accommodation-badge">Signature</span>
                        <div class="img-hover-container">
                            <img src="{{ asset('images/suite.png') }}" alt="Ultimate Suite Villa" />
                        </div>
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1" style="color: var(--resort-green);">Ultimate Suite Villa</h5>
                                <p class="text-muted mb-3" style="font-size: 12px; letter-spacing: 0.5px;">360 m² | 2 guests</p>
                                <p class="card-text text-secondary mb-4" style="font-size: 12.5px; line-height: 1.75;">
                                    Indulge in ultimate luxury in our premier suite, featuring floor-to-ceiling sunset views, exquisite modern design, and spacious living crafted for an unforgettable sanctuary.
                                </p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">24/7 Personal Butler Service</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Panoramic Floor-to-Ceiling Views</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">In-Suite Private Dining</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="accommodation-list-item">Full Spa & Resort Access</span>
                                        <span class="feature-badge"><i class="bi bi-check-lg"></i></span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <hr class="opacity-25 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="price-currency">FROM</span><br>
                                        <span class="price-amount">$2,250</span><span class="text-muted" style="font-size: 12px;">/night</span>
                                    </div>
                                    <a href="#" class="btn btn-reserve">Reserve <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: EXPERIENCES
         ========================================================================== -->
    <section class="hero py-5" id="experiences">
        <div class="container pt-4 pb-3">
            <span class="section-tag" data-aos="fade-right">03 — EXPERIENCES</span>
            <h3 class="mt-2 mb-4" id="zhen-experience" data-aos="fade-right" data-aos-delay="100">
                Curated for the Discerning
            </h3>

            <div class="row g-4 mt-1">
                <!-- Column Left -->
                <div class="col-lg-6 experience-column">
                    <!-- Card 1: Sunset Dining -->
                    <div class="experience-card small" data-aos="zoom-in" data-aos-delay="100">
                        <img src="{{ asset('images/dinner.png') }}" alt="Sunset Dining">
                        <div class="experience-content">
                            <span class="experience-category">CULINARY</span>
                            <h2 class="experience-title">Sunset Dining</h2>
                            <p class="experience-description">
                                A table set for two on a deserted sandbank as the sun descends behind the horizon. Our chefs prepare a bespoke menu from the day's freshest catch.
                            </p>
                            <a href="#" class="experience-link">ENQUIRE <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Card 3: Khmer Cuisine -->
                    <div class="experience-card large" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{ asset('images/cuisin.png') }}" alt="Khmer Cuisine">
                        <div class="experience-content">
                            <span class="experience-category">CUISINE</span>
                            <h2 class="experience-title">Our Local Khmer Food</h2>
                            <p class="experience-description">
                                We promise to deliver the most delicious Khmer-made food and dessert from our 4-stars Chefs.
                            </p>
                            <a href="#" class="experience-link">ENQUIRE <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Column Right -->
                <div class="col-lg-6 experience-column">
                    <!-- Card 2: Spa Journey -->
                    <div class="experience-card large" data-aos="zoom-in" data-aos-delay="150">
                        <img src="{{ asset('images/spa.png') }}" alt="Spa Journey">
                        <div class="experience-content">
                            <span class="experience-category">WELLNESS</span>
                            <h2 class="experience-title">Signature Spa Journey</h2>
                            <p class="experience-description">
                                A four-hour immersion drawing from ancient Ayurvedic traditions and island botanicals. Begin with a warm coconut oil ritual and conclude with a crystalline plunge.
                            </p>
                            <a href="#" class="experience-link">ENQUIRE <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <!-- Card 4: Heritage Journey -->
                    <div class="experience-card large" data-aos="zoom-in" data-aos-delay="250">
                        <img src="{{ asset('images/angkorwat.png') }}" alt="Heritage Journey">
                        <div class="experience-content">
                            <span class="experience-category">CULTURE</span>
                            <h2 class="experience-title">Region Heritage Journey</h2>
                            <p class="experience-description">
                                Experience the history, traditions, and majestic stories of the legendary Angkor region.
                            </p>
                            <a href="#" class="experience-link">ENQUIRE <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 4: RESORT AMENITIES / WELLNESS
         ========================================================================== -->
    <section class="hero" id="wellness">
        <div class="container-fluid" id="section-id-4">
            <div class="container pt-5 pb-5">
                <div class="row gy-4 align-items-center mb-5">
                    <div class="col-lg-5" data-aos="fade-right">
                        <span class="section-tag mb-2" style="color: var(--resort-gold-light);">04 — RESORT AMENITIES</span>
                        <h3 class="mb-3 text-white" id="zhen-amenity">Every Detail, Considered</h3>
                        <p class="text-white-50 mb-0" style="font-size: 13.5px; line-height: 1.85;">
                            From the moment you arrive by your private ride until your final morning, every facility exists to serve the experience of unhurried luxury.
                        </p>
                        <hr class="border-secondary d-lg-none my-4">
                    </div>

                    <!-- 5. Flip-up amenity icons with staggered delay timings -->
                    <div class="col-lg-7">
                        <div class="row row-cols-2 row-cols-sm-4 g-3 text-center">
                            <div class="col" data-aos="flip-up" data-aos-delay="50">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/water-svgrepo.png') }}" width="36" height="36" alt="Infinity Pool" />
                                    <span class="small fw-medium">Infinity Pool</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="100">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/leaves-svgrepo.png') }}" width="36" height="36" alt="Organic Spa" />
                                    <span class="small fw-medium">Organic Spa</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="150">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/dinner-svgrepo.png') }}" width="36" height="36" alt="Fine Dining" />
                                    <span class="small fw-medium">Fine Dining</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="200">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/sun-svgrepo.png') }}" width="36" height="36" alt="Beach Club" />
                                    <span class="small fw-medium">Beach Club</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="250">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/wifi-svgrepo.png') }}" width="36" height="36" alt="High-Speed Wifi" />
                                    <span class="small fw-medium">High-Speed Wifi</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="300">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/coffee-svgrepo.png') }}" width="36" height="36" alt="In-Villa Dining" />
                                    <span class="small fw-medium">In-Villa Dining</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="350">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/shield-svgrepo.png') }}" width="36" height="36" alt="Concierge 24/7" />
                                    <span class="small fw-medium">Concierge 24/7</span>
                                </div>
                            </div>
                            <div class="col" data-aos="flip-up" data-aos-delay="400">
                                <div class="amenity-card d-flex flex-column align-items-center gap-2">
                                    <img src="{{ asset('images/location-svgrepo.png') }}" width="36" height="36" alt="Island Excursions" />
                                    <span class="small fw-medium">Island Excursions</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gradient stats numbers -->
                <div class="row row-cols-2 row-cols-md-4 g-4 text-center pt-4 border-top" style="border-color: rgba(255, 255, 255, 0.12) !important;">
                    <div class="col" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="stat-number gradient-text-gold mb-1">12</h3>
                        <p class="small text-white-50 mb-0" style="letter-spacing: 1.5px;">PRIVATE VILLAS</p>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="stat-number gradient-text-gold mb-1">3</h3>
                        <p class="small text-white-50 mb-0" style="letter-spacing: 1.5px;">HECTARES OF LAND</p>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="stat-number gradient-text-gold mb-1">4.5</h3>
                        <p class="small text-white-50 mb-0" style="letter-spacing: 1.5px;">GUEST RATING</p>
                    </div>
                    <div class="col" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="stat-number gradient-text-gold mb-1">2025</h3>
                        <p class="small text-white-50 mb-0" style="letter-spacing: 1.5px;">PUBLICLY OPEN</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 5: GALLERY
         ========================================================================== -->
    <section class="hero py-5" id="gallery">
        <div class="container pt-4 pb-5">
            <div class="container mb-4 px-0">
                <span class="section-tag" data-aos="fade-right">05 — GALLERY</span>
                <h3 class="mt-2 mb-0" id="zhen-gallery" data-aos="fade-right" data-aos-delay="100">Life at Zhen</h3>
            </div>

            <!-- Staggered Gallery Grid with Hover Zoom & Golden Tint -->
            <div class="row g-3 mb-3">
                <div class="col-sm-8" data-aos="fade-up" data-aos-delay="100">
                    <div class="gallery-box">
                        <img src="{{ asset('images/angkorwat.png') }}" class="gallery-photo" id="angkor-img" alt="Angkor Wat" />
                    </div>
                </div>
                <div class="col-sm-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="gallery-box">
                        <img src="{{ asset('images/spa.png') }}" class="gallery-photo" id="spa-img" alt="Spa Sanctuary" />
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="gallery-box">
                        <img src="{{ asset('images/dinner.png') }}" class="gallery-photo" id="dinner-img" alt="Sunset Dinner" />
                    </div>
                </div>
                <div class="col-sm-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="gallery-box">
                        <img src="{{ asset('images/cuisin.png') }}" class="gallery-photo" id="cuisin-img" alt="Khmer Cuisine" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         SECTION 6: LEADERSHIP / TESTIMONIALS
         ========================================================================== -->
    <section class="hero py-5" id="leadership" style="background-color: var(--resort-cream);">
        <div class="container-fluid text-center py-4">
            <span class="section-tag mb-4" data-aos="fade-up">06 — LEADERSHIP</span>
            <div class="carousel carousel-dark slide" id="peopleCarousel" data-bs-ride="carousel" data-aos="fade-in" data-aos-duration="1000">
                <div class="carousel-inner">

                    <!-- Leader 1 -->
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                        </div>
                        <div class="container text-center px-4">
                            <p class="zhen-ceo-word">
                                "Zhen exceeded every expectation. The staff anticipated our needs before we could articulate them. Waking to the sound of the forest through open shutters, with a private pool steps away — it redefined for us what a holiday can be."
                            </p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column mt-4">
                            <div>
                                <img class="rounded-circle leader-portrait" src="{{ asset('images/ceo-leap.jpeg') }}" alt="CEO" />
                            </div>
                            <div class="mt-2">
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600;">H.E. Neak Oknha T. Bunleap</span></p>
                                <p class="text-muted mb-0" style="font-size: 12.5px;">Founder, Chairman and CEO of</p>
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600; color: var(--resort-green);">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Leader 2 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                        </div>
                        <div class="container text-center px-4">
                            <p class="zhen-ceo-word">
                                "The extraordinary attention of every person we met. Nothing was left to chance. We have stayed in many of the world's great hotels, and Zhen is unlike all of them. We will return."
                            </p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column mt-4">
                            <div>
                                <img class="rounded-circle leader-portrait" src="{{ asset('images/ceo-thea.jpeg') }}" alt="Manager" />
                            </div>
                            <div class="mt-2">
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600;">Neak Oknha M. Vuthea</span></p>
                                <p class="text-muted mb-0" style="font-size: 12.5px;">Vice President, Director, and Manager of</p>
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600; color: var(--resort-green);">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Leader 3 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="30" alt="star" />
                        </div>
                        <div class="container text-center px-4">
                            <p class="zhen-ceo-word">
                                "The private dinner at sunset was a moment we will carry with us for the rest of our lives. Zhen is not a resort. It is a feeling."
                            </p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column mt-4">
                            <div>
                                <img class="rounded-circle leader-portrait" src="{{ asset('images/ceo-la.jpeg') }}" alt="President" />
                            </div>
                            <div class="mt-2">
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600;">Neak Oknha P. Soktola</span></p>
                                <p class="text-muted mb-0" style="font-size: 12.5px;">President, General Manager of</p>
                                <p class="mb-0"><span style="font-size: 19px; font-weight: 600; color: var(--resort-green);">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#peopleCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#peopleCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         8. MODAL: CLIENT LOGIN (Backdrop blur, slide-up, gold focus rings)
         ========================================================================== -->
    <div class="modal fade" id="resortLoginModal" tabindex="-1" aria-labelledby="resortLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content resort-modal p-3 p-sm-4 position-relative">

                <!-- Close Button -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Welcome Header -->
                <div class="text-center mt-2 mb-4">
                    <span class="resort-subtitle">Zhen Resort & Sanctuary</span>
                    <h2 class="resort-title display-6 mt-1 mb-2" id="resortLoginModalLabel">Welcome Back</h2>
                    <p class="text-muted small mb-0 fst-italic">"Where the world falls away..."</p>
                </div>

                <!-- Form -->
                <form id="clientLoginForm" method="POST" action="#">
                    @csrf
                    <!-- Username or Email -->
                    <div class="mb-3">
                        <label for="usernameInput" class="form-label small fw-medium text-secondary">Username or Email</label>
                        <input type="text" class="form-control resort-input" id="usernameInput" name="login" placeholder="Enter your username or email" required />
                    </div>

                    <!-- Password -->
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="passwordInput" class="form-label small fw-medium text-secondary mb-0">Password</label>
                            <a href="#" class="small text-muted text-decoration-none">Forgot?</a>
                        </div>
                        <input type="password" class="form-control resort-input" id="passwordInput" name="password" placeholder="••••••••" required />
                    </div>

                    <!-- Remember Option -->
                    <div class="form-check mb-3 mt-2">
                        <input class="form-check-input" type="checkbox" value="1" id="rememberClient" name="remember">
                        <label class="form-check-label small text-muted" for="rememberClient">
                            Remember me
                        </label>
                    </div>

                    <!-- Sign In Button -->
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-resort-gold w-100" style="border-radius: 8px;">Sign In</button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider-text">or continue with</div>

                <!-- Social Logins -->
                <div class="d-flex flex-column gap-2">
                    <button type="button" class="btn btn-social">
                        <i class="bi bi-google text-danger"></i>
                        <span>Continue with Google</span>
                    </button>
                    <button type="button" class="btn btn-social">
                        <i class="bi bi-apple text-dark"></i>
                        <span>Continue with Apple</span>
                    </button>
                    <button type="button" class="btn btn-social">
                        <i class="bi bi-microsoft text-primary"></i>
                        <span>Continue with Microsoft</span>
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center mt-4 pt-2 border-top">
                    <p class="small text-muted mb-0">
                        Don't have an account?
                        <a href="#" class="resort-link ms-1" data-bs-dismiss="modal">Register here</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <!-- ==========================================================================
         10. FOOTER
         ========================================================================== -->
    <footer>
        <!-- Gradient top divider -->
        <div class="footer-top-gradient"></div>

        <div class="container-fluid px-lg-5 py-5">
            <div class="row gy-5">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-brand">
                        <h2>真 ZHEN</h2>
                        <span class="brand-subtitle">
                            PRIVATE RESORT by NEAK OKNHA BUNLEAP
                        </span>
                        <p>
                            12 private villas and bungalows across a 3-hectares land in the suburb of the city. No crowds. No noise. Just the forest, the reef, and time made yours.
                        </p>
                    </div>
                </div>

                <!-- Your Stay -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h6 class="footer-title">YOUR STAY</h6>
                    <ul class="footer-links">
                        <li><a href="#accommodations">Accommodations</a></li>
                        <li><a href="#experiences">Experiences</a></li>
                        <li><a href="#experiences">Dining & Bar</a></li>
                        <li><a href="#wellness">Spa & Wellness</a></li>
                        <li><a href="#accommodations">Weddings</a></li>
                        <li><a href="#accommodations">Corporate Retreats</a></li>
                    </ul>
                </div>

                <!-- Plan & Book -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <h6 class="footer-title">PLAN & BOOK</h6>
                    <ul class="footer-links">
                        <li><a href="#accommodations">Reserve a Villa</a></li>
                        <li><a href="#accommodations">Special Offers</a></li>
                        <li><a href="#home">Gift Vouchers</a></li>
                        <li><a href="#our-promise">Travel Information</a></li>
                        <li><a href="#home">Seaplane Arrivals</a></li>
                        <li><a href="#our-promise">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <h6 class="footer-title">CONTACT</h6>
                    <ul class="contact-list">
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+855 23 999 996</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+855 23 666 669</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>reservations@zhenprvresort.com</span>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>Siemreap city, Siemreap</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider Line -->
            <div class="footer-divider"></div>

            <!-- Bottom Footer -->
            <div class="row align-items-center footer-bottom">
                <div class="col-md-6 text-center text-md-start">
                    <p class="copyright">
                        © 2025 Zhen Private Resort. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="legal-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                        <a href="#">Sustainability</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#home" class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="bi bi-chevron-up"></i>
    </a>

    <!-- ==========================================================================
         SCRIPTS (Bootstrap, AOS, Scroll Interactions)
         ========================================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // 1. Loading Screen dismissal
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) {
                    loader.classList.add('loaded');
                }
            }, 600);
        });

        // 5. AOS initialization (11. mobile safe configuration)
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            disable: window.innerWidth < 768 ? 'phone' : false
        });

        // 2. Navigation Bar scroll-aware opacity and background transitions
        const navbar = document.getElementById('mainNavbar');
        const backBtn = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            // Navbar scrolled state
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // 10. Back to top button visibility
            if (window.scrollY > 450) {
                backBtn.classList.add('show');
            } else {
                backBtn.classList.remove('show');
            }
        });

        // Auto-close responsive mobile navbar when link is clicked
        document.querySelectorAll('#navbarContent .nav-link, #navbarContent button').forEach(item => {
            item.addEventListener('click', () => {
                const navbarCollapse = document.getElementById('navbarContent');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });

        // Active link scroll highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>