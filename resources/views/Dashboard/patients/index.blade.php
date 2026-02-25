@extends('layouts.dashboardLayout')

@section('content')
    <div class="row full-width-container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm p-5" style="border-radius: 20px; border: none;">
                <div class="card-body">
                    {{-- أيقونة تعبيرية --}}
                    <div class="mb-4">
                        <i class="mdi mdi-wrench-outline text-primary" style="font-size: 80px; opacity: 0.8;"></i>
                    </div>

                    {{-- العنوان --}}
                    <h2 class="fw-bold text-dark mb-3">Section Under Maintenance</h2>

                    {{-- الوصف --}}
                    <p class="text-muted mb-4 fs-5">
                        We're currently fine-tuning this part of the clinic system to provide you with a better experience.
                        <br> It will be back online shortly!
                    </p>

                    {{-- مؤشر تقدم بسيط --}}
                    <div class="progress mb-4 mx-auto" style="height: 10px; width: 60%; border-radius: 10px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
                            style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>

                    {{-- زر العودة --}}
                    <div class="mt-5">
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5 text-white shadow-sm"
                            style="border-radius: 10px;">
                            <i class="mdi mdi-home me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            {{-- نص سفلي صغير --}}
            <p class="text-muted mt-4 small">
                &copy; {{ date('Y') }} Clinic Management System. All rights reserved.
            </p>
        </div>
    </div>
@endsection
