@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">About</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>About</h1>
            </div>
        </div><!-- End Page Title -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="content">
                            <h2>Delivering Trusted Healthcare with Integrity and Precision</h2>
                            <p>
                                We provide comprehensive medical services designed to meet the diverse healthcare needs of
                                our community. Our multidisciplinary team works collaboratively to ensure evidence-based
                                treatments, clear communication, and measurable clinical results.
                            </p>
                            <p>
                                With a commitment to ethical practice and patient safety, we strive to create a supportive
                                environment where every patient feels heard, respected, and confidently cared for.
                            </p>

                            <div class="stats-container" data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">
                                    <div class="col-sm-6 col-lg-12 col-xl-6">
                                        <div class="stat-item">
                                            <div class="stat-number">
                                                <span data-purecounter-start="0" data-purecounter-end="5"
                                                    data-purecounter-duration="1" class="purecounter"></span>+
                                            </div>
                                            <div class="stat-label">Years of Experience</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-12 col-xl-6">
                                        <div class="stat-item">
                                            <div class="stat-number">
                                                <span data-purecounter-start="0" data-purecounter-end="5000"
                                                    data-purecounter-duration="2" class="purecounter"></span>+
                                            </div>
                                            <div class="stat-label">Patients Treated</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                                <a href="{{route('front.doctors.index')}}" class="btn-primary">Meet Our Doctors</a>
                                <a href="{{route('front.services.index')}}" class="btn-secondary">View Our Services</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="image-section" data-aos="fade-left" data-aos-delay="200">
                            <div class="main-image">
                                <img src="assets/img/health/consultation-3.webp" alt="Healthcare consultation"
                                    class="img-fluid">
                            </div>
                            <div class="image-grid">
                                <div class="grid-item">
                                    <img src="assets/img/health/facilities-2.webp" alt="Medical facility" class="img-fluid">
                                </div>
                                <div class="grid-item">
                                    <img src="assets/img/health/staff-5.webp" alt="Medical staff" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="certifications-section" data-aos="fade-up" data-aos-delay="400">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-header">
                                <h3>Accreditations &amp; Certifications</h3>
                                <p>We are proud to be accredited by leading healthcare organizations</p>
                            </div>
                            <div class="certifications-grid">
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-1.webp" alt="JCI Accreditation" class="img-fluid">
                                </div>
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-2.webp" alt="NABH Certification" class="img-fluid">
                                </div>
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-3.webp" alt="ISO 9001" class="img-fluid">
                                </div>
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-4.webp" alt="CAP Accreditation" class="img-fluid">
                                </div>
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-5.webp" alt="Medical Board" class="img-fluid">
                                </div>
                                <div class="certification-item">
                                    <img src="assets/img/clients/clients-6.webp" alt="Healthcare Association"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

    </main>
@endsection