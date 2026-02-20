@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card mx-auto">
            <div class="card doctor-card m-1">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h4 class="card-title text-primary mb-4">
                                <i class="mdi mdi-calendar-plus me-2"></i> Book New Appointment
                            </h4>
                        </div>
                    </div>
                    @foreach ($doctors as $doctor)
                        <form action="{{ route('availability-schedule.add', $doctor->slug) }}" method="POST"
                            class="forms-sample">
                            @csrf
                    @endforeach
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold mb-2">Select Doctor (Active)</label>
                            <select name="doctor_id" class="form-select custom-input" required
                                style="color:black !important;">
                                <option value="" selected disabled>Choose a doctor...</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->slug }}">Dr. {{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold mb-2">Day</label>
                            <select name="day" class="form-select custom-input" required
                                style="color:black !important;">
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold mb-2">Time Slot</label>
                            <select name="start_time" class="form-select custom-input" required
                                style="color:black !important;">
                                <option value="09:00:00">09:00 AM</option>
                                <option value="10:00:00">10:00 AM</option>
                                <option value="11:00:00">11:00 AM</option>
                                <option value="12:00:00">12:00 PM</option>
                                <option value="13:00:00">01:00 PM</option>
                                <option value="14:00:00">02:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold mb-2">Appointment Reason</label>
                        <select name="status" class="form-select custom-input" style="color:black !important;">
                            <option value="Occupied">Confirmed Appointment</option>
                            <option value="Away">Break / Not Available</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold mb-2">Notes & Patient Info</label>
                        <textarea name="notes" class="form-control custom-input-text" rows="5" placeholder="Enter patient details..."></textarea>
                    </div>

                    <div class="d-flex justify-content-start mt-4">
                        <button type="submit" class="btn btn-primary text-white px-5 me-3" style="height: 45px;">
                            Confirm Appointment
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-light px-4 d-flex align-items-center">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
