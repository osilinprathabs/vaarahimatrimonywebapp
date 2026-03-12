@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Change Password</h2>
</header>

<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Update Admin Password</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" action="{{ route('admin.change_password.submit') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label">Username</label>
                        <div class="col-md-6">
                            <input type="text" name="username" class="form-control" value="{{ session('admin_username') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Current Password</label>
                        <div class="col-md-6">
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">New Password</label>
                        <div class="col-md-6">
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm New Password</label>
                        <div class="col-md-6">
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
