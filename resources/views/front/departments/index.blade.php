@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
                        <li class="breadcrumb-item active current">Departments</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Departments</h1>
                <p>Our specialized departments bring together expert physicians, modern diagnostic tools, and evidence-based
                    practices to ensure safe, reliable, and high-quality healthcare for every patient.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Departments Section -->
        <section id="departments" class="departments section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    @foreach ($specialties as $specialty)
                    <!-- One Card -->
                    <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                        <div class="department-card" data-aos="zoom-in" data-aos-delay="400">
                            <div class="department-header">
                                <div class="department-icon">
                                    <i class="bi {{ $specialty->icon }}"></i>
                                </div>
                                <h3>{{ $specialty->name }}</h3>
                                <p class="department-subtitle">{{ $specialty->subtitle }}</p>
                            </div>
                            <div class="department-image-wrapper">
                                <img src="{{ asset('storage/' . $specialty->image) }}" alt="{{ $specialty->name }}" class="img-fluid"
                                    loading="lazy">
                                @if($specialty->procedures_count && $specialty->procedures_label )
                                <div class="department-stats">
                                    <div class="stat-item">
                                        <span class="stat-number">+{{ $specialty->procedures_count }}</span>
                                        <span class="stat-label">{{ $specialty->procedures_label }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="department-content">
                                <p>{{ $specialty->description }}</p>
                                <ul class="department-highlights">
                                    @foreach ($specialty->features as $feature)
                                        <li><i class="bi bi-check2"></i> {{ $feature->title }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('front.departments.show', $specialty->slug) }}" class="department-link">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Departments Section -->

    </main>
@endsection
