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
                        <li class="breadcrumb-item"><a href="{{ route('front.services.index') }}">Services</a></li>
                        <li class="breadcrumb-item active current">Service Details</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Service Details</h1>
                <p>Professional medical care delivered with precision, advanced technology, and compassionate support.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Service Details 2 Section -->
        <section id="service-details-2" class="service-details-2 section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-5">
                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-image">
                            <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('storage/services/default.jpg') }}"
                                alt="{{ $service->name }}" class="img-fluid">
                            <div class="service-tag">
                                <span>Specialized Care</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="service-content">
                            <h2>{{ $service->name }}</h2>
                            <p class="service-tagline">{{ $service->subtitle }}</p>

                            <p>{{ $service->description }}</p>

                            <div class="service-features">
                                <h4>Our Services Include:</h4>
                                <ul>
                                    @foreach ($service->features as $feature)
                                        <li><i class="bi bi-check-circle"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="service-actions">
                                <a href="#" class="btn-primary">Schedule Consultation</a>
                                <a href="#" class="btn-secondary">Learn More</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-5">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card">
                            <div class="card-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h4>General Consultation</h4>
                            <p>Start a secure online consultation with our medical specialists to discuss your symptoms,
                                receive professional advice, and get guidance without visiting the clinic.</p>
                            <a href="#" class="card-link">
                                <span>Book Now</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-card">
                            <div class="card-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h4>Book a Medical Service</h4>
                            <p>
                                Easily schedule your required medical service online, choose your preferred time, and
                                receive professional care without unnecessary waiting.</p>
                            <a href="#" class="card-link">
                                <span>Schedule Service</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-card">
                            <div class="card-icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <h4>Diagnostic Appointment</h4>
                            <p>Schedule your diagnostic tests and medical evaluations with ease through our streamlined
                                booking system and receive prompt, reliable results.</p>
                            <a href="#" class="card-link">
                                <span>Book Appointment</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row mt-5">

                    <div class="col-lg-8" data-aos="fade-right" data-aos-delay="100">
                        <div class="booking-section">
                            <h3>Ready to Schedule Your Appointment?</h3>
                            <p>Our specialists are available for consultations every day, with same-day appointments offered
                                for urgent cases.</p>

                            <div class="availability-info">
                                <div class="info-item">
                                    <i class="bi bi-clock"></i>
                                    <div>
                                        <strong>Office Hours</strong>
                                        <span>Daily: 9:00 AM – 02:00 PM</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-telephone"></i>
                                    <div>
                                        <strong>Emergency Line</strong>
                                        <a href="tel:+201001234567" class="text-decoration-none">+20 100 123 4567</a>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>
                                        <strong>Location</strong>
                                        <a href="https://maps.google.com/?q=15+Ahmed+Orabi+St,+Dokki,+Giza,+Egypt" class="text-decoration-none" target="_blank">15 Ahmed Orabi St, Dokki, Giza 12611, Egypt</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                        <div class="appointment-card">
                            <h4>Book Your Visit</h4>
                            <p>Quick and easy online scheduling</p>
                            <a href="{{route('front.appointments.create')}}" class="btn-appointment">Book Appointment</a>
                            <div class="contact-alternative">
                                <span>Or call us at</span>
                                <a href="tel:+201001234567">+20 100 123 4567</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Service Details 2 Section -->

    </main>
@endsection