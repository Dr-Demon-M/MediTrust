@extends('layouts.dashboardLayout')

@section('content')
    <div class="container-fluid p-0 m-1">
        <div class="d-flex align-items-center mb-4 mt-2">
            <a href="{{ route('appointments.index') }}" class="btn-back me-3">
                <i class="mdi mdi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0 text-primary">Appointment Details</h4>
                <p class="text-muted small mb-0">Reference ID: #APT-{{ $appointment->id }}</p>
            </div>
            <div class="ms-auto d-flex align-items-center">
                <a href="{{ route('chat.clinic', $appointment->id) }}" id="openChatBtn"
                    class="btn btn-clinic-chat rounded-pill px-3 no-print">
                    <i class="mdi mdi-chat-processing-outline me-1"></i> Open Chat
                </a>
                @if (in_array($appointment->status, ['pending', 'confirmed']))
                    <form action="{{ route('appointment.completed', $appointment->id) }}" method="GET" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-3 me-2 no-print"
                            onclick="return confirm('Mark this appointment as completed?')">
                            <i class="mdi mdi-check-circle-outline me-1"></i> Complete
                        </button>
                    </form>

                    <form action="{{ route('appointment.canceled', $appointment->id) }}" method="GET" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 me-2 no-print"
                            onclick="return confirm('Are you sure you want to cancel this appointment?')">
                            <i class="mdi mdi-close-circle-outline me-1"></i> Cancel
                        </button>
                    </form>
                @endif

                <button onclick="window.print()" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2 no-print">
                    <i class="mdi mdi-printer me-1"></i> Print Receipt
                </button>
                @if ($appointment->status != 'cancelled' && $appointment->status != 'completed')
                    <button type="button" class="btn btn-warning btn-icon-text rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#rescheduleModal">
                        <i class="mdi mdi-calendar-clock btn-icon-prepend"></i>
                        Re-schedule
                    </button>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold border-bottom pb-3 mb-4">
                            <i class="mdi mdi-account-card-details text-primary me-2"></i>Patient Information
                        </h6>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block">Full Name</label>
                                <span class="fw-bold text-dark">{{ $appointment->patient_name }}</span>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block">Phone Number</label>
                                <span class="fw-bold text-dark">+2{{ $appointment->patient_phone }}</span>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block">Gender / Age</label>
                                <span class="fw-bold text-dark">{{ $appointment->patient_gender }} ,
                                    {{ $appointment->patient_age }} Years</span>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small d-block">Email Address</label>
                                <span class="fw-bold text-dark">{{ $appointment->patient_email }}</span>
                            </div>
                        </div>

                        <h6 class="fw-bold border-bottom pb-3 mb-4 mt-2">
                            <i class="mdi mdi-stethoscope text-primary me-2"></i>Service & Specialty
                        </h6>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="text-muted small d-block">Specialty</label>
                                <span class="badge-soft-primary">{{ $appointment->specialty->name }}</span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="text-muted small d-block">Service</label>
                                <span class="fw-bold text-dark">{{ $appointment->service->name }}</span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="text-muted small d-block">Price</label>
                                <span class="fw-bold text-success">{{ $appointment->service_price }} EGP</span>
                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="col-md-4 mb-4">
                            <label class="text-muted small d-block">Attending Physician</label>
                            <span class="badge-soft-primary">Dr .{{ $appointment->doctor->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    @if ($appointment->patient_note)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100"
                                style="border-radius: 15px; border-left: 5px solid #ffc107 !important;">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 text-warning">
                                        <i class="mdi mdi-message-text text-warning me-2"></i>Patient's Note
                                    </h6>
                                    <div class="p-3 bg-light rounded" style="min-height: 100px;">
                                        <p class="text-dark small mb-0 italic">
                                            "{{ $appointment->patient_note }}"
                                        </p>
                                    </div>
                                    <small class="text-muted mt-2 d-block text-end italic">Submitted during booking</small>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($appointment->admin_note)
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm border-0 h-100"
                                style="border-radius: 15px; border-left: 5px solid #4b49ac !important;">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-3 text-primary">
                                        <i class="mdi mdi-notebook-edit text-primary me-2"></i>Clinical / Admin Notes
                                    </h6>
                                    <div class="p-3 bg-light rounded" style="min-height: 100px;">
                                        <p class="text-secondary small mb-0">
                                            "{{ $appointment->admin_note }}"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4 bg-primary text-white" style="border-radius: 15px;">
                    <div class="card-body p-4 text-center">
                        <div class="time-circle mx-auto mb-3">
                            <i class="mdi mdi-clock-outline"></i>
                        </div>
                        <h5 class="fw-bold mb-1">{{ $appointment->appointment_datetime->format('g:i a') }}</h5>
                        <p class="small opacity-75">{{ $appointment->appointment_datetime->format('j, F Y') }}</p>
                        <hr class="bg-white opacity-25">
                        <div class="d-flex justify-content-between px-3">
                            <span class="small">Status:</span>
                            <span class="badge bg-white text-primary fw-bold">{{ $appointment->status }}</span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4">Log History</h6>
                        <ul class="timeline-simple">
                            <li class="{{ $appointment->status == 'pending' ? 'active' : '' }}">
                                <p class="mb-0 small fw-bold">Appointment Created</p>
                                <span
                                    class="text-muted extra-small">{{ $appointment->created_at->format('M d, Y - h:i A') }}</span>
                            </li>

                            @if (in_array($appointment->status, ['confirmed', 'completed']))
                                <li class="{{ $appointment->status == 'confirmed' ? 'active' : '' }}">
                                    <p class="mb-0 small fw-bold">Confirmed by Admin</p>
                                    <span
                                        class="text-muted extra-small">{{ $appointment->updated_at->format('M d, Y - h:i A') }}</span>
                                </li>
                            @endif

                            @if ($appointment->status == 'completed')
                                <li class="active">
                                    <p class="mb-0 small fw-bold text-success">Appointment Completed</p>
                                    <span
                                        class="text-muted extra-small">{{ $appointment->updated_at->format('M d, Y - h:i A') }}</span>
                                </li>
                            @endif

                            @if ($appointment->status == 'cancelled')
                                <li class="active border-danger">
                                    <p class="mb-0 small fw-bold text-danger">Appointment Cancelled</p>
                                    <span
                                        class="text-muted extra-small">{{ $appointment->updated_at->format('M d, Y - h:i A') }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header bg-warning text-white"
                    style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title fw-bold"><i class="mdi mdi-calendar-clock me-2"></i>Re-schedule Appointment
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="form-group mb-4">
                            <label class="fw-bold text-dark mb-2">Assign to Doctor</label>
                            <select name="doctor_id" class="form-control form-select shadow-sm" required>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="fw-bold text-dark mb-2">New Appointment Date & Time</label>
                                <input type="datetime-local" name="appointment_datetime"
                                    class="form-control shadow-sm custom-dt-edit"
                                    min="{{ now()->format('Y-m-d\T00:00') }}" required>
                                <small class="text-muted">Current set:
                                    {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('d M, Y - h:i A') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light p-3"
                        style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                        <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning fw-bold px-4">Update Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                // 1. إغلاق كل القوائم المفتوحة
                $('.sidebar .collapse').removeClass('show');
                $('.sidebar .nav-item').removeClass('active');
                $('.sidebar [aria-expanded]').attr('aria-expanded', 'false');

                // 2. تحديد قائمة Appointments وفتحها يدوياً
                // ابحث عن الرابط الذي يؤدي لـ index المواعيد وافتح القائمة الأب له
                let appointmentLink = $('.sidebar a[href*="appointments"]');
                appointmentLink.closest('.collapse').addClass('show');
                appointmentLink.closest('.nav-item').addClass('active');
                appointmentLink.closest('.collapse').prev('a').attr('aria-expanded', 'true');

                // 3. تأكد من أن الـ Body لا يحتوي على كلاسات تصغير الـ sidebar إذا لم تكن تريدها
                if ($('body').hasClass('sidebar-icon-only')) {
                    // $('body').removeClass('sidebar-icon-only'); // اختياري لو عايز الـ sidebar يفضل مفرود
                }
            });
        </script>
    @endpush
@endsection
