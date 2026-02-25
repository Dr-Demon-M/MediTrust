@extends('layouts.dashboardLayout')

@section('content')
    <div class="container-fluid p-0 mt-5 ml-1 m-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    {{-- إحصائيات سريعة (Cards) --}}
                    <div class="row">
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card bg-primary text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="mdi mdi-calendar-check mdi-36px"></i>
                                        <div class="text-end">
                                            <p class="mb-0">Today's Appointments</p>
                                            <h2 class="mb-0">{{ $appointments->count() }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card bg-success text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="mdi mdi-account-multiple mdi-36px"></i>
                                        <div class="text-end">
                                            <p class="mb-0">New Patients</p>
                                            <h2 class="mb-0">{{ $count }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin stretch-card">
                            <div class="card bg-warning text-white shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="mdi mdi-currency-usd mdi-36px"></i>
                                        <div class="text-end">
                                            <p class="mb-0">Daily Revenue</p>
                                            <h2 class="mb-0">{{ number_format($price) }} <small>EGP</small></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- الرسم البياني للمرضى --}}
                        <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Appointment Statistics</h4>
                                            <p class="card-subtitle card-subtitle-dash">Number of patients per day (Current
                                                Week)</p>
                                        </div>
                                    </div>
                                    <div class="chartjs-bar-wrapper mt-3">
                                        <canvas id="clinicPerformanceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded todo-card shadow-sm">
                                <div class="card-body d-flex flex-column">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title card-title-dash mb-0">
                                            📝 To-Do List
                                        </h4>
                                        <span class="badge bg-info rounded">
                                            {{ $todos->where('completed', false)->count() }} Pending
                                        </span>
                                    </div>

                                    {{-- Add Task --}}
                                    <form action="{{ route('todos.store') }}" method="POST" class="todo-form mb-3">
                                        @csrf
                                        <input type="text" name="title" class="form-control todo-input"
                                            placeholder="Add new task..." required>
                                        <button class="btn btn-secondary btn-sm px-3">
                                            Add
                                        </button>
                                    </form>

                                    {{-- Tasks --}}
                                    <div class="todo-container flex-grow-1">

                                        @forelse($todos as $todo)
                                            <div class="todo-item {{ $todo->completed ? 'completed' : '' }}">

                                                {{-- Toggle --}}
                                                <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="todo-check">
                                                        <i class="mdi mdi-check"></i>
                                                    </button>
                                                </form>

                                                {{-- Title --}}
                                                <span class="todo-title">
                                                    {{ $todo->title }}
                                                </span>

                                                {{-- Delete --}}
                                                <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="todo-delete">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        @empty
                                            <div class="text-center text-muted mt-4">
                                                No tasks yet.
                                            </div>
                                        @endforelse

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- جدول المواعيد الأخيرة --}}
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Upcoming Appointments</h4>
                                            <p class="card-subtitle card-subtitle-dash">You have
                                                {{ $upcomingAppointments->count() }} appointments pending for
                                                the next 24 hours</p>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-1">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Patient</th>
                                                    <th>Service</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($upcomingAppointments as $appointment)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex">
                                                                <img src="#" alt="">
                                                                <div>
                                                                    <h6>{{ $appointment->patient_name }}</h6>
                                                                    <p>ID: #{{ $appointment->id }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $appointment->service->name }}</h6>
                                                            <p>{{ $appointment->service->specialty->name }}</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $appointment->appointment_time->format('g:i A') }}</h6>
                                                            <p>{{ $appointment->appointment_date->format('d M Y') }}</p>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-opacity-warning">
                                                                {{ $appointment->status }}</div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="py-5">
                                                            <div class="empty-state text-center">
                                                                <br>
                                                                <div class="empty-icon mb-3">
                                                                    <i class="mdi mdi-calendar-check-outline"></i>
                                                                </div>
                                                                <br>
                                                                <h6 class="mb-1 fw-semibold">
                                                                    All Clear...
                                                                </h6>
                                                                <p class="text-muted mb-0">
                                                                    No pending appointments in the next 24 hours.
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('clinicPerformanceChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Patients',
                        data: @json($weekData),
                        borderColor: '#4B49AC',
                        backgroundColor: 'rgba(75, 73, 172, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    @endpush
