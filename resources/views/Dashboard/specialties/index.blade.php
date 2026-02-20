@extends('layouts.dashboardLayout')

@section('content')
<div class="row full-width-container">
    <div class="col-12 grid-margin stretch-card">
        <div class="card doctor-card m-1">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="card-title card-title-dash">Medical Specialties</h4>
                        <p class="card-subtitle card-subtitle-dash">Manage hospital departments and medical fields</p>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{{ route('specialties.create') }}" class="btn btn-primary text-white me-0"><i class="icon-plus"></i> Add New Specialty</a>
                    </div>
                </div>

                <div class="row">
                    @foreach($specialties as $spec)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="specialty-item-card border p-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="icon-box-rounded {{ $spec->specialtyColors() }} bg-opacity-10 me-3">
                                    <i class="mdi {{ $spec->icon }} fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $spec->name }}</h5>
                                    <p class="text-muted mb-0">{{ $spec->doctors->count() }} Doctors</p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-dots-vertical fs-5"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('specialties.edit',$spec->slug) }}"><i class="mdi mdi-pencil me-2"></i>Edit</a></li>
                                    <li><a class="dropdown-item" href="{{ route('specialties.show', $spec->slug) }}"><i class="mdi mdi-eye-outline me-2"></i>Show</a></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="mdi mdi-delete me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection