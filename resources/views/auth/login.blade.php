@extends('shared.base', ['title' => 'Sign In']) 

@section('styles') 
<style>
    .auth-bg { 
        background: #f4f7fa; 
        min-height: 100vh; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        position: relative;
        overflow: hidden;
    }
    .auth-card { 
        border-radius: 20px; 
        box-shadow: 0 15px 35px rgba(0,0,0,0.05); 
        background: rgba(255, 255, 255, 0.9); 
        backdrop-filter: blur(10px);
        width: 100%; 
        max-width: 420px;
        padding: 40px;
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    .auth-brand img { max-height: 50px; }
    .form-control { border-radius: 10px; padding: 12px; border: 1px solid #e1e8ef; }
    .btn-primary { border-radius: 10px; padding: 12px; font-weight: bold; background: #c1097a; border: none; }
    .bg-shape {
        position: absolute;
        background: radial-gradient(circle, rgba(193, 9, 122, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        z-index: 1;
    }
    .shape-1 { width: 600px; height: 600px; top: -200px; right: -100px; }
    .shape-2 { width: 400px; height: 400px; bottom: -100px; left: -100px; }
    .cursor-pointer { cursor: pointer; }
    #togglePassword { 
        border-left: none; 
        background: #fff;
        color: #c1097a;
        transition: all 0.2s;
        border-color: #e1e8ef;
    }
    #togglePassword:hover { background: #f8f9fa; }
</style>
<!-- Add FontAwesome as backup for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection 

@section('content')
<div class="auth-bg">
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    
    <div class="auth-card mx-auto">
        <div class="auth-brand text-center mb-4">
            <h2 class="fw-bold text-primary mb-2">LET'S GET STARTED NOW!</h2>
            <h5 class="text-dark">Login and find your life partner</h5>
            <p class="text-muted small">Access your account to connect with potential matches.</p>
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
            <div class="mb-3">
                <label class="form-label fw-bold">Login As</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-users"></i></span>
                    <select name="role" class="form-select border-start-0" required>
                        <option value="customer">Customer</option>
                        <option value="admin" selected>Administrator</option>
                        <option value="staff">Staff</option>
                        <option value="mediator">Mediator</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email / Mobile No / MID</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Enter Email or Mobile No" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-bold mb-0">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-end-0" placeholder="••••••••" required>
                    <span class="input-group-text cursor-pointer" id="togglePassword">
                        <i class="fa fa-eye" id="eyeIcon"></i>
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
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon
                if (type === 'text') {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>
@endsection
