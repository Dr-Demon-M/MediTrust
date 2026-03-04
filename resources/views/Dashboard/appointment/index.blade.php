@extends('layouts.dashboardLayout')

@section('content')
    <div class="container-fluid p-0 m-1">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm border-0 bg-white" style="border-radius: 15px; min-height: 85vh;">
                    <div class="card-body p-4 d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                            <div>
                                <h4 class="fw-bold mb-1 text-primary">
                                    <i class="mdi mdi-calendar-text text-primary me-2"></i>Weekly Schedule
                                </h4>
                                <p class="text-muted small mb-0">Full clinic schedule management for the current week</p>
                                <a href="{{ route('appointments.create') }}" class="btn btn-primary fw-bold shadow-sm mt-3"
                                    style="border-radius: 10px; padding: 10px 20px;">
                                    <i class="mdi mdi-plus-circle me-1"></i> Add New Appointment
                                </a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" id="prevDay">Previous</button>
                                <button type="button" class="btn btn-primary" id="nextDay">Next</button>
                            </div>
                        </div>

                        <div class="nav-scroller mb-4">
                            <ul class="nav nav-pills nav-pills-custom d-flex justify-content-between" id="pills-tab"
                                role="tablist">
                                @foreach ($weekDays as $index => $day)
                                    <li class="nav-item flex-fill mx-1">
                                        <button class="nav-link w-100 {{ $index == 0 ? 'active' : '' }}"
                                            id="tab-{{ $day }}" data-bs-toggle="pill"
                                            data-bs-target="#content-{{ $day }}" type="button">
                                            {{ $day }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content flex-grow-1" id="pills-tabContent">
                            @foreach ($weekDays as $index => $day)
                                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                    id="content-{{ $day }}">
                                    <div class="table-responsive" style="height: 100%;">
                                        <table class="table table-hover align-middle custom-table w-100">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%">Time</th>
                                                    <th style="width: 15%">Patient</th>
                                                    <th style="width: 15%">Specialty</th>
                                                    <th style="width: 15%">Service</th>
                                                    <th style="width: 15%">Doctor</th>
                                                    <th style="width: 15%">Status</th>
                                                    <th style="width: 10%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $dayAppointments = $appointments[$day] ?? collect(); @endphp
                                                @forelse ($dayAppointments as $appointment)
                                                    <tr>
                                                        <td class="fw-bold">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('h:i A') }}
                                                            <br>
                                                            <small
                                                                class="fw-normal">{{ $appointment->appointment_datetime->format('j, M Y') }}</small>
                                                        </td>
                                                        <td>{{ $appointment->patient_name }}</td>
                                                        <td>
                                                            <span class="badge-specialty">
                                                                {{ $appointment->specialty->name }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $appointment->service->name }}</td>
                                                        <td>{{ $appointment->doctor->name}}</td>
                                                        <td>
                                                            <span class="status-badge status-{{ $appointment->status }}">
                                                                {{ ucfirst($appointment->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('appointments.show', $appointment->id) }}"
                                                                class="btn-action view p-2">
                                                                <i class="mdi mdi-eye"></i>
                                                            </a>
                                                            @if ($appointment->status != 'completed' && $appointment->status != 'cancelled')
                                                                <a href="{{ route('appointment.completed', $appointment->id) }}"
                                                                    class="btn-action check p-2">
                                                                    <i class="mdi mdi-check"></i>
                                                                </a>
                                                            @endif
                                                            @if ($appointment->status != 'cancelled' && $appointment->status != 'completed')
                                                                <a href="{{ route('appointment.canceled', $appointment->id) }}"
                                                                    class="btn btn-danger p-2 ">
                                                                    <i class="mdi mdi-close"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center py-5">
                                                            <div class="empty-state">
                                                                <i class="mdi mdi-calendar-blank"></i>
                                                                <p>No appointments for {{ $day }} yet</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const tabs = document.querySelectorAll('#pills-tab .nav-link');
                const STORAGE_KEY = 'weeklyScheduleActiveTab';

                let currentIndex = 0;

                // 🔹 استرجاع آخر تاب محفوظ
                const savedIndex = localStorage.getItem(STORAGE_KEY);

                if (savedIndex !== null && tabs[savedIndex]) {
                    currentIndex = parseInt(savedIndex);
                    new bootstrap.Tab(tabs[currentIndex]).show();
                }

                function updateTab(index) {
                    const tabTrigger = new bootstrap.Tab(tabs[index]);
                    tabTrigger.show();
                    localStorage.setItem(STORAGE_KEY, index); // حفظ التاب
                }

                document.getElementById('nextDay').addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % tabs.length;
                    updateTab(currentIndex);
                });

                document.getElementById('prevDay').addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + tabs.length) % tabs.length;
                    updateTab(currentIndex);
                });

                // 🔹 حفظ التاب عند الضغط اليدوي
                tabs.forEach((tab, index) => {
                    tab.addEventListener('shown.bs.tab', () => {
                        currentIndex = index;
                        localStorage.setItem(STORAGE_KEY, index);
                    });
                });

            });
        </script>
    @endpush
@endsection
