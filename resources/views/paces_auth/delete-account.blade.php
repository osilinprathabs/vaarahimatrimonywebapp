@extends('shared.base', ['title' => 'Delete Account']) @section('styles') @endsection @section('content')
<div class="position-absolute top-0 end-0">
    <img alt="auth-card-bg" class="auth-card-bg-img" src="/images/auth-card-bg.svg" />
</div>
<div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
    <img alt="auth-card-bg" class="auth-card-bg-img" src="/images/auth-card-bg.svg" />
</div>
<div class="auth-box overflow-hidden align-items-center d-flex">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-md-6 col-sm-8">
                <div class="card p-4">
                    <div class="auth-brand text-center mb-3 position-relative">
                        <a class="logo-dark" href="{{ url('/') }}">
                            <img alt="dark logo" src="/images/logo-black.png" />
                        </a>
                        <a class="logo-light" href="{{ url('/') }}">
                            <img alt="logo" src="/images/logo.png" />
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="avatar-xxl mx-auto mt-2">
                            <div class="avatar-title bg-light-subtle border border-light border-dashed rounded-circle">
                                <img alt="dark logo" height="64" src="/images/delete.png" />
                            </div>
                        </div>
                    </div>
                    <h4 class="fw-bold text-center mb-3">Account Deactivated</h4>
                    <p class="text-muted text-center mb-4">Your account is currently inactive. Reactivate now to regain access to all features and opportunities.</p>
                    <div class="d-grid">
                        <button class="btn btn-primary fw-semibold py-2" type="submit">Reactivate Now</button>
                    </div>
                </div>
                <p class="text-center text-muted mt-4 mb-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    Paces — by
                    <span class="fw-semibold">Coderthemes</span>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end auth-fluid-->
<!-- end auth-fluid-->
<!-- footer-scripts -->
@include('shared.partials.footer-scripts') @endsection @section('scripts') @endsection
