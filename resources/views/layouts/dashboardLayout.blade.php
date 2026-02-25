<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MediTrust</title>
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    @stack('styles')
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
            </div>
        </div>
        <x-dashboard.nav />
        <div class="container-fluid page-body-wrapper">
            <x-dashboard.side />
            <x-alert />
            @yield('content')
        </div>
    </div>
    @vite(['resources/js/app.js'])

    <script>
        window.userId = {{ auth()->user()->doctor->id }};
    </script>
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            if (!window.Echo || !window.userId) {
                console.error('Echo or userId not ready');
                return;
            }

            window.Echo.private(`App.Models.Doctor.${window.userId}`)
                .notification((notification) => {

                    console.log('Realtime notification:', notification);

                    // تحديث العداد
                    let badge = document.querySelector('.notification-badge');
                    let count = badge ? parseInt(badge.innerText) : 0;

                    if (badge) {
                        badge.innerText = count + 1;
                    } else {
                        document.querySelector('#notificationDropdown')
                            .insertAdjacentHTML('beforeend',
                                `<span class="notification-badge">1</span>`
                            );
                    }
                    let dropdownBadge = document.getElementById('dropdownNotificationCount');

                    if (dropdownBadge) {
                        let current = parseInt(dropdownBadge.innerText || 0);
                        dropdownBadge.innerText = current + 1;
                    }
                    // 🔥 هنا التصحيح
                    let container = document.querySelector('.notification-body');

                    if (!container) {
                        console.error('Notification container not found');
                        return;
                    }

                    let html = `
                <a href="/appointments/${notification.appointment_id}"
                   class="notification-item unread d-flex px-4 py-3">

                    <div class="notification-icon me-3">
                        <i class="mdi mdi-calendar-check"></i>
                    </div>

                    <div>
                        <div class="notification-title">
                            Appointment Updated
                        </div>

                        <div class="notification-subtitle">
                            ${notification.patient_name}
                        </div>

                        <div class="notification-time">
                            Just now
                        </div>
                    </div>
                </a>
            `;

                    container.insertAdjacentHTML('afterbegin', html);
                });

        });
    </script>
</body>

</html>
