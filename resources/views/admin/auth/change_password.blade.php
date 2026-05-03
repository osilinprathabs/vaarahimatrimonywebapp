@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Admin Profile</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">Manage Account Settings</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.change_password.submit') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Admin Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-user"></i></span>
                            <input type="text" name="username" class="form-control" value="{{ session('admin_username') }}" required>
                        </div>
                        <small class="text-muted">This is your login identifier.</small>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-lock"></i></span>
                            <input type="password" name="current_password" class="form-control" required placeholder="Enter current password to authorize changes">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-key"></i></span>
                            <input type="password" name="new_password" class="form-control" placeholder="Leave blank to keep current password">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-key"></i></span>
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Repeat new password">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="border-radius: 8px;">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card border-0 shadow-sm bg-info text-white" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-25 rounded fs-3">
                            <i class="ti ti-shield-lock"></i>
                        </span>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Security Notice</h5>
                    </div>
                </div>
                <p class="mb-0">Updating your credentials will affect your next login session. Ensure you remember your new password. For security reasons, we require your current password to make any changes to your profile.</p>
            </div>
        </div>
    </div>
</div>
@endsection
