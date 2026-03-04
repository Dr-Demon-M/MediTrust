@extends('layouts.dashboardLayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/clinic-weekly-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="weekly-schedule-wrapper" style="width: 100%">
        <div class="schedule-header-flex">
            <div class="header-text">
                <h2>Weekly Clinic Appointments</h2>
                <p class="date-range-badge">
                    <i class="far fa-calendar-alt"></i>
                    {{ $weekDays[0]->format('M d, Y') }} — {{ end($weekDays)->format('M d, Y') }}
                </p>
            </div>
            <button class="btn-add-hours" onclick="toggleModal(true)">
                <i class="fas fa-plus-circle"></i> Add Working Hours
            </button>
        </div>

        <div class="week-grid">
            @foreach ($weekDays as $day)
                <div class="day-column {{ $day->isToday() ? 'is-today' : '' }}">
                    <div class="day-header">
                        <div class="day-title-wrapper">
                            <span class="day-name">{{ $day->format('l') }}</span>

                            <form action="{{ route('availability.delete', [$doctor->slug, $day->format('l')]) }}"
                                method="POST" class="clear-day-form"
                                onsubmit="return confirm('Are you sure you want to clear all working hours for {{ $day->format('l') }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-clear-day" title="Clear this day">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        <span class="day-date">{{ $day->format('M d') }}</span>
                    </div>

                    <div class="slots-container">
                        @php $slots = $weeklySlots[$day->format('Y-m-d')] ?? []; @endphp

                        @forelse($slots as $slot)
                            <div class="slot-item {{ $slot['status'] }}">
                                <span class="slot-time">{{ $slot['time'] }}</span>
                                <span class="slot-status-label">
                                    @if ($slot['status'] === 'past')
                                        Past Time
                                    @elseif ($slot['status'] === 'inactive')
                                        Not Available
                                    @else
                                        {{ ucfirst($slot['status']) }}
                                    @endif
                                </span>
                            </div>
                        @empty
                            <div class="no-slots">No Working Hours</div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="workingHoursModal" class="clinic-modal">
        <div class="modal-content animate-in">
            <div class="modal-header">
                <h3><i class="fas fa-clock"></i> Set Working Hours</h3>
                <span class="close-btn" onclick="toggleModal(false)">&times;</span>
            </div>
            <form action="{{ route('availability.add', $doctor->slug) }}" method="POST" class="clinic-form">
                @csrf
                <div class="form-group">
                    <label>Select Day</label>
                    <select name="day" required>
                        @foreach ($weekDays as $day)
                            <option value="{{ $day->format('l') }}">{{ $day->format('l') }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" name="end_time" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Availability Status</label>
                    <select name="status" required>
                        <option value="active" selected>Active (Available for Booking)</option>
                        <option value="inactive">Inactive (Not Available)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Slot Duration (Min)</label>
                    <input type="number" name="slot_duration" placeholder="e.g. 30" required>
                </div>

                <div class="form-group">
                    <label>Notes (Optional)</label>
                    <textarea name="notes" rows="2" placeholder="Example: Break from 12 to 1 PM"></textarea>
                </div>

                <button type="submit" class="btn-submit">Save Schedule</button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('workingHoursModal');
            modal.style.display = show ? 'flex' : 'none';
        }
    </script>
@endsection
