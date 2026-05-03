@extends('shared.base', ['title' => 'Reset Password']) @section('styles') @endsection @section('content')
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
                                    <h4 class="fw-bold mt-4">Forgot Password ?</h4>
                                    <p class="text-muted w-lg-75 mx-auto">Enter your email address and we'll send you a link to reset your password.</p>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="userEmail">
                                            Email address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="app-search">
                                            <input class="form-control" id="userEmail" placeholder="you@example.com" required="" type="email" />
                                            <i class="ti ti-mail app-search-icon text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input-light fs-14" id="termAndPolicy" type="checkbox" />
                                            <label class="form-check-label" for="termAndPolicy">Agree the Terms &amp; Policy</label>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary fw-semibold py-2" type="submit">Send Request</button>
                                    </div>
                                </form>
                                <p class="text-muted text-center mt-4 mb-0">
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
@include('shared.partials.footer-scripts') @endsection @section('scripts') @endsection
