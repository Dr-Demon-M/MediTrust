@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
                        <li class="breadcrumb-item active current">Services</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Services</h1>
                <p>Our services combine advanced diagnostics, expert medical care, and personalized treatment plans to
                    ensure safe and effective healthcare for every patient.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="services-tabs">
                    <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="200">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-service-tab" data-bs-toggle="tab"
                                data-bs-target="#all-service" type="button" role="tab">All Services</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="feature-service-tab" data-bs-toggle="tab"
                                data-bs-target="#feature-service" type="button" role="tab">Featured Services</button>
                        </li>
                    </ul>

                    <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                        {{-- Start All Services --}}
                        <div class="tab-pane fade show active" id="all-service" role="tabpanel">
                            <div class="row g-4">
                                @foreach ($services as $service)
                                    <div class="col-lg-4">
                                        <div class="service-item">
                                            <div class="service-icon-wrapper">
                                                <i class="bi bi-clipboard2-pulse-fill"></i>
                                            </div>
                                            <div class="service-details">
                                                <h5>{{ $service->name }}</h5>
                                                <p>{{ $service->description }}</p>
                                                <ul class="service-benefits">
                                                    @foreach ($service->features as $feature)
                                                        <li><i class="fa fa-check-circle"></i>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                                <a href="{{ route('front.services.show', $service->id) }}" class="service-link">
                                                    <span>Learn More</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        {{-- End All Services --}}

                        {{-- Start Feature Services --}}
                        <div class="tab-pane fade" id="feature-service" role="tabpanel">
                            <div class="row g-4">
                                @foreach ($featureServices as $service)
                                    <div class="col-lg-4">
                                        <div class="service-item featured">
                                            <div class="service-icon-wrapper">
                                                <i class="fa fa-heartbeat"></i>
                                            </div>
                                            <div class="service-details">
                                                <h5>{{ $service->name }}</h5>
                                                <p>{{ $service->description }}</p>
                                                <ul class="service-benefits">
                                                    @foreach ($service->features as $feature)
                                                        <li><i class="fa fa-check-circle"></i>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                                <a href="{{ route('front.services.show', $service->id) }}" class="service-link">
                                                    <span>Learn More</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- End Feature Services --}}
                    </div>
                </div>

                <div class="services-cta" data-aos="fade-up" data-aos-delay="400">
                    <div class="row">
                        <div class="col-lg-8 mx-auto text-center">
                            <div class="cta-content">
                                <i class="fa fa-calendar-check"></i>
                                <h3>Ready to Schedule Your Appointment?</h3>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur excepteur sint occaecat cupidatat non proident.</p>
                                <div class="cta-buttons">
                                    <a href="{{ route('front.appointments.create') }}" class="btn-book">Book Now</a>
                                    <a href="{{route('front.contact.index')}}" class="btn-contact">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Services Section -->

    </main>
@endsection