@extends('shared.base', ['title' => 'Success Mail']) @section('styles') @endsection @section('content')
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
                                </div>
                                <form>
                                    <div class="mb-4">
                                        <div class="avatar-xxl mx-auto mt-2">
                                            <div class="avatar-title bg-light-subtle border border-light border-dashed rounded-circle">
                                                <img alt="dark logo" height="64" src="/images/checkmark.png" />
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-center mb-4">Well Done! Email verified Successfully</h4>
                                    <div class="d-grid">
                                        <button class="btn btn-primary fw-semibold py-2" type="submit">Back to Dashboard</button>
                                    </div>
                                </form>
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
