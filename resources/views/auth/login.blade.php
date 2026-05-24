@extends('shared.base', ['title' => 'Sign In']) 

@section('styles') 
<style>
    .auth-bg { 
        background: linear-gradient(135deg, #fce4ec 0%, #f3e5f5 50%, #e1f5fe 100%); 
        min-height: 100vh; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        position: relative;
        overflow: hidden;
    }
    .auth-card { 
        border-radius: 24px; 
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1); 
        background: rgba(255, 255, 255, 0.85); 
        backdrop-filter: blur(20px);
        width: 100%; 
        max-width: 440px;
        padding: 45px;
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.7);
    }
    .auth-brand img { max-height: 50px; }
    .form-control, .form-select { border-radius: 12px; padding: 12px 15px; border: 1px solid #e0e0e0; font-size: 0.95rem; }
    .btn-primary { 
        border-radius: 12px; 
        padding: 14px; 
        font-weight: bold; 
        background: linear-gradient(135deg, #c1097a, #7b1fa2); 
        border: none; 
        box-shadow: 0 4px 15px rgba(193, 9, 122, 0.3);
        transition: all 0.3s ease;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(193, 9, 122, 0.4); opacity: 0.95; }
    .bg-shape {
        position: absolute;
        background: radial-gradient(circle, rgba(193, 9, 122, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        z-index: 1;
        filter: blur(50px);
    }
    .shape-1 { width: 600px; height: 600px; top: -300px; right: -200px; }
    .shape-2 { width: 400px; height: 400px; bottom: -200px; left: -150px; }
    .cursor-pointer { cursor: pointer; }
    #togglePassword { 
        border-left: none; 
        background: #fdfdfd;
        color: #888;
        border-color: #e0e0e0;
    }
    #togglePassword:hover { color: #c1097a; }
    .auth-brand h2 { 
        background: linear-gradient(to right, #c1097a, #7b1fa2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.5px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #c1097a;
        box-shadow: 0 0 0 3px rgba(193, 9, 122, 0.1);
    }
    
    /* Preloader Styles */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }
    
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(193, 9, 122, 0.1);
        border-left-color: #c1097a;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .btn-loading {
        position: relative;
        color: transparent !important;
        pointer-events: none;
    }
    
    .btn-loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-top: -10px;
        margin-left: -10px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s linear infinite;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection 

@section('content')
<!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
</div>

<div class="auth-bg">
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    
    <div class="auth-card mx-auto">
        <div class="auth-brand text-center mb-5">
            <div class="mb-4">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Sri Vaarahi Matrimony" class="img-fluid" style="max-height: 80px; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));">
            </div>
            <h2 class="fw-bold mb-2">LET'S GET STARTED NOW!</h2>
            <h5 class="text-dark fw-bold">Login and find your life partner</h5>
            <p class="text-muted small px-3">Access your account to connect with potential matches.</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4 py-2 small">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4 py-2 small">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold">Login As</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ti ti-users fs-18"></i></span>
                    <select name="role" class="form-select border-start-0 ps-1" required>
                        <option value="customer">Customer</option>
                        <option value="admin" selected>Administrator</option>
                        <option value="staff">Staff</option>
                        <option value="mediator">Mediator</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Email / Mobile No / MID</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ti ti-user fs-18"></i></span>
                    <input type="text" name="username" class="form-control border-start-0 ps-1" placeholder="Enter Email or Mobile No" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-bold mb-0">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ti ti-lock fs-18"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0 ps-1" placeholder="••••••••" required>
                    <span class="input-group-text bg-white border-start-0 cursor-pointer" id="togglePassword">
                        <i class="ti ti-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label small" for="remember">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-muted small">Forgot Password ?</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary shadow-sm py-2 fw-bold">Login</button>
            </div>

            <div class="mt-4 text-center">
                <p class="text-muted small mb-0">New to {{ \App\Models\Setting::get('site_name', 'Vaarahi Matrimony') }} ? <a href="{{ route('register') }}" class="text-primary fw-bold">Register Free</a></p>
            </div>
        </form>
    </div>
</div>

@include('shared.partials.footer-scripts') 
@endsection

@section('scripts') 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hide Preloader
        const preloader = document.getElementById('preloader');
        setTimeout(() => {
            if(preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => { preloader.style.display = 'none'; }, 500);
            }
        }, 300);

        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'text') {
                    eyeIcon.classList.remove('ti-eye');
                    eyeIcon.classList.add('ti-eye-off');
                } else {
                    eyeIcon.classList.remove('ti-eye-off');
                    eyeIcon.classList.add('ti-eye');
                }
            });
        }

        // Form Submit Loading
        const loginForm = document.querySelector('form');
        const loginBtn = loginForm.querySelector('button[type="submit"]');

        if(loginForm) {
            loginForm.addEventListener('submit', function() {
                loginBtn.classList.add('btn-loading');
                loginBtn.innerText = ''; // Hide text to show spinner
            });
        }
    });
</script>
@endsection
