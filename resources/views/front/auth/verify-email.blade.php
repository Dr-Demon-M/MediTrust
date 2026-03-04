@extends('layouts.frontLayout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Confirm Email</li>
                    </ol>
                </nav>
            </div>

            <div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-5">
                            <div class="auth-card shadow-lg p-5 text-center" data-aos="zoom-in">
                                <div class="auth-icon mb-4">
                                    <i class="bi bi-envelope-check text-primary fs-1"></i>
                                </div>

                                <h3 class="fw-bold text-dark mb-3">Verify Your Email</h3>
                                <p class="text-muted">
                                    Thanks for signing up with <strong>MediTrust Clinic</strong>! <br>
                                    Before getting started, could you verify your email address by clicking on the link we
                                    just emailed to you?
                                </p>

                                @if (session('status') == 'verification-link-sent')
                                    <div style="opacity: 1 !important;" class="alert alert-success small mb-4" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        A new verification link has been sent to the email address you provided during
                                        registration.
                                    </div>
                                @endif

                                <div class="mt-4 d-grid gap-2">
                                    <form method="POST" action="{{ route('front.verification.send') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-auth-primary w-100 py-2 fw-bold">
                                            Resend Verification Email
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-secondary w-100 py-2 mt-2 small">
                                            <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
