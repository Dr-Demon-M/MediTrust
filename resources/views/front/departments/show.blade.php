@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('front.departments.index') }}">Departments</a></li>
                        <li class="breadcrumb-item active current">{{ $specialty->name }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Department Details Section -->
        <section id="department-details" class="department-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-8 mx-auto text-center intro" data-aos="fade-up" data-aos-delay="200">
                        <h2>{{ $specialty->name }}</h2>
                        <div class="divider mx-auto"></div>
                        <p class="lead">{{ $specialty->description }}</p>
                    </div>
                </div>

                <div class="department-overview mt-5">
                    <div class="row gy-4">
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="300">
                            <div class="department-image">
                                <img src="{{ asset('storage/' . $specialty->image) }}" alt="{{ $specialty->name }}"
                                    class="img-fluid rounded-lg">
                                <div class="experience-badge">
                                    <span>{{ $specialty->procedures_count }}+</span>
                                    <p>{{ $specialty->procedures_label }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                            <div class="department-services">
                                @foreach ($specialty->features as $feature)
                                    <div class="service-card">
                                        <div class="icon"><i class="bi bi-check-circle-fill"></i></div>
                                        <div class="content">
                                            <h4>{{ $feature->title }}</h4>
                                            <p>{{ $feature->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="department-stats" data-aos="fade-up" data-aos-delay="400">
                    <div class="row gy-4">
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $specialty->procedures_count }}"
                                    data-purecounter-duration="2">0</div>
                                <p>{{ $specialty->procedures_label }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0"
                                    data-purecounter-end="{{ $specialty->doctors->count() }}"
                                    data-purecounter-duration="2">0</div>
                                <p>Specialized Doctors</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0" data-purecounter-end="98"
                                    data-purecounter-duration="2">0</div>
                                <p>Success Rate</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0" data-purecounter-end="24"
                                    data-purecounter-duration="2">0</div>
                                <p>Hours Service</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="key-services mt-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="row gy-4" style="align-items: center;">
                        <div class="col-lg-5" data-aos="fade-right" data-aos-delay="600">
                            <h3>Our Specialized Services</h3>
                            <p>Delivering advanced medical specialties with precision, professionalism, and patient-focused
                                care.</p>
                            <ul class="service-list">
                                @foreach ($specialty->services as $service)
                                    <li><i class="bi bi-check-circle-fill"></i> {{ $service->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-7" data-aos="fade-left" data-aos-delay="600">
                            <div class="cta-wrapper">
                                <div class="cta">
                                    <h3>Expert Care When You Need It Most</h3>
                                    <p>Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, accumsan
                                        id imperdiet et, porttitor at sem. Proin eget tortor risus.</p>
                                    <div class="cta-buttons">
                                        <a href="#" class="btn btn-primary">Book Appointment</a>
                                        <a href="#" class="btn btn-outline">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Department Details Section -->

    </main>
@endsection
