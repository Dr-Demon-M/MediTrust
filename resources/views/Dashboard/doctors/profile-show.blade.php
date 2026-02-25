@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card doctor-card m-1 shadow-sm" style="border-radius: 15px;">
                <div class="card-body">

                    {{-- Header --}}
                    <div class="d-sm-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                        <div>
                            <h4 class="card-title card-title-dash text-primary">
                                <i class="mdi mdi-account-edit me-2"></i>Account Settings
                            </h4>
                            <p class="card-subtitle card-subtitle-dash">
                                Update your personal information, professional bio, and clinic preferences.
                            </p>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ route('doctors.show', $doctor->slug) }}" class="btn btn-outline-secondary btn-sm">
                                <i class="mdi mdi-eye me-1"></i> View Public Profile
                            </a>
                        </div>
                    </div>

                    {{-- Success/Error Alerts --}}
                    @if (session('success'))
                        <x-alert type="success">{{ session('success') }}</x-alert>
                    @endif

                    <form action="{{ route('doctors.update', $doctor->slug) }}" method="POST"
                        enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- العمود الأيسر: البيانات النصية --}}
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small">Full Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $doctor->name) }}" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Specialty</label>
                                        <select name="specialty_id" class="form-select shadow-sm" style="color:black;">
                                            @foreach ($specialties as $specialty)
                                                <option value="{{ $specialty->id }}" @selected(old('specialty_id', $doctor->specialty_id) == $specialty->id)>
                                                    {{ $specialty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Experience (Years)</label>
                                        <div class="input-group">
                                            <input type="number" name="years_experience" class="form-control"
                                                value="{{ old('years_experience', $doctor->years_experience) }}">
                                            <span class="input-group-text">Years</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Consultation Fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text">EGP</span>
                                            <input type="number" name="consultation_fee" class="form-control"
                                                value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small">Availability Status</label>
                                        <select name="status" class="form-select shadow-sm" style="color:black;">
                                            <option value="active" @selected(old('status', $doctor->status) == 'active')>Active</option>
                                            <option value="inactive" @selected(old('status', $doctor->status) == 'inactive')>Inactive</option>
                                            <option value="on_leave" @selected(old('status', $doctor->status) == 'on_leave')>On Leave</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fw-bold small">About Me / Professional Bio</label>
                                    <textarea name="bio" class="form-control" rows="6">{{ old('bio', $doctor->bio) }}</textarea>
                                    <small class="text-muted">This bio will be visible to patients on your profile
                                        page.</small>
                                </div>
                            </div>

                            {{-- العمود الأيمن: الصورة والتقييم --}}
                            <div class="col-md-4 border-start">
                                <div class="text-center p-3">
                                    <label class="fw-bold small d-block mb-3">Profile Picture</label>
                                    <div class="mb-3 position-relative d-inline-block">
                                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('images/doctors/default-doctor.png') }}"
                                            id="profile-img-preview" class="img-thumbnail rounded-circle"
                                            style="width:160px; height:160px; object-fit:cover; border: 4px solid #f8f9fa;">
                                    </div>
                                    <input type="file" name="photo" class="form-control form-control-sm mt-2"
                                        id="profile-img-input">
                                </div>

                                <div class="mt-4 px-3">
                                    <div class="card bg-light border-0">
                                        <div class="card-body p-3">
                                            <label class="fw-bold small mb-2"><i class="mdi mdi-star text-warning"></i>
                                                Current Rating</label>
                                            <div class="d-flex align-items-center">
                                                <h3 class="mb-0 me-2">{{ number_format($doctor->rating, 1) }}</h3>
                                                <div class="text-warning">
                                                    <i class="mdi mdi-star"></i>
                                                    <i class="mdi mdi-star"></i>
                                                    <i class="mdi mdi-star"></i>
                                                    <i class="mdi mdi-star"></i>
                                                    <i class="mdi mdi-star-half"></i>
                                                </div>
                                            </div>
                                            <input type="hidden" name="rating" value="{{ $doctor->rating }}">
                                            <p class="small text-muted mt-2 mb-0">Based on patient reviews and system
                                                metrics.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-top pt-4 text-end">
                            <button type="button" class="btn btn-light me-2"
                                onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-primary text-white px-5 shadow-sm">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
