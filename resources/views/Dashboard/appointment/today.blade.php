@extends('layouts.dashboardLayout')

@section('content')

    <div class="container-fluid p-0">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stat-card p-3 shadow-sm bg-white border-0" style="border-radius: 12px;">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-primary text-primary me-3">
                            <i class="mdi mdi-account-group"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Total Today</p>
                            <h5 class="fw-bold mb-0">{{ $todayAppointments->count() }} Patients</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-3 shadow-sm bg-white border-0" style="border-radius: 12px;">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-success text-success me-3">
                            <i class="mdi mdi-check-all"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Completed</p>
                            <h5 class="fw-bold mb-0">{{ $completedAppointments->count() }} Patients</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card p-3 shadow-sm bg-white border-0" style="border-radius: 12px;">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-warning text-warning me-3">
                            <i class="mdi mdi-clock-fast"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Waiting</p>
                            <h5 class="fw-bold mb-0">{{ $pendingAppointments->count() }} Patients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 m-1" style="border-radius: 15px; min-height: 70vh;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold text-dark mb-1">Today's Schedule</h4>
                        <p class="text-muted small mb-0">{{ today()->format('l, d M Y') }}</p>
                    </div>
                    <div class="search-box">
                        <form action="{{ route('appointments.today') }}" method="GET">
                            <input type="text" name="search" class="form-control form-control-sm rounded-pill px-3"
                                placeholder="Search patient name...">
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle custom-today-table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Patient</th>
                                <th>Specialty</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($confirmedAppointments as $appointment)
                                <tr class="current-row">
                                    <td class="fw-bold text-primary">{{ $appointment->appointment_datetime->format('g:i A') }}
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $appointment->patient_name }}</div>
                                        <small class="text-muted">{{ $appointment->patient_phone }}</small>
                                    </td>
                                    <td><span class="badge-specialty">{{ $appointment->specialty->name }}</span></td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td><span class="status-dot bg-warning"></span> {{ $appointment->status }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('appointments.show', $appointment->id) }}"
                                            class="btn btn-show-sm btn-info me-1">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                        <a href="{{ route('appointment.completed', $appointment->id) }}"
                                            class="btn btn-complete-sm btn-success me-1" title="Complete Appointment">
                                            <i class="mdi mdi-check"></i>
                                        </a>
                                        <a href="{{ route('appointment.canceled', $appointment->id) }}"
                                            class="btn btn-cancel-sm btn-danger" title="Cancel Appointment">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="no-appointments-state">
                                            <i class="mdi mdi-calendar-blank mdi-48px text-muted"></i>
                                            <h5 class="mt-3 fw-light text-muted">No appointments scheduled for today.</h5>
                                            <p class="small text-muted">New bookings will appear here once they are created.
                                            </p>
                                            <a href="{{ route('appointments.create') }}"
                                                class="btn btn-primary btn-sm mt-2">
                                                <i class="mdi mdi-plus me-1"></i> Book Now
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
