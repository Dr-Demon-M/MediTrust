@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container ">
        <div class="col-12 m-1">
            <div class="card doctor-profile-card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center">
                            <div class="profile-img-wrapper me-4">
                                <img src="{{ $doctor->imageUrl }}" alt="Doctor" class="rounded-circle shadow-sm">
                                <span class="status-indicator bg-success"></span>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1">Dr. {{ $doctor->name }}</h3>
                                <p class="text-primary fw-medium mb-1"><i class="mdi mdi-medal me-1"></i> Consultant
                                    - {{ $doctor->specialty->name }}</p>
                                <div class="d-flex align-items-center">
                                    <div class="rating-stars me-2">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="mdi mdi-star text-warning"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="mdi mdi-star-half text-warning"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="mdi mdi-star-outline text-warning"></i>
                                        @endfor
                                    </div>
                                    <span class="text-muted small">
                                        ({{ $doctor->rating }} Rating from {{ $patients }} Patients)
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="action-btns mt-3 mt-md-0">
                                <a href="{{ route('doctors.edit', $doctor->slug) }}" class="btn btn-outline-primary me-2"><i
                                        class="mdi mdi-pencil"></i> Edit
                                    Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Professional Information</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Experience:</span>
                                    <span class="fw-bold">{{ $doctor->years_experience }} Years</span>
                                </li>
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Consultation Fee:</span>
                                    <span class="fw-bold text-success">{{ (int) $doctor->consultation_fee }} EGP</span>
                                </li>
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Specialty:</span>
                                    <span class="fw-bold">{{ $doctor->specialty->name }}</span>
                                </li>
                                <li class="mb-0">
                                    <p class="text-muted mb-2">Short Bio:</p>
                                    <p class="small text-dark lh-base ">{{ $doctor->bio ? $doctor->bio : 'No bio yet' }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-2">Total Patients</p>
                                    <h2 class="fw-bold">{{ $patients }}</h2>
                                </div>
                                <i class="mdi mdi-account-group fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card doctor-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Weekly Work Schedule</h4>
                                <a href="{{ route('availability.show', $doctor->slug) }}"
                                    class="btn btn-link btn-sm text-decoration-none">Show Shaduale</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Day</th>
                                            <th>Shift Timing</th>
                                            <th>Status</th>
                                            <th class="text-center">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($doctor->availability->take(5) as $appointment)
                                            <tr>
                                                <td class="fw-bold">{{ $appointment->day }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($appointment->start_time)->addHour()->format('h:i A') }}
                                                </td>
                                                <td>{{ $appointment->status }}</td>
                                                <td><span class="text-center font-weight-light">"
                                                        {{ $appointment->notes ? $appointment->notes : 'No Notes for this patient' }}
                                                        "</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No availability schedule
                                                    set</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <h4 class="card-title">Recent Activity</h4>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <small>Last consultation completed</small>
                                        <span
                                            class="text-muted small">{{ $lastConsultation ? $lastConsultation->appointment_datetime->diffForHumans() : 'No consultations yet' }}</span>
                                    </div>
                                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <small>Profile details updated by Admin</small>
                                        <span class="text-muted small">{{ $doctor->updated_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
