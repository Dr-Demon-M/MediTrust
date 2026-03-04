@extends('layouts.frontLayout')

@section('content')
    <main class="main profile-page">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Profile</li>
                    </ol>
                </nav>
            </div>

            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-4 mb-4" data-aos="fade-right">
                        <div class="profile-card text-center p-4 shadow-sm h-100">
                            <div class="profile-avatar-inner text-center">
                                <img id="avatar-preview"
                                    src="{{ Auth::guard('patient')->user()->profile_image ? asset('storage/' . Auth::guard('patient')->user()->profile_image) : asset('storage/patients/default-avatar.png') }}"
                                    alt="Patient" class="rounded-circle border border-4 border-white shadow mb-2"
                                    style="width:128px; height:128px; object-fit:cover;">

                                <form action="{{ route('front.profile.update', Auth::guard('patient')->user()->id) }}"
                                    method="POST" enctype="multipart/form-data" id="avatar-form">
                                    @csrf
                                    @method('PUT')

                                    <label for="avatar-input" class="avatar-edit-btn">
                                        <i class="bi bi-camera-fill"></i>
                                    </label>
                                    <input type="file" name="profile_image" id="avatar-input" class="d-none"
                                        accept="image/*" onchange="previewImage(this)">

                                    <div id="avatar-save-wrapper" class="mt-2" style="display: none;">
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-check2-circle me-1"></i> Save Photo
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm"
                                            onclick="cancelImage()">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <h4 class="fw-bold text-dark mb-1">{{ Auth::guard('patient')->user()->name }}</h4>
                            <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill mb-3">
                                <i class="bi bi-patch-check-fill me-1"></i> Verified Patient
                            </span>

                            <hr class="my-4 opacity-25">

                            <div class="text-start">
                                <p class="small text-muted mb-2"><i
                                        class="bi bi-droplet-fill text-danger me-2"></i><strong>Blood Group:</strong>
                                    {{ Auth::guard('patient')->user()->blood_group ?? 'N/A' }}</p>
                                <p class="small text-muted mb-2"><i
                                        class="bi bi-calendar-check me-2 text-primary"></i><strong>Age:</strong>
                                    {{ Auth::guard('patient')->user()->age }} Years</p>
                                <p class="small text-muted mb-0"><i
                                        class="bi bi-geo-alt-fill me-2 text-success"></i><strong>Address:</strong>
                                    {{ Str::limit(Auth::guard('patient')->user()->address, 25) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="profile-card p-4 shadow-sm mb-4">
                            <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                                <i class="bi bi-person-vcard fs-3 text-primary me-3"></i>
                                <h5 class="fw-bold mb-0">General & Medical Information</h5>
                            </div>

                            <form action="{{ route('front.profile.update', Auth::guard('patient')->user()->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Auth::guard('patient')->user()->name }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Phone Number</label>
                                        <input type="tel" name="phone" class="form-control"
                                            value="{{ Auth::guard('patient')->user()->phone }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Age</label>
                                        <input type="number" name="age" class="form-control"
                                            value="{{ Auth::guard('patient')->user()->age }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Date of Birth</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                            value="{{ Auth::guard('patient')->user()->date_of_birth }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="male"
                                                {{ Auth::guard('patient')->user()->gender == 'male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="female"
                                                {{ Auth::guard('patient')->user()->gender == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Blood Group</label>
                                        <select name="blood_group" class="form-select form-control" id="blood_group">
                                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                                <option value="{{ $group }}"
                                                    {{ Auth::guard('patient')->user()->blood_group == $group ? 'selected' : '' }}>
                                                    {{ $group }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Home Address</label>
                                        <textarea name="address" class="form-control" rows="2">{{ Auth::guard('patient')->user()->address }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Medical History & Conditions</label>
                                        <div class="medical-history-container p-0 border-0">
                                            <div class="input-group mb-3">
                                                <input type="text" id="condition-input"
                                                    class="form-control border-start-0 border-top-0 border-end-0 rounded-0"
                                                    placeholder="Type a condition (e.g. Diabetes) and press Enter">
                                                <button class="btn btn-outline-primary border-0" type="button"
                                                    id="add-condition-btn">
                                                    <i class="bi bi-plus-circle-fill fs-4"></i>
                                                </button>
                                            </div>
                                            <div id="conditions-wrapper" class="d-flex flex-wrap gap-2">
                                            </div>
                                            <input type="hidden" name="medical_history" id="medical-history-json"
                                                value="{{ json_encode(Auth::guard('patient')->user()->medical_history) }}">
                                        </div>
                                    </div>
                                    @if (Auth::guard('patient')->user()->attachments)
                                        <div class="mb-4">
                                            <label class="fw-bold mb-2">Existing Attachments</label>

                                            <div class="attachments-grid">

                                                @foreach (Auth::guard('patient')->user()->attachments as $file)
                                                    <div class="attachment-item" id="file-{{ md5($file) }}">

                                                        <img src="{{ asset('storage/' . $file) }}"
                                                            class="attachment-img">

                                                        <button type="button" class="delete-attachment-btn"
                                                            data-file="{{ $file }}"
                                                            data-id="{{ md5($file) }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <label class="form-label small fw-bold mt-2">Medical Attachments</label>
                                        <input type="file" name="attachments[]" class="form-control" multiple>
                                    </div>
                                    <div class="col-12 text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4 rounded-pill">Update Profile
                                            Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </main>
    <script>
        document.querySelectorAll(".delete-attachment-btn").forEach(btn => {

            btn.addEventListener("click", function() {

                let file = this.dataset.file
                let id = this.dataset.id

                if (!confirm("Delete this attachment?")) return

                fetch("{{ route('patients.deleteAttachment') }}", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },

                        body: JSON.stringify({
                            patient_id: {{ Auth::guard('patient')->user()->id }},
                            file: file
                        })

                    })
                    .then(res => res.json())
                    .then(data => {

                        console.log(data)

                        if (data.success) {

                            document.getElementById("file-" + id).remove()

                        }

                    })
                    .catch(error => {

                        console.error("Error:", error)

                    })

            })

        })
    </script>
    <script>
        // Preview Image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Medical History JSON Logic
        const conditionsWrapper = document.getElementById('conditions-wrapper');
        const conditionInput = document.getElementById('condition-input');
        const addBtn = document.getElementById('add-condition-btn');
        const jsonInput = document.getElementById('medical-history-json');

        let conditions = JSON.parse(jsonInput.value || "[]");

        function renderConditions() {
            conditionsWrapper.innerHTML = '';
            conditions.forEach((condition, index) => {
                const badge = document.createElement('div');
                badge.className = 'condition-badge'; // لا يوجد أنيميشن هنا
                badge.innerHTML =
                    `${condition} <span class="remove-btn" onclick="removeCondition(${index})">&times;</span>`;
                conditionsWrapper.appendChild(badge);
            });
            jsonInput.value = JSON.stringify(conditions);
        }

        function addCondition() {
            const value = conditionInput.value.trim();
            if (value && !conditions.includes(value)) {
                conditions.push(value);
                renderConditions();
                conditionInput.value = '';
            }
        }

        function removeCondition(index) {
            conditions.splice(index, 1);
            renderConditions();
        }

        addBtn.addEventListener('click', addCondition);
        conditionInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addCondition();
            }
        });

        renderConditions();
    </script>
    <script>
        /**
         * MediTrust Clinic - Profile Image Management Script
         * وظيفة السكريبت: معاينة الصورة فور اختيارها، إظهار أزرار التحكم، وإمكانية الإلغاء.
         */

        document.addEventListener('DOMContentLoaded', function() {
            // تعريف العناصر الأساسية
            const avatarInput = document.getElementById('avatar-input');
            const avatarPreview = document.getElementById('avatar-preview');
            const saveWrapper = document.getElementById('avatar-save-wrapper');
            const originalSrc = avatarPreview.src; // الاحتفاظ بالصورة الأصلية للعيادة

            // 1. وظيفة المعاينة عند اختيار ملف
            window.previewImage = function(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // تحديث الصورة في الصفحة فوراً
                        avatarPreview.src = e.target.result;

                        // إظهار أزرار (Save / Cancel)
                        if (saveWrapper) {
                            saveWrapper.style.display = 'block';
                        }
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            // 2. وظيفة الإلغاء (تفريغ الحقل والعودة للصورة القديمة)
            window.cancelImage = function() {
                // إعادة الصورة القديمة
                avatarPreview.src = originalSrc;

                // إخفاء الأزرار
                if (saveWrapper) {
                    saveWrapper.style.display = 'none';
                }

                // مسح القيمة المختارة من الـ Input لتمكين اختيار نفس الصورة مرة أخرى إذا أراد
                avatarInput.value = "";
            };

            // 3. إضافة تأثير بسيط عند الضغط على Save (اختياري)
            const avatarForm = document.getElementById('avatar-form');
            if (avatarForm) {
                avatarForm.addEventListener('submit', function() {
                    const saveBtn = this.querySelector('button[type="submit"]');
                    if (saveBtn) {
                        saveBtn.innerHTML =
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
                        saveBtn.disabled = true;
                    }
                });
            }
        });
    </script>
@endsection
