@extends('shared.base', ['title' => 'Two Factor Authentication']) @section('styles') @endsection @section('content')
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
                                    <h4 class="fw-bold mt-4">Request sent Successfully!</h4>
                                </div>
                                <div class="text-center mb-4">
                                    <h5 class="text-muted fs-base mb-3">We've emailed you a 6-digit verification code we sent to</h5>
                                    <div class="fw-bold fs-3">******6789</div>
                                </div>
                                <form>
                                    <label class="form-label">
                                        Enter your 6-digit code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex gap-2 two-factor mb-3">
                                        <input class="form-control text-center" required="" type="password" />
                                        <input class="form-control text-center" required="" type="password" />
                                        <input class="form-control text-center" required="" type="password" />
                                        <input class="form-control text-center" required="" type="password" />
                                        <input class="form-control text-center" required="" type="password" />
                                        <input class="form-control text-center" required="" type="password" />
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary fw-semibold py-2" type="submit">Confirm</button>
                                    </div>
                                </form>
                                <p class="mt-4 text-muted text-center mb-4">
                                    Don’t have a code?
                                    <a class="text-decoration-underline link-offset-2 fw-semibold" href="#">Resend</a>
                                    or
                                    <a class="text-decoration-underline link-offset-2 fw-semibold" href="#">Call Us</a>
                                </p>
                                <p class="text-muted text-center mb-0">
                                    Return to
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
