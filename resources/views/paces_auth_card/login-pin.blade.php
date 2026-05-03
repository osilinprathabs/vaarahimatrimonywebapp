@extends('shared.base', ['title' => 'Login with Pin']) @section('styles') @endsection @section('content')
<div class="position-absolute top-0 end-0">
    <img alt="auth-card-bg" class="auth-card-bg-img" src="/images/auth-card-bg.svg" />
</div>
<div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
    <img alt="auth-card-bg" class="auth-card-bg-img" src="/images/auth-card-bg.svg" />
</div>
<div class="auth-box d-flex align-items-center">
    <div class="container-xxl">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-10">
                <div class="card">
                    <div class="row justify-content-between g-0">
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div class="auth-brand text-center mb-4 position-relative">
                                    <a class="logo-dark" href="{{ url('/') }}">
                                        <img alt="dark logo" src="/images/logo-black.png" />
                                    </a>
                                    <a class="logo-light" href="{{ url('/') }}">
                                        <img alt="logo" src="/images/logo.png" />
                                    </a>
                                    <h4 class="fw-bold mt-4">Welcome to Admin</h4>
                                    <p class="text-muted w-lg-75 mx-auto">This screen is locked. Enter your PIN to continue.</p>
                                </div>
                                <div class="text-center mb-4">
                                    <img alt="thumbnail" class="rounded-circle img-thumbnail avatar-xxl mb-2" src="/images/users/user-1.jpg" />
                                    <h5 class="fs-md">David Dev</h5>
                                </div>
                                <form>
                                    <label class="form-label">
                                        Enter your 6-digit code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex gap-2 mb-3 two-factor">
                                        <input class="form-control text-center" required="" type="text" />
                                        <input class="form-control text-center" required="" type="text" />
                                        <input class="form-control text-center" required="" type="text" />
                                        <input class="form-control text-center" required="" type="text" />
                                        <input class="form-control text-center" required="" type="text" />
                                        <input class="form-control text-center" required="" type="text" />
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary fw-semibold py-2" type="submit">Confirm</button>
                                    </div>
                                </form>
                                <p class="text-muted text-center mt-4 mb-0">
                                    Not you? Return to
                                    <a class="text-decoration-underline link-offset-3 fw-semibold" href="{{ url('/auth-card/sign-in') }}">Sign in</a>
                                </p>
                                <p class="text-center text-muted mt-4 mb-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    Paces — by
                                    <span class="fw-bold">Coderthemes</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="h-100 position-relative card-side-img rounded-end overflow-hidden" style="background-image: url(&quot;/images/auth.jpg&quot;)">
                                <div class="p-4 card-img-overlay rounded-end auth-overlay d-flex align-items-end justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end auth-fluid-->
<!-- footer-scripts -->
@include('shared.partials.footer-scripts')

<!-- Two Factor Validator Js -->
@endsection @section('scripts') @vite(['resources/js/pages/auth-two-factor.js']) @endsection
