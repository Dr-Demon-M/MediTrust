@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card patient-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Manage Clinic Patients</h4>
                            <p class="card-subtitle card-subtitle-dash">Total registered patients: {{ $patients->count() }}
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Age & Gender</th>
                                    <th>Contact Info</th>
                                    <th>Blood Group</th>
                                    <th>Last Appointment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ $patient->imageUrl }}"
                                                    class="img-md-custom rounded-circle me-3" alt="patient">
                                                <div>
                                                    <h6>{{ $patient->name }}</h6>
                                                    <p class="text-muted">ID: #PAT-{{ $patient->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $patient->age ? $patient->age . ' Years' : 'N/A' }} </h6>
                                            <p class="text-muted">{{ $patient->gender ? ucfirst($patient->gender) : 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-bold mb-1"><i
                                                    class="mdi mdi-phone me-1 text-primary"></i>{{ $patient->phone }}</p>
                                            <p class="text-muted small">{{ $patient->email }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-water text-danger me-1"></i>
                                                <span class="fw-bold">{{ $patient->blood_group ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="fw-bold mb-1">
                                                {{ $patient->appointments ? \Carbon\Carbon::parse($patient->appointments()->latest()->first()?->appointment_datetime)->format('Y-m-d') : 'N/A' }}
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('patients.show', $patient->id) }}"
                                                    class="btn btn-light btn-sm me-2"><i class="mdi mdi-eye"></i></a>
                                                <a style="margin-right:8px"
                                                    href="{{ route('patients.edit', $patient->id) }}"
                                                    class="btn btn-light btn-sm text-primary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this patient record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light btn-sm text-danger">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
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
