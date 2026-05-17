@extends('layouts.app')
@section('title', 'Profile Settings')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-flex align-items-center mb-4">
            <h2 class="fw-bold mb-0">
                <i class="fa-solid fa-user-gear me-2 text-success"></i>
                Profile Settings
            </h2>
        </div>

        {{-- Update Profile Info --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-circle-info me-2 text-success"></i>
                    Personal Information
                </h5>
                <p class="text-muted small mb-0 mt-1">Update your name and email address.</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}"
                               required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Save Changes
                        </button>
                        @if(session('status') === 'profile-updated')
                            <span class="text-success small">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                Profile updated successfully!
                            </span>
                        @endif
                    </div>

                </form>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-lock me-2 text-warning"></i>
                    Update Password
                </h5>
                <p class="text-muted small mb-0 mt-1">Use a strong password to keep your account secure.</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Password</label>
                        <input type="password"
                               name="current_password"
                               class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                               autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                               autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Confirm New Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               autocomplete="new-password">
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fa-solid fa-key me-1"></i>
                            Update Password
                        </button>
                        @if(session('status') === 'password-updated')
                            <span class="text-success small">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                Password updated successfully!
                            </span>
                        @endif
                    </div>

                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="card border-0 shadow-sm border-danger">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-danger">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    Delete Account
                </h5>
                <p class="text-muted small mb-0 mt-1">
                    Once deleted, all your data will be permanently removed.
                </p>
            </div>
            <div class="card-body p-4">
                <button type="button"
                        class="btn btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteAccountModal">
                    <i class="fa-solid fa-trash me-1"></i>
                    Delete My Account
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Delete Account Modal --}}
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fa-solid fa-trash me-2"></i>
                    Delete Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <i class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                <p class="fs-5 mb-1">Are you absolutely sure?</p>
                <p class="text-muted small">
                    This action cannot be undone. All your tasks and data will be permanently deleted.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}" class="mt-3">
                    @csrf
                    @method('delete')

                    <div class="mb-3 text-start">
                        <label class="form-label fw-semibold">
                            Enter your password to confirm:
                        </label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                               placeholder="Your current password">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fa-solid fa-trash me-1"></i> Yes, Delete Account
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection