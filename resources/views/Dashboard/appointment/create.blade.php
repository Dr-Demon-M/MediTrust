@extends('layouts.dashboardLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold text-primary mb-4">
                            <i class="mdi mdi-calendar-plus me-2"></i>Book New Appointment
                        </h4>

                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Patient Information</h6>
                                </div>

                                {{-- Choose Existing Patient --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Choose Existing Patient</label>
                                    <select name="patient_id" id="patient-select" class="form-select rounded-3"
                                        style="color: black;">
                                        <option value="">-- Select Patient --</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}">
                                                {{ $patient->name }} ({{ $patient->phone }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 text-center mb-3">
                                    <span class="badge bg-light text-dark px-3 py-2">OR</span>
                                </div>

                                {{-- Create New Patient --}}
                                <div id="new-patient-form" class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input value="{{ old('patient_name', $patient->name ?? '') }}" type="text"
                                            name="patient_name" class="form-control rounded-3" placeholder="Enter name">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" value="{{ old('patient_phone', $patient->phone ?? '') }}" name="patient_phone" class="form-control rounded-3"
                                            placeholder="01xxxxxxxxx">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Email Address (optional)</label>
                                        <input type="email" value="{{ old('patient_email', $patient->email ?? '') }}" name="patient_email" class="form-control rounded-3"
                                            placeholder="email@example.com">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Gender</label>

                                        <select name="patient_gender" class="form-select rounded-3" style="color: black;">
                                            <option value="">Select</option>
                                            <option value="male" {{ old('patient_gender', $patient->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('patient_gender', $patient->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>

                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">Age</label>
                                        <input type="number" value="{{ old('patient_age', $patient->age ?? '') }}" name="patient_age" class="form-control rounded-3"
                                            min="0" max="120">
                                    </div>

                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted fw-bold mb-3 border-bottom pb-2">Appointment & Service Details
                                    </h6>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Specialty</label>
                                    <select name="specialty_id" id="specialty_id" class="form-select rounded-3" required
                                        style="color:black;">
                                        <option value="" selected disabled>Choose Specialty</option>
                                        @foreach ($specialties as $specialty)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Service</label>
                                    <select name="service_id" id="service_id" class="form-select rounded-3" required
                                        disabled style="color:black;">
                                        <option value="" selected disabled>Select Specialty first</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Doctor</label>
                                    <select name="doctor_id" id="doctor_id" class="form-select rounded-3" required disabled
                                        style="color:black;">
                                        <option value="" selected disabled>Select Specialty first</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Service Price (EGP)</label>
                                    <input type="text" name="service_price" id="service_price"
                                        class="form-control rounded-3" step="0.01" required readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Appointment Date & Time</label>
                                    <input type="datetime-local" name="appointment_datetime"
                                        class="form-control rounded-3 custom-dt-picker" required
                                        min="{{ now()->format('Y-m-d\T09:00') }}"
                                        max="{{ now()->addDays(7)->format('Y-m-d\T14:00') }}">
                                    <div class="form-text">Clinic hours: 09:00 AM - 02:00 PM</div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Initial Status</label>
                                    <select name="status" class="form-select rounded-3" required style="color:black;">
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Patient Note</label>
                                    <textarea name="patient_note" class="form-control rounded-3" rows="3" placeholder="Notes from the patient..."></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Internal Admin Note</label>
                                    <textarea name="admin_note" class="form-control rounded-3" rows="3" placeholder="Notes for clinic staff..."></textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="reset" class="btn btn-light rounded-pill px-4">Cancel</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold">Confirm
                                    Booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.getElementById('specialty_id').addEventListener('change', function() {
                const specialtyId = this.value;
                const serviceSelect = document.getElementById('service_id');
                const doctorSelect = document.getElementById('doctor_id');

                // 1. إعادة ضبط الخيارات وتفعيل القوائم
                serviceSelect.disabled = false;
                serviceSelect.innerHTML = '<option value="" selected disabled>Loading services...</option>';

                doctorSelect.disabled = false;
                doctorSelect.innerHTML = '<option value="" selected disabled>Loading doctors...</option>';

                // 2. جلب الخدمات بناءً على التخصص
                fetch(`/api/specialties/${specialtyId}/services`)
                    .then(response => response.json())
                    .then(data => {
                        serviceSelect.innerHTML = '<option value="" selected disabled>Select Service</option>';
                        data.forEach(service => {
                            serviceSelect.innerHTML +=
                                `<option value="${service.id}" data-price="${service.price}">${service.name}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Service fetch error:', error);
                        serviceSelect.innerHTML =
                            '<option value="" selected disabled>Error loading services</option>';
                    });

                // 3. جلب الأطباء بناءً على التخصص (مرة واحدة فقط)
                fetch(`/api/specialties/${specialtyId}/doctors`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.length > 0) {
                            doctorSelect.innerHTML = '<option value="" selected disabled>Select Doctor</option>';
                            data.forEach(doctor => {
                                doctorSelect.innerHTML +=
                                    `<option value="${doctor.id}">${doctor.name}</option>`;
                            });
                        } else {
                            doctorSelect.innerHTML =
                                '<option value="" selected disabled>No doctors available currently</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Doctor fetch error:', error);
                        doctorSelect.innerHTML =
                            '<option value="" selected disabled>Error loading doctors</option>';
                    });
            });

            // تحديث السعر تلقائياً عند اختيار الخدمة
            document.getElementById('service_id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                document.getElementById('service_price').value = price || 0;
            });
        </script>
        <script>
            document.getElementById('patient-select').addEventListener('change', function() {
                let form = document.getElementById('new-patient-form')
                if (this.value) {
                    form.style.display = 'none'
                } else {
                    form.style.display = 'flex'
                }
            })
            $('#patient-select').on('change', function() {
                if ($(this).val()) {
                    $('#new-patient-fields').slideUp();
                    $('#new-patient-fields input, #new-patient-fields select').prop('disabled', true);
                } else {
                    $('#new-patient-fields').slideDown();
                    $('#new-patient-fields input, #new-patient-fields select').prop('disabled', false);
                }
            });
        </script>
    @endpush
@endsection
