@extends('layouts.dashboardLayout')
@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card doctor-card m-1 ">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Availability Schedule</h4>
                            <p class="card-subtitle card-subtitle-dash">Weekly working hours for doctors</p>
                        </div>
                        <div class="btn-wrapper">
                            <button class="btn btn-outline-primary" onclick="window.print()">
                                <i class="icon-printer"></i> Print Schedule
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <form method="GET" action="{{ route('availability-schedule.index') }}">
                                <select name="specialty" style="color: black;" class="form-select shadow-none" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}"
                                            {{ request('specialty') == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Specialty</th>
                                    <th>Working Hours</th>
                                    <th>Max Capacity</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctors as $doctor)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ $doctor->imageUrl }}" class="img-md-custom rounded-circle me-3"
                                                    alt="">
                                                <div>
                                                    <h6>{{ $doctor->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-bold text-dark">{{ $doctor->specialty->name }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-clock-outline me-1 text-primary"></i>
                                                <span>09:00 AM - 02:00 PM</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress progress-md" style="height: 8px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ ($doctor->availability()->where('status', 'Occupied')->count() / 42) * 100 }}%"
                                                    aria-valuenow="{{ $doctor->availability()->where('status', 'Occupied')->count() }}"
                                                    aria-valuemin="0" aria-valuemax="42"></div>
                                            </div>
                                            <small
                                                class="text-muted mt-1">{{ $doctor->availability()->where('status', 'Occupied')->count() }}</small>
                                        </td>
                                        <td>
                                            @if ($doctor->status == 'active')
                                                <div class="badge badge-opacity-success">Available</div>
                                            @else
                                                <div class="badge badge-opacity-danger">Full / Busy</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('availability-schedule.show', $doctor->slug) }}"
                                                    class="btn btn-light btn-sm me-2 text-primary">
                                                    <i class="mdi mdi-eye"></i> View Schedule
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <br>
                                                <br>
                                                <i class="mdi mdi-account-search-outline text-muted"
                                                    style="font-size: 48px; opacity: 1;"></i>
                                                <h5 class="mt-3 text-dark fw-semibold">
                                                    No Doctors Found
                                                </h5>
                                                <p class="text-muted mb-0" style="opacity: 1;">
                                                    There are no doctors available for the selected specialty.
                                                </p>
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
    </div>
    <script>
        document.getElementById('specialtyFilter').addEventListener('change', function() {
            let specialtyId = this.value;
            fetch(`/doctors?specialty=${specialtyId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('doctorsContainer').innerHTML = html;
                });
        });
    </script>
@endsection
