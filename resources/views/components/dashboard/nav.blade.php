<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 !important fixed-top d-flex align-items-top flex-row no-print"
    style="padding: 0 !important; margin:0 !important">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                <img style="object-fit: contain;" src="{{ asset('images/logo.png') }}" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo-mini.svg') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Good Morning, <span
                        class="text-black fw-bold">Dr:{{ Auth::user()->doctor->name }}</span>
                </h1>
                <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
                <div class="input-group date navbar-date-picker"> <span
                        class="input-group-addon input-group-prepend border-right">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" class="form-control bg-transparent border-0 text-dark ps-2"
                        value="{{ date('m/d/Y') }}" readonly style="pointer-events: none; cursor: default;">
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="icon-bell"></i>
                    @if ($newCount > 0)
                        <span class="notification-badge">
                            {{ $newCount }}
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown notification-dropdown p-0 shadow-lg border-0"
                    aria-labelledby="notificationDropdown">

                    {{-- Header --}}
                    <div
                        class="notification-header d-flex justify-content-between align-items-center px-4 py-3 border-bottom">
                        <h6 class="mb-0 fw-semibold">Notifications</h6>
                        <span class="badge bg-primary" id="dropdownNotificationCount">
                            {{ $newCount }}
                        </span>
                    </div>

                    {{-- Body --}}
                    <div class="notification-body" style="max-height: 350px; overflow-y: auto;">
                        @forelse($notifications->take(5) as $notification)
                            {{-- عرض آخر 5 فقط في القائمة السريعة --}}
                            @php
                                $details = is_array($notification->data)
                                    ? $notification->data
                                    : json_decode($notification->data, true);

                                $type = $details['type'] ?? 'default';
                                $isUnread = is_null($notification->read_at);

                                $icon = match ($type) {
                                    'appointment_created' => 'mdi-plus-circle',
                                    'appointment_updated' => 'mdi-update',
                                    'appointment_cancelled' => 'mdi-cancel',
                                    'appointment_completed' => 'mdi-check-all',
                                    default => 'mdi-bell',
                                };
                            @endphp

                            <a href="{{ route('notifications.read', [
                                'notification' => $notification->id,
                                'appointment' => $details['appointment_id'] ?? '',
                            ]) }}"
                                class="dropdown-item notification-item d-flex align-items-center py-3 border-bottom {{ $isUnread ? 'unread' : '' }}"
                                data-id="{{ $notification->id }}">

                                <div class="notification-icon me-3">
                                    <i
                                        class="mdi {{ $icon }} fs-4 {{ $isUnread ? 'text-primary' : 'text-muted' }}"></i>
                                </div>

                                <div class="notification-content flex-grow-1">
                                    <div class="notification-title fw-bold small text-dark">
                                        @switch($type)
                                            @case('appointment_created')
                                                New Appointment
                                            @break

                                            @case('appointment_updated')
                                                Appointment Updated
                                            @break

                                            @case('appointment_cancelled')
                                                Appointment Cancelled
                                            @break

                                            @case('appointment_completed')
                                                Appointment Completed
                                            @break

                                            @default
                                                Notification
                                        @endswitch
                                    </div>

                                    <div class="notification-subtitle text-muted small">
                                        {{ $details['patient_name'] ?? 'Clinic Update' }}
                                    </div>

                                    <div class="notification-time x-small text-muted mt-1" style="font-size: 11px;">
                                        <i
                                            class="mdi mdi-clock-outline me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                @if ($isUnread)
                                    <span class="notification-dot ms-2"
                                        style="width: 8px; height: 8px; background-color: #4B49AC; border-radius: 50%;"></span>
                                @endif
                            </a>
                            @empty
                                <div class="notification-empty text-center py-4">
                                    <i class="mdi mdi-bell-outline fs-3 text-muted"></i>
                                    <p class="mb-0 small text-muted mt-2">No notifications yet</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Footer (الزر الجديد) --}}
                        <div class="notification-footer p-2 border-top text-center bg-light"
                            style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                            <a href="{{ route('notifications.index') }}"
                                class="btn btn-link btn-sm text-primary fw-bold text-decoration-none">
                                Show all notifications <i class="mdi mdi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="icon-mail icon-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                        aria-labelledby="countDropdown">
                        <a class="dropdown-item py-3">
                            <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
                            <span class="badge badge-pill badge-primary float-end">View all</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face10.jpg') }}" alt="image"
                                    class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face12.jpg') }}" alt="image"
                                    class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face1.jpg') }}" alt="image"
                                    class="img-sm profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow py-2">
                                <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
                                <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="img-xs rounded-circle" src="{{ Auth()->user()->doctor->image_url }}"
                            alt="Profile image"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-xs rounded-circle" src="{{ Auth()->user()->doctor->image_url }}"
                                alt="Profile image">
                            <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('doc.profile.edit') }}" class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Edit Profile</a>
                        <a class="dropdown-item"><i
                                class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                            Messages</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                                Out</button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
