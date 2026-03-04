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
                        <li class="breadcrumb-item active current">Register</li>
                    </ol>
                </nav>
            </div>
            <div class="auth-wrapper d-flex align-items-center justify-content-center py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-5">
                            <div class="auth-card shadow-lg p-4" data-aos="fade-up">
                                <div class="auth-header text-center mb-4">
                                    <div class="auth-icon mb-2">
                                        <i class="bi bi-person-plus text-primary fs-1"></i>
                                    </div>
                                    <h3 class="fw-bold text-dark">Join MediTrust</h3>
                                    <p class="text-muted small">Access your medical history and book appointments</p>
                                </div>

                                <form action="{{ route('front.register') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Full Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Your Name..."
                                                required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold">Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="name@example.com" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label small fw-bold">Phone</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="+20..."
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="••••••••" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="••••••••" required>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" class="btn btn-auth-primary w-100 py-2 fw-bold">
                                                Register Account
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <p class="small text-muted mb-0">Already have an account?</p>
                                        <a href="{{ route('front.login') }}" class="text-primary fw-bold text-decoration-none">Back to
                                            Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
