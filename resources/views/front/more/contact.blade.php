@extends('layouts.frontLayout')

@section('content')
    {{-- تظهر هذه الرسائل فوراً بفضل الـ Queue --}}
    @if (session('success'))
        <div class="alert alert-custom alert-success-clinic animate__animated animate__fadeIn">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-custom alert-error-clinic animate__animated animate__shakeX">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        </div>
    @endif

    {{-- عرض أخطاء الـ Validation --}}
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm" style="border-radius: 15px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="contact-page-wrapper">
        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs" style="padding-bottom: 80px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <div class="container mt-n5">
            <div class="row g-4 justify-content-center">
                {{-- Contact Info Cards --}}
                <div class="col-md-4">
                    <div class="card contact-info-card border-0 shadow-sm p-4 text-center">
                        <div class="icon-circle mb-3 mx-auto">
                            <i class="bi bi-telephone-plus" style="color: #049ebb;"></i>
                        </div>
                        <h5 class="fw-bold">Emergency Call</h5>
                        <a href="tel:+201001234567" class="text-muted mb-0">+20 100 123 4567</a>
                        <p class="text-muted small">Available 24/7 for urgent cases</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card contact-info-card border-0 shadow-sm p-4 text-center">
                        <div class="icon-circle mb-3 mx-auto">
                            <i class="bi bi-envelope-paper" style="color: #049ebb;"></i>
                        </div>
                        <h5 class="fw-bold">Email Us</h5>
                        <a href="mailto:support@meditrust.com" class="text-muted mb-0">support@meditrust.com</a>
                        <p class="text-muted small">Expect a reply within 24 hours</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card contact-info-card border-0 shadow-sm p-4 text-center">
                        <div class="icon-circle mb-3 mx-auto" style="color: #049ebb;">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <h5 class="fw-bold">Clinic Location</h5>
                        <a href="https://maps.google.com/?q=15+Ahmed+Orabi+St,+Dokki,+Giza,+Egypt" class="text-muted mb-0" target="_blank">15 Ahmed Orabi St, Dokki, Giza, Egypt</a>
                        <p class="text-muted small">Open: All Weak (9AM - 2PM)</p>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5 align-items-stretch">
                {{-- Contact Form --}}
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-lg p-4 h-100" style="border-radius: 20px;">
                        <h3 class="fw-bold mb-4 text-dark">Send us a message</h3>
                        <form action="{{ route('front.contact.send') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold">Your Name</label>
                                    <input type="text" name="name" class="form-control custom-input"
                                        placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control custom-input"
                                        placeholder="e.g. +20..." required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Subject</label>
                                <select name="subject" class="form-select custom-input">
                                    <option value="general-inquiry">General Inquiry</option>
                                    <option value="appointment-question">Appointment Question</option>
                                    <option value="feedback-complaint">Feedback / Complaint</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea name="message" class="form-control custom-input" rows="5" placeholder="How can we help you today?"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">
                                <i class="mdi mdi-send me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Google Map --}}
                <div class="col-lg-6 mb-4">
                    <div class="map-container h-100 shadow-lg"
                        style="border-radius: 20px; overflow: hidden; min-height: 400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6824.294754294421!2d31.357060118493653!3d31.21664607089908!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f772276cff3cb9%3A0x145f6f2abae2bfb!2sBelqas%20General%20Hospital!5e0!3m2!1sen!2seg!4v1772843346846!5m2!1sen!2seg"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .alert-custom {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .alert-success-clinic {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error-clinic {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
@endsection
