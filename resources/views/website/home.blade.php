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
                                Signature
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

            <!-- image section -->
            <div></div>
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
                    <div>
                        <!-- icons go here -->
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
        <div class="container-fluid">
            <div class="container pt-5 py-5">
                <p class=""><span style="font-size: 12px;">05-GALLERY</span></p>
                <h3 class="" id="zhen-gallery">Life at Zhen</h3>
            </div>
        </div>
    </section>
</body>

</html>