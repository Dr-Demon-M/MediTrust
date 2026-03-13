@extends('layouts.frontLayout')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active current">Security</li>
                    </ol>
                </nav>
            </div>

            <div class="row justify-content-center g-4">

                {{-- Section 1: Profile Information --}}
                <div class="col-md-8">
                    <div class="card shadow-sm border-0 bg-white mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box me-3">
                                    <i class="mdi mdi-information-outline text-primary fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0 fw-bold">Profile Information</h5>
                            </div>

                            <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                                @csrf
                                @method('patch')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">Full Name</label>
                                        <input type="text" name="name" class="form-control border-0 bg-light py-2"
                                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">Email Address</label>
                                        <input type="email" name="email" class="form-control border-0 bg-light py-2"
                                            value="{{ old('email', $user->email) }}" required autocomplete="username">
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill">Save Changes</button>
                                    @if (session('status') === 'profile-updated')
                                        <span class="text-success small animate__animated animate__fadeOut animate__delay-2s">
                                            <i class="mdi mdi-check-circle me-1"></i>Saved successfully.
                                        </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Section 2: Update Password --}}
                    <div class="card shadow-sm border-0 bg-white mb-4" style="border-radius: 20px;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-box me-3">
                                    <i class="mdi mdi-lock-outline text-warning fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0 fw-bold">Update Password</h5>
                            </div>

                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Current Password</label>
                                    <input type="password" name="current_password"
                                        class="form-control border-0 bg-light py-2" autocomplete="current-password">
                                    @error('current_password', 'updatePassword') <span
                                    class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">New Password</label>
                                        <input type="password" name="password" class="form-control border-0 bg-light py-2"
                                            autocomplete="new-password">
                                        @error('password', 'updatePassword') <span
                                        class="text-danger small">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">Confirm New Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control border-0 bg-light py-2" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3 mt-3">
                                    <button type="submit" class="btn btn-dark px-4 rounded-pill">Update Password</button>
                                    @if (session('status') === 'password-updated')
                                        <span class="text-success small animate__animated animate__fadeOut animate__delay-2s">
                                            <i class="mdi mdi-check-circle me-1"></i>Password updated.
                                        </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Section 3: Danger Zone (Delete Account) --}}
                    <div class="card shadow-sm border-0 bg-white"
                        style="border-radius: 20px; border-left: 5px solid #dc3545 !important;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box me-3 bg-soft-danger">
                                    <i class="mdi mdi-alert-outline text-danger fs-4"></i>
                                </div>
                                <h5 class="card-title mb-0 fw-bold text-danger">Danger Zone</h5>
                            </div>

                            <p class="text-muted small">Once your account is deleted, all data will be permanently removed.
                                Please be certain.</p>

                            <button type="button" class="btn btn-outline-danger btn-sm px-4 rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete Confirmation Modal --}}
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0" style="border-radius: 20px;">
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                        @csrf
                        @method('delete')

                        <h5 class="fw-bold text-dark">Are you absolutely sure?</h5>
                        <p class="text-muted small">Please enter your password to confirm account deletion.</p>

                        <div class="mt-3">
                            <input type="password" name="password" class="form-control border-0 bg-light py-2"
                                placeholder="Your Password" required>
                            @error('password', 'userDeletion') <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger rounded-pill px-4">Yes, Delete My Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection