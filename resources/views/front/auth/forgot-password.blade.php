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
                        <li class="breadcrumb-item active current">Forgot Password</li>
                    </ol>
                </nav>
            </div>
            <div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 col-lg-4">
                            <div class="auth-card shadow-lg p-4" data-aos="fade-up">
                                <div class="auth-header text-center mb-4">
                                    <div class="auth-icon mb-3">
                                        <i class="bi bi-shield-lock text-primary fs-1"></i>
                                    </div>
                                    <h3 class="fw-bold text-dark">Reset Password</h3>
                                    <p class="text-muted small">Enter your email and we'll send you a link to reset your
                                        password.</p>
                                </div>

                                @if (session('status'))
                                    <div style="opacity: 1;" class="alert alert-success small mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form action="{{ route('front.password.email') }}" method="POST">
                                    @csrf
                                    <div class="mb-4 text-start">
                                        <label class="form-label small fw-bold">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i
                                                    class="bi bi-envelope text-muted"></i></span>
                                            <input type="email" name="email" class="form-control border-start-0 ps-0"
                                                placeholder="yourname@example.com" required>
                                        </div>
                                        @error('email')
                                            <span class="text-danger small mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-auth-primary w-100 py-2 fw-bold">
                                        Send Reset Link <i class="bi bi-send ms-2"></i>
                                    </button>

                                    <div class="text-center mt-4 border-top pt-3">
                                        <p class="small text-muted mb-0">Remembered your password?</p>
                                        <a href="#" class="text-primary fw-bold text-decoration-none small">
                                            <i class="bi bi-arrow-left me-1"></i> Back to Login
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
