@extends('layouts.frontLayout')

@section('content')
<main class="main clinic-details-page">
    <div class="page-title shadow-sm mb-5">
        <div class="container text-center">
            <h1>Appointment Details</h1>
            <p>Full information about your scheduled visit to MediTrust Clinic</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="medical-ticket shadow-lg">
                    <div class="ticket-header d-flex justify-content-between align-items-center">
                        <div class="clinic-logo-side">
                            <h2 class="mb-0">MediTrust</h2>
                            <span>Official Medical Record</span>
                        </div>
                        <div class="ticket-status-badge {{ strtolower($appointment->status) }}">
                            {{ $appointment->status }}
                        </div>
                    </div>

                    <div class="ticket-body p-4 p-md-5">
                        <div class="row gy-4">
                            <div class="col-md-6 border-end-md">
                                <h5 class="section-label">Doctor Information</h5>
                                <div class="d-flex align-items-center mt-3">
                                    <div class="doctor-photo-frame">
                                        <img src="{{ asset('storage/' . $appointment->doctor->photo) }}" alt="Doctor">
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0">Dr. {{ $appointment->doctor->name }}</h4>
                                        <p class="text-primary mb-0">{{ $appointment->doctor->specialty->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-4">
                                <h5 class="section-label">Schedule Info</h5>
                                <div class="schedule-info mt-3">
                                    <div class="info-row">
                                        <i class="bi bi-calendar-check-fill"></i>
                                        <div>
                                            <span class="d-block label">Date</span>
                                            <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('l, d F Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="info-row mt-3">
                                        <i class="bi bi-clock-fill"></i>
                                        <div>
                                            <span class="d-block label">Time </span>
                                            <span class="value">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="reason-box p-3 rounded">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i>Reason for Visit:</h6>
                                    <p class="mb-0">{{ $appointment->specialty->name }} - {{ $appointment->service->name }}</p>
                                    <p class="mb-0">{{ $appointment->patient_note ?? 'No additional notes provided.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ticket-footer d-flex justify-content-between align-items-center p-4">
                        <div class="qr-placeholder d-none d-md-block">
                            <i class="bi bi-qr-code-scan fs-1 opacity-25"></i>
                        </div>
                        <div class="actions d-flex gap-2">
                            @if($appointment->status !== 'cancelled')
                                <form action="{{ route('front.appointments.update', $appointment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this clinic appointment?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-cancel">
                                        <i class="bi bi-x-circle me-2"></i>Cancel Appointment
                                    </button>
                                </form>
                            @endif
                            
                            <a href="{{ route('front.appointments.index') }}" class="btn btn-back">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection