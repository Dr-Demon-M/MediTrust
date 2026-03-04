@extends('layouts.frontLayout')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Appointments</li>
                    </ol>
                </nav>
            </div>

            <div class="title-wrapper">
                <h1>Appointment</h1>
                <p>Book your appointment online in just a few simple steps and receive professional medical care at your
                    convenience.</p>
            </div>
        </div>

        <section id="appointmnet" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="appointment-info">
                            <h3>Quick &amp; Easy Online Booking</h3>
                            <p class="mb-4">Our healthcare professionals are ready to provide you with the best medical
                                care tailored to your needs.</p>

                            <div class="info-items">
                                <div class="info-item d-flex align-items-center mb-3" data-aos="fade-up"
                                    data-aos-delay="200">
                                    <div class="icon-wrapper me-3"><i class="bi bi-calendar-check"></i></div>
                                    <div>
                                        <h5>Flexible Scheduling</h5>
                                        <p class="mb-0">Choose from available time slots that fit your busy schedule</p>
                                    </div>
                                </div>
                                <div class="info-item d-flex align-items-center mb-3" data-aos="fade-up"
                                    data-aos-delay="250">
                                    <div class="icon-wrapper me-3"><i class="bi bi-stopwatch"></i></div>
                                    <div>
                                        <h5>Quick Response</h5>
                                        <p class="mb-0">Get confirmation shortly after submitting your request</p>
                                    </div>
                                </div>
                            </div>

                            <div class="emergency-contact mt-4" data-aos="fade-up" data-aos-delay="350">
                                <div class="emergency-card p-3">
                                    <h6 class="mb-2"><i class="bi bi-telephone-fill me-2"></i>Emergency Hotline</h6>
                                    <p class="mb-0">Call <strong>+20 100 123 4567</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="appointment-form-wrapper" data-aos="fade-up" data-aos-delay="200">
                            <form action="{{ route('front.appointments.store') }}" method="post" class="appointment-form">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <input type="text" name="patient_name" class="form-control"
                                            placeholder="Your Full Name" required
                                            @if (Auth::guard('patient')->check()) value="{{ Auth::guard('patient')->user()->name }}" readonly @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="patient_email" class="form-control"
                                            placeholder="Your Email" required
                                            @if (Auth::guard('patient')->check()) value="{{ Auth::guard('patient')->user()->email }}" readonly @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" name="patient_phone" class="form-control"
                                            placeholder="Your Phone Number" required
                                            @if (Auth::guard('patient')->check()) value="{{ Auth::guard('patient')->user()->phone }}" readonly @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="patient_age" class="form-control" placeholder="Age"
                                            required min="0"
                                            @if (Auth::guard('patient')->check()) value="{{ Auth::guard('patient')->user()->age }}" readonly @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" @if (Auth::guard('patient')->check()) disabled @endif>
                                            <option value="">Gender</option>
                                            <option value="male"
                                                {{ Auth::guard('patient')->check() && Auth::guard('patient')->user()->gender == 'male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="female"
                                                {{ Auth::guard('patient')->check() && Auth::guard('patient')->user()->gender == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                        @if (Auth::guard('patient')->check())
                                            <input type="hidden" name="patient_gender"
                                                value="{{ Auth::guard('patient')->user()->gender }}">
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <select name="specialty_id" id="main_specialty_id" class="form-select" required>
                                            <option value="">Select Specialty</option>
                                            @foreach ($specialties as $specialty)
                                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select name="service_id" id="main_service_id" class="form-select" required
                                            disabled>
                                            <option value="">Select Service First</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select name="doctor_id" id="main_doctor_id" class="form-select" required disabled>
                                            <option value="">Select Doctor</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">EGP</span>
                                            <input type="text" name="service_price" id="service_price"
                                                class="form-control bg-light" placeholder="Price" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label small fw-bold text-muted">Appointment Date & Time</label>
                                        <div class="input-group custom-dt-container">
                                            <span class="input-group-text bg-white"><i
                                                    class="bi bi-calendar-event text-primary"></i></span>
                                            <input type="datetime-local" name="appointment_datetime"
                                                class="form-control custom-datetime-picker" required
                                                min="{{ now()->format('Y-m-d\TH:i') }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="patient_note" rows="3" placeholder="Symptoms or notes (optional)"></textarea>
                                    </div>

                                    <input type="hidden" name="status" value="pending">

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-appointment w-100">
                                            <i class="bi bi-calendar-plus me-2"></i>Book Appointment Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('main_specialty_id').addEventListener('change', function() {
            const specialtyId = this.value;
            const serviceSelect = document.getElementById('main_service_id');
            const doctorSelect = document.getElementById('main_doctor_id');
            const priceInput = document.getElementById('service_price');

            serviceSelect.disabled = false;
            doctorSelect.disabled = false;
            serviceSelect.innerHTML = '<option value="">Loading services...</option>';
            doctorSelect.innerHTML = '<option value="">Loading doctors...</option>';
            priceInput.value = '';

            // جلب الخدمات
            fetch(`{{ url('/api/specialties') }}/${specialtyId}/services`)
                .then(res => res.json())
                .then(data => {
                    serviceSelect.innerHTML = '<option value="" selected disabled>Select Service</option>';
                    data.forEach(s => {
                        // تخزين السعر في data-price
                        serviceSelect.innerHTML +=
                            `<option value="${s.id}" data-price="${s.price}">${s.name}</option>`;
                    });
                });

            // جلب الأطباء
            fetch(`{{ url('/api/specialties') }}/${specialtyId}/doctors`)
                .then(res => res.json())
                .then(data => {
                    doctorSelect.innerHTML = '<option value="" selected disabled>Select Doctor</option>';
                    data.forEach(d => {
                        doctorSelect.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                    });
                });
        });

        // تحديث السعر عند اختيار الخدمة
        document.getElementById('main_service_id').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            document.getElementById('service_price').value = price ? price : '';
        });
    </script>
@endsection
