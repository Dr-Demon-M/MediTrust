@extends('layouts.dashboardLayout')

@section('content')

    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ $doctor->image_url }}" class="img-md-custom rounded-circle me-3"
                                style="width: 60px; height: 60px; object-fit: cover;" alt="doctor">
                            <div>
                                <h4 class="card-title card-title-dash mb-0">{{ $doctor->name }} - Weekly Availability</h4>
                                <p class="card-subtitle card-subtitle-dash">
                                    Specialty: {{ $doctor->specialty->name }} | Experience: {{ $doctor->years_experience }}
                                    Years
                                </p>
                            </div>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ route('availability-schedule.index') }}" class="btn btn-outline-dark">
                                <i class="icon-arrow-left"></i> Back to List
                            </a>
                            <button class="btn btn-primary text-white me-0" data-bs-toggle="modal"
                                data-bs-target="#addExceptionModal">
                                <i class="icon-plus"></i> Add Exception
                            </button>
                            <form action="{{ route('availability-schedule.delete', $doctor->slug) }}" method="POST"
                                class="d-inline" id="clearScheduleForm"
                                onsubmit="return confirm('Are you sure you want to delete this Schedule?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon-text" onclick="confirmClear()">
                                    <i class="mdi mdi-delete-sweep"></i> Clear Schedule
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered schedule-grid text-center">
                            <thead>
                                <tr class="bg-light">
                                    <th style="width: 120px;">Time</th>
                                    @foreach (['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'] as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $slots = ['09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM', '02:00 PM'];
                                    $dayMapping = [
                                        'Sat' => 'Saturday',
                                        'Sun' => 'Sunday',
                                        'Mon' => 'Monday',
                                        'Tue' => 'Tuesday',
                                        'Wed' => 'Wednesday',
                                        'Thu' => 'Thursday',
                                        'Fri' => 'Friday',
                                    ];
                                @endphp

                                @foreach ($slots as $slot)
                                    <tr>
                                        <td class="time-label fw-bold">{{ $slot }}</td>

                                        @foreach (['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'] as $dayShort)
                                            @php
                                                $fullDay = $dayMapping[$dayShort];
                                                $key = "$fullDay-$slot";
                                                // البحث عن الحالة في المصفوفة القادمة من الـ Controller
                                                $status = $schedules[$key] ?? 'Free';
                                            @endphp

                                            <td class="p-2">
                                                @if ($status == 'Occupied')
                                                    <div class="slot-item busy" data-bs-toggle="tooltip"
                                                        title="Slot Reserved">
                                                        <div class="">
                                                            <small class="fw-bold">Occupied</small>
                                                        </div>
                                                    </div>
                                                @elseif ($status == 'Away')
                                                    <div class="slot-item away" data-bs-toggle="tooltip"
                                                        title="Click to book">
                                                        <div class="">
                                                            <small class="fw-bold">Away</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="slot-item available" data-bs-toggle="tooltip"
                                                        title="Click to book">
                                                        <div class="">
                                                            <small class="fw-bold">Free</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addExceptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Exception</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('availability-schedule.add', $doctor->slug) }}" method="POST">
                    @csrf
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="fw-bold small">Select Day</label>
                            <select name="day" class="form-select" required style="color:black;">
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold small">Select Time Slot</label>
                            <select name="start_time" class="form-select" required style="color:black;">
                                <option value="09:00:00">09:00 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="13:00:00">01:00 PM</option>
                                <option value="14:00:00">02:00 PM</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold small">Reason / Status</label>
                            <select name="status" class="form-select" style="color:black;">
                                <option value="Occupied">Booked Appointment</option>
                                <option value="Away">Emergency Leave / Break</option>
                                <option value="Free">Set as Available</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold small">Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="e.g. Patient name or reason for change"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Update Slot</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
