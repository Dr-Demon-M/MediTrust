    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                {{-- <img src="{{ asset('assets/img/logo.webp') }}" alt="">  --}}
                <svg class="my-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="bgCarrier" stroke-width="0"></g>
                    <g id="tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="iconCarrier">
                        <path d="M22 22L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M17 22V6C17 4.11438 17 3.17157 16.4142 2.58579C15.8284 2 14.8856 2 13 2H11C9.11438 2 8.17157 2 7.58579 2.58579C7 3.17157 7 4.11438 7 6V22"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path opacity="0.5"
                            d="M21 22V8.5C21 7.09554 21 6.39331 20.6629 5.88886C20.517 5.67048 20.3295 5.48298 20.1111 5.33706C19.6067 5 18.9045 5 17.5 5"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path opacity="0.5"
                            d="M3 22V8.5C3 7.09554 3 6.39331 3.33706 5.88886C3.48298 5.67048 3.67048 5.48298 3.88886 5.33706C4.39331 5 5.09554 5 6.5 5"
                            stroke="currentColor" stroke-width="1.5"></path>
                        <path d="M12 22V19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                        <path opacity="0.5" d="M10 12H14" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M5.5 11H7" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M5.5 14H7" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M17 11H18.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M17 14H18.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M5.5 8H7" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M17 8H18.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path opacity="0.5" d="M10 15H14" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round"></path>
                        <path d="M12 9V5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M14 7L10 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>

                <h1 class="sitename">MediTrust</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('front.home') }}"
                            class="{{ request()->routeIs('front.home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('front.about.index') }}"
                            class="{{ request()->routeIs('front.about.index') ? 'active' : '' }}">About</a></li>
                    <li><a href="{{ route('front.departments.index') }}"
                            class="{{ request()->routeIs('front.departments.index', 'front.departments.show') ? 'active' : '' }}">Departments</a>
                    </li>
                    <li><a href="{{ route('front.services.index') }}"
                            class="{{ request()->routeIs('front.services.index') ? 'active' : '' }}">Services</a></li>
                    <li><a href="{{ route('front.doctors.index') }}"
                            class="{{ request()->routeIs('front.doctors.index') ? 'active' : '' }}">Doctors</a></li>
                    <li class="dropdown"><a href="#"><span>More Pages</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="{{ route('front.faq.index') }}">Frequently Asked Questions</a></li>
                            <li><a href="{{ route('front.terms.index') }}">Terms</a></li>
                            <li><a href="{{ route('front.privacy.index') }}">Privacy</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            @if (!Auth::guard('patient')->check())
                <div class="d-flex align-items-center">
                    <a class="btn-getstarted d-none d-sm-block"
                        href="{{ route('front.appointments.create') }}">Appointment</a>
                    <div>
                        <a href="{{ route('front.login') }}" class="ms-2">
                            <i class="fa-regular fa-user shadow-sm"
                                style="margin-right: 10px; height: 40px;width: 40px;padding: 9px;color: var(--accent-color);font-size: 19px;border: 1px solid #eee;border-radius: 50%;"></i>
                        </a>
                    </div>
                </div>
            @else
                <div class="dropdown patient-profile-dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center p-0 border-0" type="button"
                        id="patientMenu" data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="avatar-circle">
                            @if (Auth::guard('patient')->user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::guard('patient')->user()->profile_image) }}"
                                    class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="fa-regular fa-user"></i>
                            @endif
                        </div>

                        <span class="patient-name fw-bold d-none d-md-inline ms-2">
                            {{ Auth::guard('patient')->user()->name }}
                        </span>
                        <i class="bi bi-chevron-down ms-1 small-arrow d-none d-md-inline"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="patientMenu">
                        <li class="d-md-none p-3 border-bottom mb-2">
                            <span class="fw-bold text-dark">{{ Auth::guard('patient')->user()->name }}</span>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2"
                                href="{{ route('front.profile.index') }}">
                                <i class="bi bi-person-bounding-box me-2 text-primary"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2"
                                href="{{ route('front.appointments.index') }}">
                                <i class="bi bi-calendar-week-fill me-2 text-secondary"></i>
                                <span>My Appointments</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2"
                                href="{{ route('front.appointments.create') }}">
                                <i class="bi bi-calendar-plus me-2 text-success"></i>
                                <span>New Appointment</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('front.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item d-flex align-items-center py-2 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
    </header>
