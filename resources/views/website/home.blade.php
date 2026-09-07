<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: "Poppins", sans-serif;
        }

        .nav-text {
            font-family: "Poppins", sans-serif;
            font-style: normal;
            color: white;
        }

        nav {
            background-color: #014040;
        }

        /* section home */
        #zhen-quote {
            font-family: "Kaushan Script", cursive;
            font-size: 56px;
        }


        /* section 1 */
        #home-id-1 {

            background: linear-gradient(to bottom,
                    #014040 0%,
                    #013636 70%,
                    #012b2b 100%);

            color: white;
        }

        #zhen-promise {
            font-family: "Kaushan Script", cursive;
            font-size: 28px;
        }

        /* section 2 */
        #zhen-accommodation {
            font-family: "Kaushan Script", cursive;
            font-size: 28px;
        }

        .accommodation-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        #accommodation-list {
            font-size: 12px;
        }

        /* section 3 */
        #zhen-experience {
            font-family: "Kaushan Script", cursive;
            font-size: 28px;
        }

        .experiences-section {
            padding: 0 7%;
        }

        .experience-card {
            position: relative;
            overflow: hidden;
            border-radius: 2px;
            color: #fff;
        }

        /*
        Individual image heights
        */
        .experience-card.small {
            height: 334px;
        }

        .experience-card.large {
            height: 453px;
        }

        /*
        Image
        */
        .experience-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;

            transition: transform 0.7s ease;
        }

        /*
        Dark gradient over image
        */
        .experience-card::after {
            content: "";
            position: absolute;
            inset: 0;

            background:
                linear-gradient(to top,
                    rgba(10, 9, 7, 0.72) 0%,
                    rgba(10, 9, 7, 0.25) 45%,
                    rgba(10, 9, 7, 0.02) 75%);

            z-index: 1;
        }

        /*
        Text positioned absolutely
        */
        .experience-content {
            position: absolute;
            left: 35px;
            right: 35px;
            bottom: 34px;

            z-index: 2;
        }

        /*
        Small category
        */
        .experience-category {
            display: block;

            margin-bottom: 10px;

            font-family: "Montserrat", sans-serif;
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 4px;

            color: rgba(255, 255, 255, 0.75);
        }

        /*
        Main heading
        */
        .experience-title {
            margin: 0 0 10px;

            font-family: "Cormorant Garamond", serif;
            font-size: 29px;
            font-weight: 400;
            line-height: 1.1;

            color: #fff;
        }

        /*
        Description
        */
        .experience-description {
            max-width: 430px;

            margin: 0 0 20px;

            font-family: "Montserrat", sans-serif;
            font-size: 13px;
            font-weight: 400;
            line-height: 1.8;

            color: rgba(255, 255, 255, 0.68);
        }

        /*
        Enquire link
        */
        .experience-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            font-family: "Montserrat", sans-serif;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 3px;

            color: #fff;
            text-decoration: none;

            transition: gap 0.3s ease;
        }

        .experience-link:hover {
            color: #fff;
            gap: 14px;
        }

        .experience-link i {
            font-size: 13px;
            letter-spacing: 0;
        }

        /*
        Image zoom on hover
        */
        .experience-card:hover img {
            transform: scale(1.04);
        }


        /*
        Desktop spacing between cards
        */
        .experience-column .experience-card+.experience-card {
            margin-top: 17px;
        }


        /*
        Tablet
        */
        @media (max-width: 991.98px) {

            .experiences-section {
                padding: 0 4%;
            }

            .experience-card.small,
            .experience-card.large {
                height: 400px;
            }

            .experience-content {
                left: 28px;
                right: 28px;
                bottom: 28px;
            }
        }


        /*
        Mobile
        */
        @media (max-width: 767.98px) {

            .experiences-section {
                padding: 0 15px;
            }

            .experience-card.small,
            .experience-card.large {
                height: 400px;
            }

            .experience-column+.experience-column {
                margin-top: 17px;
            }

            .experience-title {
                font-size: 27px;
            }

            .experience-description {
                font-size: 12px;
            }
        }

        /* section 4 */
        #zhen-amenity,
        #zhen-amenities {
            font-family: "Kaushan Script", cursive;
            font-size: 28px;
        }

        #section-id-4 {

            background: linear-gradient(to bottom,
                    #014040 0%,
                    #013636 70%,
                    #012b2b 100%);

            color: white;
        }

        /* section 5 */
        #zhen-gallery {
            font-family: "Kaushan Script", cursive;
            font-size: 28px;
        }

        #angkor-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        #dinner-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        #spa-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        #cuisin-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        /* section 6 */
        .zhen-ceo-word {
            font-family: "Kaushan Script", cursive;
            font-size: 24px;
        }

        /* footer */
        /* == */
        footer {
            background-color: #141311;
        }

        .luxury-footer {
            /* background: #1c1b18; */
            padding: 85px 0 85px;
            color: #858078;
        }

        /* Brand */
        .footer-brand h2 {
            font-size: 31px;
            font-weight: 600;
            letter-spacing: 9px;
            color: #e6e1d8;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            display: block;
            font-size: 9px;
            letter-spacing: 4px;
            color: #a49b8d;
            margin-bottom: 28px;
        }

        .footer-brand p {
            max-width: 290px;
            font-size: 14px;
            line-height: 2.25;
            margin: 0;
            color: #89837a;
        }

        /* Footer headings */
        .footer-title {
            color: #d7d1c8;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 4px;
            margin-bottom: 26px;
        }

        /* Links */
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 18px;
        }

        .footer-links a {
            color: #89837a;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #c6a35b;
        }

        /* Contact */
        .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .contact-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #89837a;
        }

        .contact-list i {
            font-size: 15px;
            color: #b48b3c;
            min-width: 16px;
        }


        /* Divider */
        .footer-divider {
            height: 1px;
            background: #35322d;
            margin: 58px 0 42px;
        }

        /* Bottom footer */
        .footer-bottom {
            font-size: 12px;
        }

        .copyright {
            margin: 0;
            color: #69645d;
        }

        .legal-links {
            display: flex;
            justify-content: flex-end;
            gap: 32px;
        }

        .legal-links a {
            color: #69645d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .legal-links a:hover {
            color: #c6a35b;
        }
    </style>

</head>

<body>
    <!-- nav  -->
    <nav class="nav navbar-expand-lg fixed-top">
        <div class="container px-3">
            <ul class="nav justify-content-around nav-underline">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><span class="nav-text">Wellness</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><span class="nav-text">Experiences</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><span class="nav-text">Zhen Resort</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><span class="nav-text">Accommodations</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"><span class="nav-text">Gallery</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <!--  -->
    <!-- section home -->
    <section class="hero" id="home">
        <div class="container-fluid pt-5 py-5" id="home-id-1">

            <p class="text-center"><span style="font-size: 12px;">LIVING IN PEACE | SIEMREAP CITY | ZHEN PARADISE RESORT</span></p>

            <h2 class="text-center" id="zhen-quote">Where the World Falls Away</h2>

            <p class="text-center"><span style="font-size: 12px;">ZHEN RESORT BY NEK OKNHA BUNLEAP</span></p>

            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-warning">
                    FIND YOUR STAY
                </a>
            </div>
        </div>
    </section>
    </div>
    <!-- section 1 -->
    <section class="hero" id="our-promise">
        <div class="container-fluid py-5" id="home-id-2">

            <p class="text-center"><span style="font-size: 12px;">01-OUR PROMISE</span></p>

            <h3 class="text-center" id="zhen-promise">Zhen was conceived for those who seek not spectacle, but silence — the rare luxury of having nothing to do and every resource to do it beautifully.</h3>

            <p class="text-center">_______________</p>

            <p class="text-center"><span style="font-size: 12px;">Twelve private villas and bungalows across a 3-hectares land in the suburb of the city. No crowds. No noise. Just the forest, the reef, and time made yours.</span></p>

        </div>
    </section>
    <!-- section 2 -->
    <section class="hero" id="">
        <div class="container-fluid" style="background-color: #ffffee;">
            <div class="container pt-5 py-5">
                <p class=""><span style="font-size: 12px;">02-ACCOMMODATIONS</span></p>

                <h3 class="" id="zhen-accommodation">Your Private Sanctuary</h3>

                <p><span style="font-size: 12px;">Every accommodation at Zhen is designed to dissolve the boundary between interior and the silence nature.</span></p>

            </div>
            <div class="container-fluid">
                <!-- image section -->
                <!-- <div class="d-flex justify-content-evenly gap-4"> -->
                <div class="row g-4 mt-4">


                    <!--  -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header badge  text-bg-success">
                                Signature
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('images/premium.png') }}" class="card-img-top accommodation-img" alt="premium" />
                                <h5 class="card-title mt-3">Tropical Garden Suite</h5>
                                <p class="card-text"><span style="font-size: 12px;">180 m² | 2 guests</span></p>
                                <p class="card-text"><span style="font-size: 12px;">Nestled within fragrant tropical gardens,
                                        this suite offers an immersive connection to nature — outdoor rain shower, private plunge pool, and a terrace alive with birdsong.</span></p>

                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Private infinity pool</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Outdoor rain shower</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Garden terrace</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Hammock lounge</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                </ul>

                                <hr>
                                <div class="container d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 12px">FROM</span>
                                        <br>
                                        <p><span style="font-size: 28px;">$985</span><span style="font-size: 12px;">/night</span></p>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-success">Reserve >></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header badge  text-bg-success">
                                Most Sought After
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('images/privatepool.png') }}" class="card-img-top accommodation-img" alt="premium" />
                                <h5 class="card-title mt-3">Ocean Pool Villa</h5>
                                <p class="card-text"><span style="font-size: 12px;">280 m² | 2 guests</span></p>
                                <p class="card-text"><span style="font-size: 12px;"> A private sanctuary perched at the water's edge, where your infinity pool dissolves seamlessly into the Indian Ocean.
                                        Butler service and a dedicated sun deck complete this ultimate retreat.</span></p>

                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Private infinity pool</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Overwater sun deck</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">24-hr butler</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Ocean Panorama</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                </ul>

                                <hr>
                                <div class="container d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 12px">FROM</span>
                                        <br>
                                        <p><span style="font-size: 28px;">$1,850</span><span style="font-size: 12px;">/night</span></p>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-success">Reserve >></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header badge  text-bg-success">
                                Signature
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('images/suite.png') }}" class="card-img-top accommodation-img" alt="premium" />
                                <h5 class="card-title mt-3">Ultimate Suite Villa</h5>
                                <p class="card-text"><span style="font-size: 12px;">360 m² | 2 guests</span></p>
                                <p class="card-text"><span style="font-size: 12px;">Indulge in ultimate luxury in our premier suite, featuring floor-to-ceiling sunset nature views,
                                        exquisite modern design, and spacious living crafted for an unforgettable, high-end sanctuary.</span></p>

                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">24/7 Personal Butler Service</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Panoramic Floor-to-Ceiling Views</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">In-Suite Private Dining Experience</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center mb-3">
                                        <span id="accommodation-list">Access to all resort amenities and spas</span>
                                        <span class="badge text-bg-success rounded-pill">✔</span>
                                    </li>
                                </ul>

                                <hr>
                                <div class="container d-flex justify-content-between align-items-center">
                                    <div>
                                        <span style="font-size: 12px">FROM</span>
                                        <br>
                                        <p><span style="font-size: 28px;">$2,250</span><span style="font-size: 12px;">/night</span></p>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-success">Reserve >></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- section 3 -->
    <section class="hero">

        <div class="container pt-5 py-5">
            <p class=""><span style="font-size: 12px;">03-EXPERIENCES</span></p>

            <h3 class="" id="zhen-experience">Curated for
                the Discerning</h3>

            <div class="row g-0">

                <!-- left -->
                <div class="col-lg-6 pe-lg-2 experience-column">
                    <!-- Card 1 -->
                    <div class="experience-card small">

                        <img
                            src="{{ asset('images/spa.png') }}"
                            alt="image">

                        <div class="experience-content">

                            <span class="experience-category">
                                CULINARY
                            </span>

                            <h2 class="experience-title">
                                Private Sandbank Dining
                            </h2>

                            <p class="experience-description">
                                A table set for two on a deserted sandbank as
                                the sun descends behind the horizon. Our chefs
                                prepare a bespoke menu from the day's freshest catch.
                            </p>

                            <a href="#" class="experience-link">
                                ENQUIRE
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>


                    <!-- Card 3 -->
                    <div class="experience-card large">

                        <img
                            src="{{ asset('images/cuisin.png') }}"
                            alt="Canal Boat Expedition">

                        <div class="experience-content">

                            <span class="experience-category">
                                ADVENTURE
                            </span>

                            <h2 class="experience-title">
                                Canal Boat Expedition
                            </h2>

                            <p class="experience-description">
                                Discover hidden waterways and untouched
                                landscapes on a private journey.
                            </p>

                            <a href="#" class="experience-link">
                                ENQUIRE
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>

                </div>


                <!-- right -->
                <div class="col-lg-6 ps-lg-2 experience-column">

                    <!-- Card 2 -->
                    <div class="experience-card large">

                        <img
                            src="{{ asset('images/angkorwat.png') }}"
                            alt="Image">

                        <div class="experience-content">

                            <span class="experience-category">
                                WELLNESS
                            </span>

                            <h2 class="experience-title">
                                Signature Spa Journey
                            </h2>

                            <p class="experience-description">
                                A four-hour immersion drawing from ancient
                                Ayurvedic traditions and island botanicals.
                                Begin with a warm coconut oil ritual and
                                conclude with a crystalline plunge.
                            </p>

                            <a href="#" class="experience-link">
                                ENQUIRE
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>


                    <!-- Card 4 -->
                    <div class="experience-card large">

                        <img
                            src="{{ asset('images/dinner.png') }}"
                            alt="Image">

                        <div class="experience-content">

                            <span class="experience-category">
                                CULTURE
                            </span>

                            <h2 class="experience-title">
                                Island Heritage Journey
                            </h2>

                            <p class="experience-description">
                                Experience the history, traditions and
                                stories of the islands.
                            </p>

                            <a href="#" class="experience-link">
                                ENQUIRE
                                <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- section 4 -->
    <section class="hero" id="section-id-4">
        <div class="container-fluid">
            <div class="container pt-5 py-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class=""><span style="font-size: 12px;">04-RESORT AMENITIES</span></p>

                        <h3 class="" id="zhen-amenity">Every Detail,
                            Considered</h3>

                        <p><span style="font-size: 12px;">From the moment you arrive by your ride until your final morning, every facility exists to serve the experience of unhurried luxury.</span></p>
                        <hr>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-around gap-5 p-2">
                            <div class="d-flex flex-column"><img src="{{ asset('images/water-svgrepo.png') }}" width="35px" alt="icon" />Infinity Pool</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/leaves-svgrepo.png') }}" width="35px" alt="icon" />Organic Spa</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/dinner-svgrepo.png') }}" width="35px" alt="icon" />Fine Dining</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/sun-svgrepo.png') }}" width="35px" alt="icon" />Beach Club</div>
                        </div>
                        <div class="d-flex justify-content-around gap-5 p-2">
                            <div class="d-flex flex-column"><img src="{{ asset('images/wifi-svgrepo.png') }}" width="35px" alt="icon" />High-Speed Wifi</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/coffee-svgrepo.png') }}" width="35px" alt="icon" />In-Villa Dining</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/shield-svgrepo.png') }}" width="35px" alt="icon" />Concierge 24/7</div>
                            <div class="d-flex flex-column"><img src="{{ asset('images/location-svgrepo.png') }}" width="35px" alt="icon" />Island Excursions</div>
                        </div>
                    </div>
                </div>

                <div class="container d-flex justify-content-between">
                    <div>
                        <h3 class="" id="zhen-amenities">12</h3>
                        <p class=""><span style="font-size: 12px;">PRIVATE VILLA</span></p>
                    </div>
                    <div>
                        <h3 class="" id="zhen-amenities">3</h3>
                        <p class=""><span style="font-size: 12px;">HECTARES OF LAND</span></p>
                    </div>
                    <div>
                        <h3 class="" id="zhen-amenities">4.5</h3>
                        <p class=""><span style="font-size: 12px;">GUEST RATING</span></p>
                    </div>
                    <div>
                        <h3 class="" id="zhen-amenities">2025</h3>
                        <p class=""><span style="font-size: 12px;">PUBLICLY OPEN</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section 5 -->
    <section class="hero">
        <div class="container-fluid pt-5 py-5">
            <div class="container">
                <p class=""><span style="font-size: 12px;">05-GALLERY</span></p>
                <h3 class="" id="zhen-gallery">Life at Zhen</h3>
            </div>
            <!--  -->
            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-8">
                        <img src="{{ asset('images/angkorwat.png') }}" id="angkor-img" alt="image" />
                    </div>
                    <div class="col-sm-4"><img src="{{ asset('images/spa.png') }}" id="spa-img" alt="image" /></div>
                </div>
                <div class="row">
                    <div class="col-sm"><img src="{{ asset('images/dinner.png') }}" id="dinner-img" alt="image" /></div>
                    <div class="col-sm"><img src="{{ asset('images/cuisin.png') }}" id="cuisin-img" alt="image" /></div>
                </div>
            </div>
            <!--  -->
        </div>
    </section>

    <!-- section 6 -->
    <section class="hero">

        <div class="container-fluid text-center pt-5 py-5" style="background-color: #ffffee;">
            <p class=""><span style="font-size: 12px;">05-Leadership</span></p>
            <div class="carousel slide" id="peopleCarousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- item 1 -->
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                        </div>
                        <div class="container text-center">
                            <p class="zhen-ceo-word">"Zhen exceeded every expectation. The staff anticipated our needs before we could articulate them. Waking to the sound of the forest through open shutters, with a private pool steps away — it redefined for us what a holiday can be."</p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column">
                            <div>
                                <img class="rounded-circle" src="{{ asset('images/ceo-leap.jpeg') }}" width="100px" alt="CEO" />
                            </div>
                            <div>
                                <p><span style="font-size: 20px;">H.E. Neak Oknha T. Bunleap</span></p>
                                <p><span style="font-size: 12px;">Founder, Chairman and CEO of</span></p>
                                <p><span style="font-size: 20px;">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- item 2 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                        </div>
                        <div class="container text-center">
                            <p class="zhen-ceo-word">"The extraordinary attention of every person we met. Nothing was left to chance. We have stayed in many of the world's great hotels, and Zhen is unlike all of them. We will return."</p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column">
                            <div>
                                <img class="rounded-circle" src="{{ asset('images/ceo-thea.jpeg') }}" width="100px" alt="Manager" />
                            </div>
                            <div>
                                <p><span style="font-size: 20px;">Neak Oknha M. Vuthea</span></p>
                                <p><span style="font-size: 12px;">Vice President, Director, and Manager of</span></p>
                                <p><span style="font-size: 20px;">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- item 3 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                            <img src="{{ asset('images/star-shine.png') }}" width="35px" alt="star" />
                        </div>
                        <div class="container text-center">
                            <p class="zhen-ceo-word">"The private dinner at sunset was a moment we will carry with us for the rest of our lives. Zhen is not a resort. It is a feeling."</p>
                        </div>
                        <div class="container d-flex justify-content-center text-center flex-column">
                            <div>
                                <img class="rounded-circle" src="{{ asset('images/ceo-la.jpeg') }}" width="100px" alt="President" />
                            </div>
                            <div>
                                <p><span style="font-size: 20px;">Neak Oknha P. Soktola</span></p>
                                <p><span style="font-size: 12px;">President, General Manager of</span></p>
                                <p><span style="font-size: 20px;">Zhen Private Resort</span></p>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>

                <!-- indicatior buttom -->
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

    <footer>
        <div class="container-fluid px-lg-5 py-5">
            <div class="row gy-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-brand">
                        <h2>真 ZHEN</h2>

                        <span class="brand-subtitle">
                            PRIVATE RESORT by Neak Oknha Bunleap
                        </span>

                        <p>
                            12 private villas and bungalows across a 3-hectares land in the suburb of the city. No crowds. No noise. Just the forest, the reef, and time made yours.
                        </p>

                    </div>
                </div>

                <!-- Your Stay -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">YOUR STAY</h6>

                    <ul class="footer-links">
                        <li><a href="#">Accommodations</a></li>
                        <li><a href="#">Experiences</a></li>
                        <li><a href="#">Dining & Bar</a></li>
                        <li><a href="#">Spa & Wellness</a></li>
                        <li><a href="#">Weddings</a></li>
                        <li><a href="#">Corporate Retreats</a></li>
                    </ul>
                </div>

                <!-- Plan & Book -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-title">PLAN & BOOK</h6>

                    <ul class="footer-links">
                        <li><a href="#">Reserve a Villa</a></li>
                        <li><a href="#">Special Offers</a></li>
                        <li><a href="#">Gift Vouchers</a></li>
                        <li><a href="#">Travel Information</a></li>
                        <li><a href="#">Seaplane Arrivals</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
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

            <!-- Line -->
            <div class="footer-divider"></div>

            <!-- Bottom Footer -->
            <div class="row align-items-center footer-bottom">

                <div class="col-md-6">
                    <p class="copyright">
                        © 2025 Avelara Private Island Resort. All rights reserved.
                    </p>
                </div>

                <div class="col-md-6">
                    <div class="legal-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                        <a href="#">Sustainability</a>
                    </div>
                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>