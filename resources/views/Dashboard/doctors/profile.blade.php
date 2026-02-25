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
                                <i class="mdi mdi-account-star me-2"></i>Complete Your Professional Profile
                            </h4>
                            <p class="card-subtitle card-subtitle-dash">
                                Please provide your professional details to start receiving appointments in our clinic.
                            </p>
                        </div>
                        <div class="progress-container" style="width: 200px;">
                            <p class="small mb-1 fw-bold text-muted text-end">Profile Completion: 70%</p>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="mdi mdi-alert-circle me-1"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('doctors.update', $doctor->slug) }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="fw-bold small"><i class="mdi mdi-account me-1 text-primary"></i>Full Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter your full name"
                                        value="{{ old('name', $doctor->name) }}" required>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small"><i class="mdi mdi-stethoscope me-1 text-primary"></i>Primary Specialty</label>
                                        <select style="color:black;" name="specialty_id" class="form-select shadow-sm">
                                            <option value="" disabled {{ is_null($doctor->specialty_id) ? 'selected' : '' }}>Select Specialty</option>
                                            @foreach ($specialties as $specialty)
                                                <option value="{{ $specialty->id }}" @selected(old('specialty_id', $doctor->specialty_id) == $specialty->id)>
                                                    {{ $specialty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small"><i class="mdi mdi-toggle-switch me-1 text-primary"></i>Initial Status</label>
                                        <select style="color:black;" name="status" class="form-select shadow-sm">
                                            <option value="active" @selected(old('status', $doctor->status) == 'active')>Active (Ready to work)</option>
                                            <option value="inactive" @selected(old('status', $doctor->status) == 'inactive')>Inactive (Offline)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small"><i class="mdi mdi-briefcase-check me-1 text-primary"></i>Years of Experience</label>
                                        <input type="number" name="years_experience" class="form-control"
                                            placeholder="e.g. 10"
                                            value="{{ old('years_experience', $doctor->years_experience) }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="fw-bold small"><i class="mdi mdi-cash-multiple me-1 text-primary"></i>Consultation Fee (EGP)</label>
                                        <input type="number" name="consultation_fee" class="form-control"
                                            placeholder="e.g. 300"
                                            value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="fw-bold small"><i class="mdi mdi-text-subject me-1 text-primary"></i>Professional Bio</label>
                                    <textarea name="bio" class="form-control" rows="6" 
                                              placeholder="Briefly describe your medical background and achievements...">{{ old('bio', $doctor->bio) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4 border-start">
                                <div class="text-center p-3">
                                    <label class="fw-bold small d-block mb-3">
                                        Upload Professional Photo
                                    </label>
                                    <div class="image-preview-wrapper mb-3">
                                        @if ($doctor->photo)
                                            <img src="{{ asset('storage/' . $doctor->photo) }}"
                                                id="photo-preview"
                                                class="img-thumbnail rounded-circle border-primary"
                                                style="width:160px;height:160px;object-fit:cover; border-width: 3px;">
                                        @else
                                            <img src="{{ asset('images/doctors/default-doctor.png') }}"
                                                id="photo-preview"
                                                class="img-thumbnail rounded-circle border-dashed"
                                                style="width:160px;height:160px;object-fit:cover;">
                                        @endif
                                    </div>
                                    <input type="file" name="photo" class="form-control form-control-sm shadow-sm" id="photo-input">
                                    <small class="text-muted d-block mt-2">Recommended: 400x400px</small>
                                </div>

                                <div class="mt-4 px-3 p-3 bg-light rounded" style="border: 1px dashed #ccc;">
                                    <label class="fw-bold small"><i class="mdi mdi-star text-warning me-1"></i>Internal Rating</label>
                                    <div class="input-group">
                                        <input type="number" name="rating" class="form-control" step="0.1"
                                            min="1" max="5" value="{{ old('rating', $doctor->rating ?? 5.0) }}">
                                        <span class="input-group-text bg-white">/ 5.0</span>
                                    </div>
                                    <small class="text-muted mt-1 d-block italic">Initial rating based on credentials.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-top pt-4 d-flex justify-content-between align-items-center">
                            <p class="text-muted small mb-0"><i class="mdi mdi-information-outline me-1"></i>You can update these details later from your settings.</p>
                            <div>
                                <button type="reset" class="btn btn-light me-2">Clear</button>
                                <button type="submit" class="btn btn-success text-white px-5 shadow-sm fw-bold">
                                    Finish & Go to Dashboard <i class="mdi mdi-chevron-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection