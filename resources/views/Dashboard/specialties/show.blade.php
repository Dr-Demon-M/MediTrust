@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12">
            <div class="card specialty-detail-card mb-4 overflow-hidden">
                <div class="row g-0">
                    @if($specialty->image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $specialty->image) }}" class="img-fluid h-100 object-fit-cover" alt="{{ $specialty->name }}" style="min-height: 200px;">
                        </div>
                    @endif
                    <div class="{{ $specialty->image ? 'col-md-9' : 'col-12' }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box-lg bg-opacity-10 text-primary me-3">
                                        <i class="mdi {{ $specialty->icon ?? 'mdi-hospital-building' }}" style="font-size: xx-large;"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold mb-1">{{ $specialty->name }} Unit</h3>
                                        <p class="text-primary fw-medium mb-1">{{ $specialty->subtitle }}</p>
                                        <p class="text-muted small mb-0"><i class="mdi mdi-link-variant"></i> slug: {{ $specialty->slug }}</p>
                                    </div>
                                </div>
                                <div class="mt-2 mt-sm-0">
                                    <span class="badge {{ $specialty->is_active ? 'badge-success' : 'badge-danger' }} me-2">
                                        {{ $specialty->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <a href="{{ route('specialties.edit', $specialty->slug) }}" class="btn btn-outline-secondary btn-sm me-1">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('specialties.new-appointment', $specialty->slug) }}" class="btn btn-primary text-white btn-sm">
                                        <i class="mdi mdi-plus"></i> New Appointment
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <p class="card-text">{{ $specialty->description ?? 'No description available for this clinic department.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-primary me-3"><i class="mdi mdi-account-group text-primary"></i></div>
                            <div>
                                <p class="text-muted small mb-0">Clinic Doctors</p>
                                <h4 class="fw-bold mb-0">{{ $specialty->doctors->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-info me-3"><i class="mdi mdi-clipboard-pulse text-info"></i></div>
                            <div>
                                <p class="text-muted small mb-0">{{ $specialty->procedures_label ?? 'Procedures' }}</p>
                                <h4 class="fw-bold mb-0">{{ number_format($specialty->procedures_count) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-success me-3"><i class="mdi mdi-calendar-check text-success"></i></div>
                            <div>
                                <p class="text-muted small mb-0">Today's Slots</p>
                                <h4 class="fw-bold mb-0">{{ $availabilities }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mini-stats-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="circle-icon bg-light-warning me-3"><i class="mdi mdi-clock-fast text-warning"></i></div>
                            <div>
                                <p class="text-muted small mb-0">Avg. Wait Time</p>
                                <h4 class="fw-bold mb-0">{{ $avgWaitTime }} min</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card doctor-card h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Available Doctors in {{ $specialty->name }}</h4>
                            <div class="table-responsive">
                                <table class="table select-table">
                                    <thead>
                                        <tr>
                                            <th>Doctor</th>
                                            <th>Fee</th>
                                            <th>Schedule</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specialty->doctors as $doctor)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $doctor->imageUrl }}" class="img-md-custom rounded-circle me-3" alt="">
                                                        <div>
                                                            <h6 class="mb-0">Dr. {{ $doctor->name }}</h6>
                                                            <small class="text-muted">Specialist</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="fw-bold text-dark">{{ $doctor->consultation_fee }} EGP</span></td>
                                                <td><span class="badge badge-outline-primary small">View availability</span></td>
                                                <td>
                                                    <div class="badge badge-opacity-{{ $doctor->badge() }}">{{ $doctor->status }}</div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('availability.show', $doctor->slug) }}" class="btn btn-outline-primary btn-sm">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Department Features</h4>
                            <ul class="list-unstyled">
                                @php
                                    $features = is_array($specialty->features) ? $specialty->features : json_decode($specialty->features, true) ?? [];
                                @endphp
                                @forelse($features as $feature)
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-check-circle text-success me-2"></i>
                                        <span>{{ $feature['title'] }}</span>
                                    </li>
                                @empty
                                    <li class="text-muted small">No specific features listed for this unit.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection