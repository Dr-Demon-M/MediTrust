@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin">
            <div class="card patient-details-card m-1">
                <div class="card-body">
                    {{-- Header مع أزرار التحكم --}}
                    <div class="row mb-4 patient-stats">

                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon bg-primary">
                                    <i class="mdi mdi-calendar-clock"></i>
                                </div>
                                <div>
                                    <h4>{{ $patient->appointments->count() }}</h4>
                                    <p>Total Appointments</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon bg-success">
                                    <i class="mdi mdi-calendar-check"></i>
                                </div>
                                <div>
                                    <h4>
                                        {{ optional($patient->appointments()->latest('appointment_datetime')->first())->appointment_datetime
                                            ? \Carbon\Carbon::parse(
                                                $patient->appointments()->latest('appointment_datetime')->first()->appointment_datetime,
                                            )->format('d M Y')
                                            : 'No visits' }}
                                    </h4>
                                    <p>Last Visit</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-icon bg-warning">
                                    <i class="mdi mdi-calendar-arrow-right"></i>
                                </div>
                                <div>
                                    <h4>
                                        {{ optional(
                                            $patient->appointments()->where('appointment_datetime', '>', now())->orderBy('appointment_datetime')->first(),
                                        )->appointment_datetime
                                            ? \Carbon\Carbon::parse(
                                                $patient->appointments()->where('appointment_datetime', '>', now())->orderBy('appointment_datetime')->first()->appointment_datetime,
                                            )->format('d M Y')
                                            : 'None' }}
                                    </h4>
                                    <p>Next Appointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center">
                            <div class="profile-image-wrapper me-4">
                                <img src="{{ $patient->imageUrl }}" class="img-xl rounded-circle shadow-sm"
                                    alt="Patient Image">
                            </div>
                            <div>
                                <h3 class="mb-1 text-dark fw-bold">{{ $patient->name }}</h3>
                                <p class="text-muted mb-0"><i class="mdi mdi-fingerprint me-1"></i>Patient ID:
                                    #PAT-{{ $patient->id }}</p>
                                <span class="badge badge-opacity-success mt-2">Active Record</span>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="mdi mdi-pencil me-1"></i> Edit Profile
                            </a>
                            <a href="{{ route('patients.index') }}" class="btn btn-light btn-sm ms-2">
                                <i class="mdi mdi-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4 border-end">
                            <h5 class="text-primary mb-3"><i class="mdi mdi-account-card-details me-2"></i>Personal Info
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Email Address</label>
                                    <span class="fw-bold">{{ $patient->email }}</span>
                                    @if ($patient->email_verified_at)
                                        <i class="mdi mdi-check-decagram text-success small"></i>
                                    @endif
                                </li>
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Phone Number</label>
                                    <span class="fw-bold">{{ $patient->phone }}</span>
                                </li>
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Age / Date of Birth</label>
                                    <span class="fw-bold">{{ $patient->age }} Years
                                        ({{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }})</span>
                                </li>
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Gender</label>
                                    <span class="fw-bold">{{ ucfirst($patient->gender) }}</span>
                                </li>
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Blood Group</label>
                                    <span class="badge bg-danger px-3">{{ $patient->blood_group ?? 'Not Defined' }}</span>
                                </li>
                                <li class="mb-3">
                                    <label class="text-muted d-block small">Full Address</label>
                                    <span class="fw-bold text-wrap">{{ $patient->address ?? 'No address provided' }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-8 ps-md-4">
                            <h5 class="text-primary mb-3"><i class="mdi mdi-medical-bag me-2"></i>Medical Record</h5>
                            <div class="medical-history-box p-3 bg-light rounded mb-4">
                                <label class="fw-bold text-dark mb-2">Medical History & Notes:</label>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @forelse($patient->medical_history as $item)
                                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                            <i class="bi bi-clipboard2-pulse me-1"></i> {{ $item }}
                                        </span>
                                    @empty
                                        <span class="text-muted">
                                            No medical history recorded for this patient.
                                        </span>
                                    @endforelse
                                </div>
                            </div>
                            <h5 class="text-primary mb-3"><i class="mdi mdi-attachment me-2"></i>Patient Attachments
                                (X-rays, Reports)</h5>
                            <div class="attachments-grid row g-3">
                                @if ($patient->attachments && count($patient->attachments) > 0)
                                    @foreach ($patient->attachments as $file)
                                        <div class="col-sm-3">
                                            <div class="attachment-card">
                                                <img src="{{ asset('storage/' . $file) }}" class="attachment-img"
                                                    onclick="openImage('{{ asset('storage/' . $file) }}')">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="text-center py-4 bg-light rounded border-dashed">
                                            <i class="mdi mdi-folder-open-outline text-muted fs-2"></i>
                                            <p class="text-muted">No attachments uploaded yet</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="imageModal" class="image-modal">
        <span class="close-modal" onclick="closeImage()">&times;</span>
        <img id="modalImage">
    </div>
    <script>
        function openImage(src) {
            document.getElementById("imageModal").style.display = "flex"
            document.getElementById("modalImage").src = src
        }

        function closeImage() {
            document.getElementById("imageModal").style.display = "none"
        }
    </script>
@endsection
