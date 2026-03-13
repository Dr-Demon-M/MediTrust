<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas no-print m-1" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-stethoscope menu-icon"></i>
                <span class="menu-title">{{ __('Doctors') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('doctors.index') }}">{{ __('All Doctors') }}</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('availability.index') }}">{{ __('Availability Schedule') }}</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="mdi mdi-hospital-building menu-icon"></i>
                <span class="menu-title">{{ __('Specialties') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('specialties.index') }}">{{ __('All Specialties') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="mdi mdi-medical-bag menu-icon"></i>
                <span class="menu-title">{{ __('Services') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    @if($user->role === 'super_admin')
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('services.index') }}">{{ __('All Services') }}</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('services.featured') }}">{{ __('Featured Services') }}</a>
                        </li>
                    @endif
                    @if($user->role === 'doctor')
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('specialty.services') }}">{{ $user->doctor->specialty->name . ' Services' }}</a>
                        </li>
                    @endif

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="mdi mdi-calendar-check menu-icon"></i>
                <span class="menu-title">{{ __('Appointments') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('appointments.index') }}">{{ __('All Appointments') }}</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('appointments.today') }}">{{ __('Today’s Appointments') }}</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('appointments.pending') }}">{{ __('Pending Requests') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="mdi mdi-account-injury menu-icon"></i>
                <span class="menu-title">{{ __('Patients') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('patients.index') }}">{{ __('All Patients') }}</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('patients.consultation') }}">{{ __('Consultation') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank
                            Page </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register
                        </a></li>
                </ul>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('chat.index') }}">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Chats</span>
            </a>
        </li> --}}

    </ul>
</nav>
<!-- partial -->