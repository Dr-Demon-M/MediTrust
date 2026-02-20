@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Manage Doctors</h4>
                            <p class="card-subtitle card-subtitle-dash">Total registered doctors: {{ $doctors->count() }}</p>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ route('doctors.create') }}" class="btn btn-primary text-white me-0"><i
                                    class="icon-plus"></i> Add New Doctor</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Department & Specialty</th>
                                    <th>Experience</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ $doctor->imageUrl }}" class="img-md-custom rounded-circle me-3"
                                                    alt="">
                                                <div>
                                                    <h6>Dr. {{ $doctor->name }}</h6>
                                                    <p class="text-muted">ID: #USR-{{ $doctor->id }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $doctor->specialty->name  ?? 'Not Assigned' }}</h6>
                                            <p class="text-muted">{{ $doctor->department ?? 'No Department Assigned' }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-bold">{{ $doctor->years_experience }} Years</p>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-star text-warning me-1"></i>
                                                <span class="fw-bold">{{ $doctor->rating }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-opacity-{{ $doctor->badge() }}">{{ $doctor->status }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('doctors.show', $doctor->slug) }}"
                                                    class="btn btn-light btn-sm me-2"><i class="mdi mdi-eye"></i></a>
                                                <a style="margin-right:8px" href="{{ route('doctors.edit', $doctor->slug) }}" class="btn btn-light btn-sm text-primary"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <form action="{{ route('doctors.destroy', $doctor->slug) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this doctor?');">
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
