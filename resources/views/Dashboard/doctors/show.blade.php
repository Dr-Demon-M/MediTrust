@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12">
            <div class="card doctor-profile-card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center">
                            <div class="profile-img-wrapper me-4">
                                <img src="{{ $doctor->imageUrl }}" alt="Doctor" class="rounded-circle shadow-sm">
                                <span class="status-indicator bg-success"></span>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1">Dr. {{ $doctor->name }}</h3>
                                <p class="text-primary fw-medium mb-1"><i class="mdi mdi-medal me-1"></i> Consultant
                                    - {{ $doctor->specialty->name }}</p>
                                <div class="d-flex align-items-center">
                                    <div class="rating-stars me-2">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="mdi mdi-star text-warning"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="mdi mdi-star-half text-warning"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="mdi mdi-star-outline text-warning"></i>
                                        @endfor
                                    </div>
                                    <span class="text-muted small">
                                        ({{ $doctor->rating }} Rating from {{ $patients }} Patients)
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="action-btns mt-3 mt-md-0">
                            <button class="btn btn-success text-white me-2" data-bs-toggle="modal"
                                data-bs-target="#quickBookModal">
                                <i class="mdi mdi-calendar-plus me-1"></i> Quick Book
                            </button>
                            <a href="{{ route('doctors.edit', $doctor->slug) }}" class="btn btn-outline-primary me-2"><i
                                    class="mdi mdi-pencil"></i> Edit
                                Profile</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Professional Information</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Experience:</span>
                                    <span class="fw-bold">{{ $doctor->years_experience }} Years</span>
                                </li>
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Consultation Fee:</span>
                                    <span class="fw-bold text-success">{{ (int) $doctor->consultation_fee }} EGP</span>
                                </li>
                                <li class="mb-3 d-flex justify-content-between">
                                    <span class="text-muted">Specialty:</span>
                                    <span class="fw-bold">{{ $doctor->specialty->name }}</span>
                                </li>
                                <li class="mb-0">
                                    <p class="text-muted mb-2">Short Bio:</p>
                                    <p class="small text-dark lh-base">{{ $doctor->bio }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="mb-2">Total Patients</p>
                                    <h2 class="fw-bold">{{ $patients }}</h2>
                                </div>
                                <i class="mdi mdi-account-group fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card doctor-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Weekly Work Schedule</h4>
                                <button class="btn btn-link btn-sm text-decoration-none">Manage Availability</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Day</th>
                                            <th>Shift Timing</th>
                                            <th>Clinic Room</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Saturday</td>
                                            <td>05:00 PM - 09:00 PM</td>
                                            <td>Room A1</td>
                                            <td><span class="badge badge-opacity-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Monday</td>
                                            <td>05:00 PM - 09:00 PM</td>
                                            <td>Room A1</td>
                                            <td><span class="badge badge-opacity-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Wednesday</td>
                                            <td>10:00 AM - 02:00 PM</td>
                                            <td>Room B2</td>
                                            <td><span class="badge badge-opacity-warning">Full Booked</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <h4 class="card-title">Recent Activity</h4>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <small>Last consultation completed</small>
                                        <span class="text-muted small">2 hours ago</span>
                                    </div>
                                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <small>Profile details updated by Admin</small>
                                        <span class="text-muted small">Yesterday</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="quickBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
