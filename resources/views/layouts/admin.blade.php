<!DOCTYPE html>
<html lang="en" data-menu-color="dark" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <title>{{ \App\Models\Setting::get('site_name', 'Vaarahi Matrimony') }} | Admin</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link href="{{ asset(\App\Models\Setting::get('favicon', 'images/favicon.ico')) }}" rel="shortcut icon"/>

    @yield('styles')

    @include('shared.partials.head-css')

    <style>
        .content-page { margin-left: 260px; transition: all .2s ease-out; padding: 70px 15px 60px 15px; }
        @media (max-width: 767.98px) { .content-page { margin-left: 0; } }
        .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; display: flex; align-items: center; justify-content: center; z-index: 9999; transition: opacity 0.5s ease-out;">
        <div class="text-center">
            @if(\App\Models\Setting::get('favicon'))
                <img src="{{ asset(\App\Models\Setting::get('favicon')) }}" alt="Favicon" class="mb-3 animate-pulse" style="width: 64px;">
            @else
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
            @endif
            <div class="mt-3 fw-bold text-primary fs-18">{{ \App\Models\Setting::get('site_name', 'Vaarahi Matrimony') }}</div>
        </div>
    </div>

    <!-- Begin page -->
    <div class="wrapper">
        @include('shared.partials.topbar')
        @include('shared.partials.sidenav')

        <div class="content-page">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="py-3">
                    @yield('content')
                </div>
            </div>

            @include('shared.partials.footer')
        </div>
    </div>

    @include('shared.partials.footer-scripts')

    @yield('scripts')

</body>
</html>
