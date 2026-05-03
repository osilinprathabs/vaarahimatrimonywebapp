@extends('shared.base', ['title' => 'Create New Account']) @section('styles') @endsection @section('content')
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
                                    <h4 class="fw-bold mt-4">Create New Account</h4>
                                    <p class="text-muted w-lg-75 mx-auto">Let’s get you started. Create your account by entering your details below.</p>
                                </div>
                                <div class="row text-muted g-2">
                                    <div class="col-lg-6">
                                        <a class="btn btn-default w-100" href="#!">
                                            <svg class="me-1" height="14px" viewbox="0 0 256 262" width="13.68px" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285f4"></path>
                                                <path
                                                    d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                                    fill="#34a853"
                                                ></path>
                                                <path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z" fill="#fbbc05"></path>
                                                <path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#eb4335"></path>
                                            </svg>
                                            Sign up with Google
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a class="btn btn-default w-100" href="#!">
                                            <svg class="me-1" height="14px" viewbox="0 0 64 64" width="14px" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M32 0C14 0 0 14 0 32c0 21 19 30 22 30c2 0 2-1 2-2v-5c-7 2-10-2-11-5c0 0 0-1-2-3c-1-1-5-3-1-3c3 0 5 4 5 4c3 4 7 3 9 2c0-2 2-4 2-4c-8-1-14-4-14-15q0-6 3-9s-2-4 0-9c0 0 5 0 9 4c3-2 13-2 16 0c4-4 9-4 9-4c2 7 0 9 0 9q3 3 3 9c0 11-7 14-14 15c1 1 2 3 2 6v8c0 1 0 2 2 2c3 0 22-9 22-30C64 14 50 0 32 0"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                            Sign up with Github
                                        </a>
                                    </div>
                                </div>
                                <p class="text-center text-muted my-3 auth-line">
                                    <span>Continue with Email</span>
                                </p>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label" for="userName">
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="app-search">
                                            <input class="form-control" id="userName" placeholder="David Dev" required="" type="text" />
                                            <i class="ti ti-user app-search-icon text-muted"></i>
                                        </div>
                                    </div>
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
                                    <div class="mb-3" data-password="bar">
                                        <label class="form-label" for="userPassword">
                                            Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="app-search">
                                            <input class="form-control" id="userPassword" placeholder="••••••••" required="" type="password" />
                                            <i class="ti ti-lock-password app-search-icon text-muted"></i>
                                        </div>
                                        <div class="password-bar my-2"></div>
                                        <p class="text-muted fs-xs mb-0">Use 8+ characters with letters, numbers &amp; symbols.</p>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input checked="" class="form-check-input form-check-input-light fs-14" id="termAndPolicy" type="checkbox" />
                                            <label class="form-check-label" for="termAndPolicy">Agree the Terms &amp; Policy</label>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary fw-semibold py-2" type="submit">Create Account</button>
                                    </div>
                                </form>
                                <p class="text-muted text-center mt-4 mb-0">
                                    Already have an account?
                                    <a class="text-decoration-underline link-offset-3 fw-semibold" href="{{ url('/auth-card/sign-in') }}">Login</a>
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

<!-- Password Suggestion Js -->
@endsection @section('scripts') @vite(['resources/js/pages/auth-password.js']) @endsection
