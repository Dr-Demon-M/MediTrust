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
                        <li class="breadcrumb-item active current">Login</li>
                    </ol>
                </nav>
            </div>

            <div class="auth-wrapper d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 col-lg-4">
                            <div class="auth-card shadow-lg p-4" data-aos="fade-up">
                                <div class="auth-header text-center mb-4">
                                    <div class="auth-icon mb-3">
                                        <i class="bi bi-person-lock text-primary fs-1"></i>
                                    </div>
                                    <h3 class="fw-bold text-dark">Welcome Back</h3>
                                    <p class="text-muted small">Please enter your details to login</p>
                                </div>

                                <form action="{{ route('front.login') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="guard" value="patient">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i
                                                    class="bi bi-envelope text-muted"></i></span>
                                            <input type="email" name="email" class="form-control border-start-0 ps-0"
                                                placeholder="name@example.com" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label small fw-bold">Password</label>
                                            <a href="{{ route('front.password.request') }}" class="text-primary small text-decoration-none">Forgot?</a>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i
                                                    class="bi bi-key text-muted"></i></span>
                                            <input type="password" name="password" class="form-control border-start-0 ps-0"
                                                placeholder="••••••••" required>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="remember">
                                        <label class="form-check-label small" for="remember">Remember me</label>
                                    </div>

                                    <button type="submit" class="btn btn-auth-primary w-100 py-2 fw-bold">
                                        Login <i class="bi bi-arrow-right ms-2"></i>
                                    </button>

                                    <div class="text-center mt-4">
                                        <p class="small text-muted mb-0">Don't have an account?</p>
                                        <a href="{{ route('front.register') }}"
                                            class="text-primary fw-bold text-decoration-none">Create New
                                            Account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
