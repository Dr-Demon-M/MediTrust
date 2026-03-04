@extends('layouts.frontLayout')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <div class="container-fluid p-0">
                <div class="hero-wrapper">
                    <div class="hero-image">
                        <img src="{{ asset('assets/img/health/showcase-1.webp') }}" alt="Advanced Healthcare"
                            class="img-fluid">
                    </div>

                    <div class="hero-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-10" data-aos="fade-right" data-aos-delay="100">
                                    <div class="content-box">
                                        <span class="badge-accent" data-aos="fade-up" data-aos-delay="150">Leading
                                            Healthcare Specialists</span>
                                        <h1 data-aos="fade-up" data-aos-delay="200">Advanced Medical Care for Your
                                            Family's Health</h1>
                                        <p data-aos="fade-up" data-aos-delay="250">We provide trusted healthcare services
                                            with experienced doctors, modern medical technology, and patient-centered care.
                                            Book your appointment easily and receive professional treatment tailored to your
                                            needs.</p>

                                        <div class="cta-group" data-aos="fade-up" data-aos-delay="300">
                                            <a href="{{ route('front.appointments.create') }}" class="btn btn-primary">Book
                                                Appointment</a>
                                            <a href="{{ route('front.services.index') }}" class="btn btn-outline">Explore
                                                Services</a>
                                        </div>

                                        <div class="info-badges" data-aos="fade-up" data-aos-delay="350">
                                            <div class="badge-item">
                                                <i class="bi bi-telephone-fill"></i>
                                                <div class="badge-content">
                                                    <span>Emergency Line</span>
                                                    <strong>+20 100 123 4567</strong>
                                                </div>
                                            </div>
                                            <div class="badge-item">
                                                <i class="bi bi-clock-fill"></i>
                                                <div class="badge-content">
                                                    <span>Working Hours</span>
                                                    <strong>Mon-Fri: 9AM-2PM</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="features-wrapper">
                                <div class="row gy-4">
                                    @foreach ($specialties as $specialty)
                                        <div class="col-lg-4">
                                            <div class="feature-item" data-aos="fade-up" data-aos-delay="450">
                                                <div class="feature-icon">
                                                    <i class="bi {{ $specialty->icon }}"></i>
                                                </div>
                                                <div class="feature-text">
                                                    <h3>{{ $specialty->name }}</h3>
                                                    <p>{{ $specialty->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </section><!-- /Hero Section -->

        <!-- Home About Section -->
        <section id="home-about" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-image">
                            <img src="{{ asset('assets/img/health/facilities-1.webp') }}" alt="Modern Healthcare Facility"
                                class="img-fluid rounded-3 mb-4">
                            <div class="experience-badge">
                                <span class="years">5+</span>
                                <span class="text">Years of Excellence</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-content">
                            <h2>Comprehensive Medical Care You Can Trust</h2>
                            <p class="lead">At our clinic, we provide comprehensive medical services tailored to
                                individuals and families. Our multidisciplinary team ensures accurate diagnosis, effective
                                treatment plans, and continuous follow-up to support long-term health and well-being.</p>

                            <p>With over 5 years of medical excellence, we combine modern diagnostic tools with
                                evidence-based practices to deliver safe, reliable, and patient-focused healthcare in a
                                comfortable clinical environment.</p>

                            <div class="row g-4 mt-4">
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                    <div class="feature-item">
                                        <div class="icon">
                                            <i class="bi bi-heart-pulse"></i>
                                        </div>
                                        <h4>Compassionate Care</h4>
                                        <p>We prioritize patient comfort, respectful communication, and personalized
                                            attention to ensure every visit is handled with empathy and professionalism.</p>
                                    </div>
                                </div>

                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                    <div class="feature-item">
                                        <div class="icon">
                                            <i class="bi bi-star"></i>
                                        </div>
                                        <h4>Medical Excellence</h4>
                                        <p>Our clinic follows strict medical protocols and utilizes modern equipment to
                                            provide accurate diagnostics and high-quality treatment across various medical
                                            specialties.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="cta-wrapper mt-4">
                                <a href="{{ route('front.about.index') }}" class="btn btn-primary">Learn More About Us</a>
                                <a href="{{ route('front.doctors.index') }}" class="btn btn-outline">Meet Our Team</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 pt-4 certifications-row" data-aos="fade-up" data-aos-delay="600">
                    <div class="col-12 text-center mb-4">
                        <h4 class="certification-title">Our Accreditations</h4>
                    </div>
                    <div class="col-12">
                        <div class="certifications">
                            <div class="certification-item" data-aos="zoom-in" data-aos-delay="700">
                                <img src="{{ asset('assets/img/clients/clients-1.webp') }}" alt="Certification">
                            </div>
                            <div class="certification-item" data-aos="zoom-in" data-aos-delay="800">
                                <img src="{{ asset('assets/img/clients/clients-2.webp') }}" alt="Certification">
                            </div>
                            <div class="certification-item" data-aos="zoom-in" data-aos-delay="900">
                                <img src="{{ asset('assets/img/clients/clients-3.webp') }}" alt="Certification">
                            </div>
                            <div class="certification-item" data-aos="zoom-in" data-aos-delay="1000">
                                <img src="{{ asset('assets/img/clients/clients-4.webp') }}" alt="Certification">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Home About Section -->

        <!-- Featured Departments Section -->
        <section id="featured-departments" class="featured-departments section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Featured Departments</h2>
                <p>Discover our medical departments dedicated to providing specialized healthcare services.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    @foreach ($departments as $department)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="department-card">
                                <div class="department-image">
                                    <img src="{{ asset('storage/' . $department->image) }}"
                                        alt="{{ $department->name }}" class="img-fluid">
                                </div>
                                <div class="department-content">
                                    <div class="department-icon">
                                        <i class="bi {{ $department->icon }}"></i>
                                    </div>
                                    <h3>{{ $department->name }}</h3>
                                    <p>{{ $department->description }}</p>
                                    <a href="{{ route('front.departments.show', $department->id) }}"
                                        class="btn-learn-more">
                                        <span>Learn More</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End Department Card -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Featured Departments Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Featured Services</h2>
                <p>Explore our range of medical services designed to provide accurate diagnosis and effective treatment.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    @foreach ($featuredServices as $service)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="service-content">
                                    <h3>{{ $service->name }}</h3>
                                    <p>{{ $service->description }}</p>
                                    <ul class="service-features">
                                        @foreach ($service->features as $feature)
                                            <li>
                                                <i class="bi bi-check-circle"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('front.services.show', $service->id) }}" class="service-btn">
                                        Learn More
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End Service Card -->
                    @endforeach
                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- Find A Doctor Section -->
        <section id="find-a-doctor" class="find-a-doctor section">

            <div class="container section-title">
                <h2>Find A Doctor</h2>
                <p>Search for trusted doctors and book an appointment with the right specialist.</p>
            </div>

            <div class="container">

                <!-- Search -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="search-container">

                            <form id="doctor-search-form">
                                <div class="row g-3">

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="doctor_name"
                                            placeholder="Doctor name or keyword">
                                    </div>

                                    <div class="col-md-4">
                                        <select class="form-select" id="specialty_id">
                                            <option value="">Select Specialty</option>
                                            @foreach ($allSpecialties as $specialty)
                                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-search me-2"></i>
                                            Search Doctor
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Results -->
                <div class="row mt-4" id="doctor-results">

                </div>

            </div>

        </section>

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 data-aos="fade-up" data-aos-delay="200">Your Health is Our Priority</h2>
                        <p data-aos="fade-up" data-aos-delay="250">Our mission is to deliver trusted healthcare services
                            with compassion, expertise, and advanced medical solutions.</p>

                        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
                            <a href="{{ route('front.appointments.create') }}" class="btn-primary">Book Appointment</a>
                            <a href="{{ route('front.doctors.index') }}" class="btn-secondary">Find a Doctor</a>
                        </div>
                    </div>
                </div>

                <div class="row features-row" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="feature-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h5>Easy Online Booking</h5>
                            <p>Schedule your appointment online in just a few simple steps at your convenience.</p>
                            <a href="{{ route('front.appointments.create') }}" class="feature-link">
                                <span>Book Now</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="feature-card">
                            <div class="icon-wrapper">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5>Expert Medical Team</h5>
                            <p>Our experienced doctors and healthcare professionals are dedicated to providing high-quality
                                medical care for every patient.</p>
                            <a href="{{ route('front.doctors.index') }}" class="feature-link">
                                <span>Meet Our Doctors</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="emergency-alert" data-aos="zoom-in" data-aos-delay="500">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="emergency-content">
                                <div class="emergency-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="emergency-text">
                                    <h4>Medical Emergency?</h4>
                                    <p>Call our emergency hotline for immediate assistance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <a href="#" class="emergency-btn">
                                <i class="bi bi-telephone-fill"></i>
                                Call +20 100 123 4567
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Call To Action Section -->

        <!-- Emergency Info Section -->
        <section id="emergency-info" class="emergency-info section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Emergency Info</h2>
                <p>Get immediate assistance and essential information in case of medical emergencies.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">

                        <!-- Emergency Alert Banner -->
                        <div class="emergency-alert" data-aos="zoom-in" data-aos-delay="100">
                            <div class="alert-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div class="alert-content">
                                <h3>Medical Emergency?</h3>
                                <p>If you are experiencing a life-threatening emergency, call 123 immediately or go to
                                    your nearest emergency room.</p>
                            </div>
                            <div class="alert-action">
                                <a href="#" class="btn btn-emergency">
                                    <i class="bi bi-telephone-fill"></i>
                                    Call 123
                                </a>
                            </div>
                        </div><!-- End Emergency Alert -->

                        <!-- Quick Actions -->
                        <div class="quick-actions" data-aos="fade-up" data-aos-delay="300">
                            <h4>Quick Actions</h4>
                            <div class="row">
                                <div class="col-sm-6 col-lg-3">
                                    <a href="#" class="action-link">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>Get Directions</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <a href="{{ route('front.appointments.create') }}" class="action-link">
                                        <i class="bi bi-calendar-check"></i>
                                        <span>Book Appointment</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <a href="{{ route('front.doctors.index') }}" class="action-link">
                                        <i class="bi bi-person-badge"></i>
                                        <span>Find a Doctor</span>
                                    </a>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <a href="#" class="action-link">
                                        <i class="bi bi-chat-dots"></i>
                                        <span>Live Chat</span>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End Quick Actions -->

                        <!-- Emergency Preparation Tips -->
                        <div class="emergency-tips" data-aos="fade-up" data-aos-delay="400">
                            <h4>When to Seek Emergency Care</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="emergency-list">
                                        <li><i class="bi bi-check-circle"></i> Chest pain or difficulty breathing</li>
                                        <li><i class="bi bi-check-circle"></i> Severe allergic reactions</li>
                                        <li><i class="bi bi-check-circle"></i> Major trauma or injuries</li>
                                        <li><i class="bi bi-check-circle"></i> Signs of stroke or heart attack</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="emergency-list">
                                        <li><i class="bi bi-check-circle"></i> Severe burns or bleeding</li>
                                        <li><i class="bi bi-check-circle"></i> Loss of consciousness</li>
                                        <li><i class="bi bi-check-circle"></i> Severe abdominal pain</li>
                                        <li><i class="bi bi-check-circle"></i> High fever with confusion</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- End Emergency Tips -->

                    </div>
                </div>

            </div>

        </section><!-- /Emergency Info Section -->

    </main>
    <script>
        document.getElementById('doctor-search-form').addEventListener('submit', function(e) {

            e.preventDefault();

            let name = document.getElementById('doctor_name').value
            let specialty_id = document.getElementById('specialty_id').value

            fetch(`/search-doctors?doctor_name=${name}&specialty_id=${specialty_id}`)

                .then(response => response.json())

                .then(data => {

                    let container = document.getElementById("doctor-results")

                    container.innerHTML = ""

                    if (data.length === 0) {
                        container.innerHTML = `
                                <div class="col-12 text-center">
                                    <p>No doctors found</p>
                                </div>`
                        return
                    }

                    data.forEach(doctor => {

                        container.innerHTML += `

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="doctor-card">

                        <div class="doctor-image">

                            <img src="/storage/${doctor.photo}" 
                            class="img-fluid">

                            <div class="availability-badge online">
                                Available
                            </div>

                        </div>

                        <div class="doctor-info">

                            <h5>${doctor.name}</h5>

                            <p class="specialty">
                                ${doctor.specialty.name}
                            </p>

                            <p class="experience">
                                ${doctor.years_experience} years experience
                            </p>

                            <div class="appointment-actions">

                                <a href="/appointments/create" 
                                class="btn btn-primary btn-sm">
                                    Book Appointment
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                `

                    })

                })

        })
    </script>
@endsection
