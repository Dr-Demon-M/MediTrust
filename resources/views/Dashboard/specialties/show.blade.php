@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12">
            <div class="card specialty-detail-card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon-box-lg bg-opacity-10 text-primary me-3">
                                <i class="mdi mdi-heart-pulse" style="font-size: xx-large;"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1">{{ $specialty->name }} Unit</h3>
                                <p class="text-muted mb-0">Clinic Specialists & Patient Appointments</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('specialties.new-appointment', $specialty->slug) }}" class="btn btn-primary text-white btn-sm"><i class="mdi mdi-plus"></i> New
                                Appointment</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-primary me-3"><i
                                    class="mdi mdi-account-group text-primary"></i></div>
                            <div>
                                <p class="text-muted small mb-0">Clinic Doctors</p>
                                <h4 class="fw-bold mb-0">{{ $specialty->doctors->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-success me-3"><i
                                    class="mdi mdi-calendar-check text-success"></i></div>
                            <div>
                                <p class="text-muted small mb-0">Today's Bookings</p>
                                <h4 class="fw-bold mb-0">{{ $availabilities }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-warning me-3"><i class="mdi mdi-clock-fast text-warning"></i>
                            </div>
                            <div>
                                <p class="text-muted small mb-0">Avg. Wait Time</p>
                                <h4 class="fw-bold mb-0">{{ $avgWaitTime }} min</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card doctor-card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Available Doctors in Cardiology</h4>
                    <div class="table-responsive">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Consultation Fee</th>
                                    <th>Schedule Today</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specialty->doctors as $doctor)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $doctor->imageUrl }}"
                                                    class="img-md-custom rounded-circle me-3" alt="">
                                                <div>
                                                    <h6 class="mb-0">Dr. {{ $doctor->name }}</h6>
                                                    <small class="text-muted">Consultant</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="fw-bold text-dark">{{ $doctor->consultation_fee }} EGP</span></td>
                                        <td><span class="badge badge-outline-primary">05:00 PM - 09:00 PM</span></td>
                                        <td>
                                            <div class="badge badge-opacity-{{ $doctor->badge() }}">{{ $doctor->status }}</div>
                                        </td>
                                        <td>
                                            <a href="{{ route('availability-schedule.show', $doctor->slug) }}" class="btn btn-outline-primary btn-sm">View Schedule</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
