@extends('layouts.frontLayout')

@section('content')
    <main class="main clinic-appointments-page">

        <div class="page-title shadow-sm">
            <div class="container">
                <div class="title-wrapper">
                    <h1>Your Health Journey</h1>
                    <p>Track your upcoming visits and medical history with our specialists at MediTrust Clinic.</p>
                </div>
            </div>
        </div>

        <section id="appointments" class="appointments section py-5">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4">
                    @forelse ($appointments as $appointment)
                        <div class="col-lg-6">
                            <div class="appointment-card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="doctor-avatar me-3">
                                            @if ($appointment->doctor->photo)
                                                <img src="{{ asset('storage/' . $appointment->doctor->photo) }}"
                                                    class="rounded-circle img-fluid shadow-sm" alt="Doctor">
                                            @else
                                                <div class="avatar-placeholder rounded-circle"><i
                                                        class="bi bi-person-fill"></i></div>
                                            @endif
                                        </div>
                                        <div class="appointment-header-info">
                                            <h5 class="doctor-name mb-0">Dr. {{ $appointment->doctor->name }}</h5>
                                            <span
                                                class="specialty-text">{{ $appointment->doctor->specialty->name ?? 'General Specialist' }}</span>
                                        </div>
                                        <div class="ms-auto">
                                            <span class="status-badge status-{{ strtolower($appointment->status) }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="appointment-details">
                                        <div class="detail-item">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, d M Y') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <i class="bi bi-clock me-2"></i>
                                            <span>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
                                        </div>
                                        @if ($appointment->reason)
                                            <div class="detail-item reason-item">
                                                <i class="bi bi-chat-left-text me-2"></i>
                                                <span>{{ $appointment->reason }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-footer-actions mt-4 pt-3 border-top d-flex gap-2">
                                        @if ($appointment->status == 'Upcoming')
                                            <button class="btn btn-cancel-appointment btn-sm rounded-pill px-4">Cancel
                                                Visit</button>
                                        @endif
                                        <a href="{{ route('front.appointments.show', $appointment->id) }}"
                                            class="btn btn-details btn-sm rounded-pill px-4">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-calendar-x fs-1 text-muted"></i>
                                <h4 class="mt-3">No Appointments Found</h4>
                                <p>You haven't booked any visits yet.</p>
                                <a href="{{ route('front.appointments.index') }}"
                                    class="btn btn-primary rounded-pill mt-2 px-4">Book Now</a>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>

    </main>
@endsection
