<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <title>Admin Login | Vaarahi Matrimony</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link href="/images/favicon.ico" rel="shortcut icon"/>
    @include('shared.partials.head-css')
    <style>
        body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.3); overflow: hidden; }
        .btn-primary { background: #ac0772; border: none; padding: 12px; border-radius: 10px; font-weight: 600; }
        .btn-primary:hover { background: #8e065d; }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card shadow-lg">
                    <div class="p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: #ac0772;">Vaarahi Admin</h2>
                            <p class="text-muted">Enter your credentials to access the admin panel</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="ti ti-user fs-5"></i></span>
                                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Enter username" value="{{ old('username') }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="ti ti-lock fs-5"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="Enter password" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 shadow">Sign In</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted small">&copy; {{ date('Y') }} Vaarahi Matrimony. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('shared.partials.footer-scripts')
</body>
</html>
