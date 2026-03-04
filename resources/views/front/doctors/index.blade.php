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
                        <li class="breadcrumb-item active current">Doctors</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Doctors</h1>
                <p>Our doctors are highly qualified specialists committed to excellence in healthcare. With years of
                    experience and continuous medical advancement, they deliver safe, reliable, and personalized treatment
                    for every patient.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Doctors Section -->
        <section id="doctors" class="doctors section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <!-- Start Doctor Card -->
                    @foreach ($doctors as $doctor)
                        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="doctor-card">
                                <div class="doctor-image">
                                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Dr. Jennifer Martinez"
                                        class="img-fluid">
                                    <div class="doctor-overlay">
                                        <div class="doctor-social">
                                            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                                            <a href="#" class="social-link"><i class="bi bi-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="doctor-content">
                                    <h4 class="doctor-name">Dr. {{ $doctor->name }}</h4>
                                    <span class="doctor-specialty">{{ $doctor->specialty->name ?? '' }}</span>
                                    <p class="doctor-bio">{{ $doctor->bio }}</p>
                                    <div class="doctor-experience">
                                        <span class="experience-badge">{{ $doctor->years_experience }}+ Years
                                            Experience</span>
                                    </div>
                                    <a href="#" class="btn-appointment">Book Appointment</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Doctor Card -->

                </div>

            </div>

        </section>
        <!-- /Doctors Section -->

    </main>
@endsection
