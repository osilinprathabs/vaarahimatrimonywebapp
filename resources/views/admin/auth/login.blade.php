<!doctype html>
<html class="fixed">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Admin Login | Vaarahi Matrimony</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/skins/default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/theme-custom.css') }}">
    <script src="{{ asset('admin-assets/vendor/modernizr/modernizr.js') }}"></script>
    <style>
        body .btn-primary { background-color: #12243d !important; border-color: #12243d !important; }
        .body-sign .panel-sign .panel-body { background: #000000; width: 85%; margin: 0 auto; border-radius: 20px; }
        .body-sign .panel-sign .panel-body { box-shadow: 0 1px 1px 10px rgba(23,22,22,0.1) !important; }
        .copy { color: #fff; background-color: #12243d; padding: 10px; width: 55%; margin: 0 auto; border-radius: 24px; }
        .body-sign .center-sign .logo img { width: 80%; text-align: center; margin-bottom: 39px; }
    </style>
</head>
<body class="login" style="background-image: url({{ asset('admin-assets/images/login-back.jpg') }});background-attachment:fixed;background-size:cover;background-repeat:no-repeat;background-position:center;">

<section class="body-sign">
    <div class="center-sign">
        <div class="logo text-center">
            <img src="{{ asset('admin-assets/images/dreammatrimony.png') }}" style="">
        </div>
        <div class="panel panel-sign">
            <div class="panel-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form action="{{ route('admin.login.submit') }}" method="post">
                    @csrf
                    <div class="form-group mb-lg">
                        <label style="color:white;"><b>Username</b></label>
                        <div class="input-group input-group-icon">
                            <input name="username" type="text" class="form-control input-lg" value="{{ old('username') }}" />
                            <span class="input-group-addon"><span class="icon icon-lg"><i class="fa fa-user"></i></span></span>
                        </div>
                    </div>
                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left" style="color:white;"><b>Password</b></label>
                        </div>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" class="form-control input-lg" />
                            <span class="input-group-addon"><span class="icon icon-lg"><i class="fa fa-lock"></i></span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <p style="color:#fff;">Admin Login Panel</p>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
                            <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-center mt-md mb-md copy" style="color:#fff;">&copy; Copyright {{ date('Y') }}. All Rights Reserved.</p>
    </div>
</section>

<script src="{{ asset('admin-assets/vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin-assets/javascripts/theme.js') }}"></script>
<script src="{{ asset('admin-assets/javascripts/theme.custom.js') }}"></script>
<script src="{{ asset('admin-assets/javascripts/theme.init.js') }}"></script>
</body>
</html>
