@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded shadow-sm">
                <div class="card-body">
                    {{-- Header --}}
                    <div class="d-sm-flex justify-content-between align-items-start mb-4 border-bottom pb-3">
                        <div>
                            <h4 class="card-title card-title-dash text-primary">
                                <i class="mdi mdi-bell-ring-outline me-2"></i>Notifications Center
                            </h4>
                            <p class="card-subtitle card-subtitle-dash">
                                Stay updated with your clinic activities and patient appointments.
                            </p>
                        </div>
                        <div class="btn-wrapper">
                            <form action="{{ route('notifications.markAllAsRead') }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="mdi mdi-check-all me-1"></i> Mark all as read
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Notifications List --}}
                    <div class="list-wrapper mt-3">
                        @forelse($notifications as $notification)
                            @php $details = $notification->data; @endphp
                            <div class="notification-item p-3 mb-2 d-flex align-items-center {{ is_null($notification->read_at) ? 'bg-unread' : 'bg-light-hover' }}"
                                style="border-radius: 10px; transition: 0.3s; border-left: 5px solid {{ is_null($notification->read_at) ? '#4B49AC' : '#ced4da' }};">

                                {{-- Icon based on type --}}
                                <div class="icon-box me-3">
                                    <div class="preview-icon rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 45px; height: 45px; background-color: {{ is_null($notification->read_at) ? '#e8e7ff' : '#e9ecef' }};">
                                        <i
                                            class="mdi {{ $details['icon'] ?? 'mdi-calendar-check' }} {{ is_null($notification->read_at) ? 'text-primary' : 'text-muted' }} fs-4"></i>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="content-box flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1 {{ is_null($notification->read_at) ? 'fw-bold' : 'text-muted' }}">
                                            {{ $details['title'] ?? 'New Notification' }}
                                        </h6>
                                        <small class="text-muted italic">
                                            <i
                                                class="mdi mdi-clock-outline me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-0 text-small text-secondary">
                                        {{ $details['message'] ?? 'You have a new update in your schedule.' }}
                                    </p>
                                </div>
                                {{-- Action Button --}}
                                <div class="action-box ms-3">
                                    <a href="{{ $details['url'] ?? '#' }}"
                                        class="btn btn-sm {{ is_null($notification->read_at) ? 'btn-primary text-white' : 'btn-outline-secondary' }} notification-link"
                                        data-id="{{ $notification->id }}">
                                        View details
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="mdi mdi-bell-off-outline text-muted" style="font-size: 50px;"></i>
                                <p class="mt-2 text-muted">Your inbox is clear! No notifications found.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
