@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card m-1 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="card-title card-title-dash">Edit Patient Profile</h4>
                            <p class="card-subtitle card-subtitle-dash">Update information for:
                                <strong>{{ $patient->name }}</strong>
                            </p>
                        </div>
                        <a href="{{ route('patients.index') }}" class="btn btn-light btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <form action="{{ route('patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- القسم الأول: البيانات الشخصية --}}
                            <div class="col-md-6 border-end">
                                <p class="card-description text-primary fw-bold"><i class="mdi mdi-account me-1"></i>
                                    Personal Information</p>

                                <div class="form-group mb-3">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ old('name', $patient->name) }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="{{ old('email', $patient->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" id="phone"
                                                value="{{ old('phone', $patient->phone) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" class="form-control" id="age"
                                                value="{{ old('age', $patient->age) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-3">
                                            <label for="date_of_birth">Date of Birth</label>
                                            <input type="date" name="date_of_birth" class="form-control"
                                                id="date_of_birth"
                                                value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-select form-control" id="gender">
                                                <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="blood_group">Blood Group</label>
                                            <select name="blood_group" class="form-select form-control" id="blood_group">
                                                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                                    <option value="{{ $group }}"
                                                        {{ $patient->blood_group == $group ? 'selected' : '' }}>
                                                        {{ $group }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="address">Full Address</label>
                                    <textarea name="address" class="form-control" id="address" rows="2">{{ old('address', $patient->address) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 ps-md-4">
                                <p class="card-description text-primary fw-bold"><i class="mdi mdi-medical-bag me-1"></i>
                                    Medical Records & Media</p>
                                <div class="form-group mb-3">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control" id="profile_image">
                                    @if ($patient->profile_image)
                                        <div class="mt-2">
                                            <img src="{{ $patient->image_url }}" width="80" class="rounded border">
                                            <small class="text-muted ms-2">Current Image</small>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <label for="medical_history" class="d-flex justify-content-between">
                                        Medical History / Chronic Diseases
                                        <small class="text-muted">Use commas to separate diseases</small>
                                    </label>
                                    <textarea name="medical_history" class="form-control clinical-textarea" id="medical_history" rows="6"
                                        placeholder="Example: Diabetes, Hypertension, Asthma...">{{ old(
                                            'medical_history',
                                            is_array($patient->medical_history)
                                                ? implode(', ', $patient->medical_history)
                                                : str_replace(['[', ']', '"'], '', $patient->medical_history),
                                        ) }}</textarea>
                                </div>

                                @if ($patient->attachments)
                                    <div class="mb-3">
                                        <label class="fw-bold mb-1">Existing Attachments</label>
                                        <div class="row g-3">
                                            @foreach ($patient->attachments as $file)
                                                <div class="col-md-2" id="file-{{ md5($file) }}">
                                                    <div class="attachment-card">
                                                        <img src="{{ asset('storage/' . $file) }}"
                                                            class="attachment-img">
                                                        <button type="button" class="delete-btn"
                                                            data-file="{{ $file }}"
                                                            data-id="{{ md5($file) }}">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif


                                <div class=" col-md-6 form-group mb-3">
                                    <label>Upload New Attachments (Reports/X-rays)</label>
                                    <input type="file" name="attachments[]" class="form-control" multiple>
                                    <small class="text-info">
                                        <i class="mdi mdi-information-outline"></i>
                                        You can select multiple files.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-top pt-3 text-end">
                            <button type="submit" class="btn btn-primary me-2 text-white">
                                <i class="mdi mdi-content-save me-1"></i> Save Changes
                            </button>
                            <button type="reset" class="btn btn-light">Reset Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.querySelectorAll(".delete-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    let file = this.dataset.file
                    let id = this.dataset.id
                    if (!confirm("Delete this file?")) return
                    fetch("{{ route('front.patients.deleteAttachment') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                patient_id: {{ $patient->id }},
                                file: file
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById("file-" + id).remove()
                            }

                        })

                })

            })
        </script>
    @endsection
