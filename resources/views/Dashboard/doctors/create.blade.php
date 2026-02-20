@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Add Doctor</h4>
                            <p class="card-subtitle card-subtitle-dash">Add profile and clinic information</p>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ route('doctors.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="icon-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div style="z-index: 999;" class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{ route('doctors.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="fw-bold small">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small" style="color:black">Specialty</label>
                                        <select name="specialty_id" class="form-select" style="color:black">
                                            @foreach ($specialties as $specialty)
                                                <option @selected(old('specialty_id') == $specialty->id) value="{{ $specialty->id }}">
                                                    {{ $specialty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Status</label>
                                        <select style="color:black" name="status" class="form-select">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                            <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>
                                                On Leave</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Years of Experience</label>
                                        <input type="number" name="years_experience" class="form-control"
                                            value="{{ old('years_experience') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Consultation Fee (EGP)</label>
                                        <input type="number" name="consultation_fee" class="form-control"
                                            value="{{ old('consultation_fee') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="fw-bold small">Doctor Bio</label>
                                    <textarea name="bio" class="form-control" rows="5">{{ old('bio') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4 border-start">
                                <div class="text-center p-3">
                                    <label class="fw-bold small d-block mb-3">Profile Photo</label>
                                    <div class="mb-3">
                                        <img src="https://ui-avatars.com/api/?name=Doctor-Photo&background=random&size=150"
                                            alt="Doctor Photo" class="img-thumbnail rounded-circle mb-3"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="file" name="photo" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="mt-4 px-3">
                                    <label class="fw-bold small">Doctor Rating</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning border-0 text-white">
                                            <i class="mdi mdi-star"></i>
                                        </span>
                                        <input type="number" name="rating" class="form-control" step="0.1"
                                            min="1" max="5" value="{{ old('rating') }}"
                                            placeholder="1.0 - 5.0">
                                    </div>
                                    <small class="text-muted mt-1 d-block">Enter a value between 1.0 and 5.0</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-top pt-4 text-end">
                            <button type="reset" class="btn btn-light me-2">Reset</button>
                            <button type="submit" class="btn btn-primary text-white px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
