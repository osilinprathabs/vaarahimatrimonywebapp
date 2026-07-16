<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sri Vaarahi Matrimony - Find your perfect Tamil life partner. 100% verified profiles, secure platform, no broker commission.">
    <title>Sri Vaarahi Matrimony – Find Your Perfect Tamil Life Partner</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset(\App\Models\Setting::get('favicon', 'assets/images/logo/logo.png')) }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flaticon.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mystyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>
        /* ==========================================
           GLOBAL RESET & TYPOGRAPHY
        ==========================================*/
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #1e293b;
            line-height: 1.6;
        }

        a { text-decoration: none; }

        /* ==========================================
           ANNOUNCEMENT BAR (Top)
        ==========================================*/
        .announcement-bar {
            background: linear-gradient(90deg, #5d0156, #a90771, #e00c84, #a90771, #5d0156);
            background-size: 300% 100%;
            animation: gradientShift 6s ease infinite;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 0;
            text-align: center;
            letter-spacing: 0.3px;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .announcement-bar a {
            color: #ffe4f2;
            text-decoration: underline;
            margin-left: 6px;
        }

        .announcement-bar a:hover { color: #fff; }

        /* ==========================================
           MAIN HEADER / NAVBAR
        ==========================================*/
        #vm-navbar {
            position: sticky;
            top: 0;
            z-index: 1050;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(171, 7, 114, 0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        #vm-navbar.scrolled {
            box-shadow: 0 4px 30px rgba(171, 7, 114, 0.12);
        }

        .navbar-brand-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .navbar-logo {
            height: 52px;
            width: auto;
            object-fit: contain;
        }

        .navbar-brand-text {
            line-height: 1.2;
        }

        .navbar-brand-text strong {
            display: block;
            font-size: 17px;
            font-weight: 800;
            background: linear-gradient(135deg, #a90771, #e00c84);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar-brand-text span {
            font-size: 11.5px;
            color: #64748b;
            font-weight: 500;
        }

        /* Nav links */
        .vm-nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 4px;
            margin: 0;
            padding: 0;
        }

        .vm-nav-links > li > a,
        .vm-nav-links > li > .nav-dropdown-trigger {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-radius: 10px;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .vm-nav-links > li > a:hover,
        .vm-nav-links > li > .nav-dropdown-trigger:hover {
            background: #fdf2f8;
            color: #a90771;
        }

        .vm-nav-links > li > a.active-nav,
        .vm-nav-links > li.active > a {
            background: linear-gradient(135deg, #fdf2f8, #fce7f3);
            color: #a90771;
        }

        /* Dropdown */
        .vm-nav-links > li.has-dropdown {
            position: relative;
        }

        .nav-dropdown-trigger {
            cursor: pointer;
            background: none;
            border: none;
        }

        .nav-dropdown-trigger i.caret {
            font-size: 10px;
            transition: transform 0.25s ease;
        }

        .vm-nav-links > li.has-dropdown:hover .nav-dropdown-trigger i.caret {
            transform: rotate(180deg);
        }

        .nav-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 210px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
            border: 1px solid #f1f5f9;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.25s ease;
            z-index: 200;
        }

        .vm-nav-links > li.has-dropdown:hover .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            transition: all 0.2s ease;
        }

        .nav-dropdown-menu a:hover {
            background: #fdf2f8;
            color: #a90771;
        }

        .nav-dropdown-menu a i {
            width: 20px;
            text-align: center;
            font-size: 13px;
            color: #a90771;
        }

        /* CTA Buttons in Nav */
        .btn-nav-login {
            padding: 9px 20px !important;
            border-radius: 10px !important;
            border: 1.5px solid rgba(171, 7, 114, 0.4) !important;
            color: #a90771 !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            transition: all 0.25s ease !important;
        }

        .btn-nav-login:hover {
            background: #fdf2f8 !important;
            border-color: #a90771 !important;
        }

        .btn-nav-register {
            padding: 9px 20px !important;
            border-radius: 10px !important;
            background: linear-gradient(135deg, #e00c84, #a90771) !important;
            color: #fff !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(169, 7, 113, 0.3) !important;
            transition: all 0.25s ease !important;
        }

        .btn-nav-register:hover {
            box-shadow: 0 6px 20px rgba(169, 7, 113, 0.45) !important;
            transform: translateY(-1px) !important;
        }

        /* Logged-in user pill */
        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px 7px 10px;
            background: #fdf2f8;
            border: 1.5px solid #fce7f3;
            border-radius: 50px;
            font-size: 13.5px;
            font-weight: 600;
            color: #a90771;
        }

        .user-pill .avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #e00c84, #a90771);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
        }

        /* Mobile hamburger */
        .navbar-toggler-vm {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            border: none;
            background: none;
        }

        .navbar-toggler-vm span {
            display: block;
            width: 24px;
            height: 2.5px;
            background: #a90771;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        /* Mobile Nav */
        .vm-mobile-nav {
            display: none;
            background: #fff;
            border-top: 1px solid #fce7f3;
            padding: 16px;
        }

        .vm-mobile-nav.open { display: block; }

        .vm-mobile-nav a {
            display: block;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .vm-mobile-nav a:hover { background: #fdf2f8; color: #a90771; }

        @media (max-width: 992px) {
            .vm-nav-desktop { display: none !important; }
            .navbar-toggler-vm { display: flex; }
        }

        /* ==========================================
           FOOTER
        ==========================================*/
        .vm-footer {
            background: linear-gradient(135deg, #1e1b4b 0%, #4a044e 60%, #5d0156 100%);
            color: #cbd5e1;
            padding: 70px 0 0;
            font-size: 14.5px;
        }

        .vm-footer h5 {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 12px;
        }

        .vm-footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 36px;
            height: 2.5px;
            background: linear-gradient(90deg, #e00c84, #a90771);
            border-radius: 2px;
        }

        .vm-footer p { color: #94a3b8; line-height: 1.75; font-size: 14px; }

        .vm-footer-links { list-style: none; padding: 0; margin: 0; }
        .vm-footer-links li { margin-bottom: 10px; }
        .vm-footer-links a {
            color: #94a3b8;
            font-size: 14px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .vm-footer-links a:hover { color: #f472b6; padding-left: 4px; }
        .vm-footer-links a i { font-size: 11px; color: #e00c84; }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .footer-contact-item .icon {
            width: 36px;
            height: 36px;
            background: rgba(224, 12, 132, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f472b6;
            flex-shrink: 0;
            font-size: 14px;
        }

        .footer-contact-item .text { font-size: 13.5px; color: #94a3b8; line-height: 1.5; }
        .footer-contact-item .text strong { color: #cbd5e1; display: block; font-size: 12px; font-weight: 600; margin-bottom: 2px; }

        .social-links { display: flex; gap: 10px; margin-top: 16px; }
        .social-links a {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 14px;
            transition: all 0.25s ease;
        }

        .social-links a:hover {
            background: linear-gradient(135deg, #e00c84, #a90771);
            border-color: transparent;
            color: #fff;
            transform: translateY(-3px);
        }

        .vm-footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            padding: 20px 0;
            margin-top: 50px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }

        .vm-footer-bottom a { color: #e00c84; }
    </style>

    @yield('styles')
</head>
<body>
    <div class="page">

        <!-- Announcement Bar -->
        <div class="announcement-bar">
            <span>🎉 Free Registration Open! Join Sri Vaarahi Matrimony today & find your perfect match.</span>
            <a href="{{ route('register') }}">Register Now →</a>
        </div>

        <!-- PREMIUM NAVBAR -->
        <nav id="vm-navbar">
            <div class="container-fluid px-4 px-lg-5">
                <div class="d-flex align-items-center justify-content-between" style="height: 70px;">

                    <!-- Brand -->
                    <a class="navbar-brand-wrap" href="{{ url('/') }}">
                        <img class="navbar-logo" src="{{ asset(\App\Models\Setting::get('logo', 'assets/images/logo/matrimony.png')) }}" alt="Sri Vaarahi Matrimony Logo">
                        <div class="navbar-brand-text d-none d-lg-block">
                            <strong>Sri Vaarahi Matrimony</strong>
                            <span>ஸ்ரீ வாராஹி மேட்ரிமோனி</span>
                        </div>
                    </a>

                    <!-- Desktop Nav -->
                    <ul class="vm-nav-links vm-nav-desktop">
                        @auth
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active-nav' : '' }}">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active-nav' : '' }}">
                                    <i class="fa-solid fa-house"></i> Home
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active-nav' : '' }}">
                                <i class="fa-solid fa-circle-info"></i> About Us
                            </a>
                        </li>
                        @auth
                            <li class="has-dropdown">
                                <span class="nav-dropdown-trigger">
                                    <i class="fa-solid fa-magnifying-glass"></i> Search
                                    <i class="fa-solid fa-chevron-down caret"></i>
                                </span>
                                <div class="nav-dropdown-menu">
                                    <a href="{{ route('search.advanced') }}"><i class="fa-solid fa-sliders"></i> Advanced Search</a>
                                    <a href="{{ route('search.id') }}"><i class="fa-solid fa-id-card"></i> ID Search</a>
                                    <a href="{{ route('my.matches') }}"><i class="fa-solid fa-heart"></i> My Matches</a>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('my.interests') }}" class="{{ request()->routeIs('my.interests') ? 'active-nav' : '' }}">
                                    <i class="fa-solid fa-star"></i> Interests
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active-nav' : '' }}">
                                <i class="fa-solid fa-envelope"></i> Contact
                            </a>
                        </li>
                    </ul>

                    <!-- Right Actions -->
                    <div class="d-flex align-items-center gap-3 vm-nav-desktop">
                        @auth
                            <div class="has-dropdown" style="position:relative;">
                                <div class="user-pill" style="cursor:pointer;">
                                    <div class="avatar"><i class="fa-solid fa-user"></i></div>
                                    {{ Str::limit(Auth::user()->name, 14) }}
                                    <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
                                </div>
                                <div class="nav-dropdown-menu" style="right:0;left:auto;min-width:190px;">
                                    <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a>
                                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                                    <div style="border-top:1px solid #f1f5f9;margin:6px 0;"></div>
                                    <form method="POST" action="{{ route('logout') }}" style="display:block;">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="confirmLogout(event, this);" style="color: #ef4444;">
                                            <i class="fa-solid fa-right-from-bracket" style="color:#ef4444;"></i> Logout
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn-nav-login">
                                <i class="fa-regular fa-user"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="btn-nav-register">
                                <i class="fa-solid fa-sparkles"></i> Free Register
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile hamburger -->
                    <button class="navbar-toggler-vm" id="mobileToggle" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Nav -->
            <div class="vm-mobile-nav" id="mobileNav">
                @auth
                    <a href="{{ route('dashboard') }}"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</a>
                @else
                    <a href="{{ url('/') }}"><i class="fa-solid fa-house me-2"></i>Home</a>
                @endauth
                <a href="{{ route('about') }}"><i class="fa-solid fa-circle-info me-2"></i>About Us</a>
                @auth
                    <a href="{{ route('search.advanced') }}"><i class="fa-solid fa-sliders me-2"></i>Advanced Search</a>
                    <a href="{{ route('search.id') }}"><i class="fa-solid fa-id-card me-2"></i>ID Search</a>
                    <a href="{{ route('my.matches') }}"><i class="fa-solid fa-heart me-2"></i>My Matches</a>
                @endauth
                <a href="{{ route('contact') }}"><i class="fa-solid fa-envelope me-2"></i>Contact</a>
                @guest
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-4 rounded-pill" style="border-color:#a90771;color:#a90771;">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm px-4 rounded-pill text-white" style="background:linear-gradient(135deg,#e00c84,#a90771);">Register Free</a>
                    </div>
                @endguest
                @auth
                    <div style="border-top:1px solid #fce7f3;margin:12px 0 8px;"></div>
                    <div class="d-flex align-items-center gap-3 px-2 mb-2">
                        <div class="avatar" style="width:36px;height:36px;background:linear-gradient(135deg,#e00c84,#a90771);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;"><i class="fa-solid fa-user"></i></div>
                        <span style="font-weight:600;color:#a90771;">{{ Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="confirmLogout(event, this);" style="color:#ef4444;">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                        </a>
                    </form>
                @endauth
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <!-- PREMIUM FOOTER -->
        <footer class="vm-footer">
            <div class="container">
                <div class="row g-5">
                    <!-- Col 1: Brand -->
                    <div class="col-lg-4 col-md-6">
                        <img src="{{ asset(\App\Models\Setting::get('logo', 'assets/images/logo/matrimony.png')) }}" alt="Logo" style="height:55px;margin-bottom:18px;filter:brightness(0) invert(1);opacity:0.9;">
                        <p>ஸ்ரீ வாராஹி அம்மனின் திருவருளால், உலகெங்கும் வாழும் தமிழ் மக்களுக்கு நம்பகமான திருமண வரன் தேடும் சேவை வழங்குகிறோம். தமிழ் பண்பாட்டோடு நவீன தொழில்நுட்பத்தை இணைத்து உங்கள் திருமணத்தை சிறப்பாக்குகிறோம்.</p>
                        <div class="social-links">
                            <a href="#" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                            <a href="#" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Col 2: Quick Links -->
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <h5>Quick Links</h5>
                        <ul class="vm-footer-links">
                            <li><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right"></i>Home</a></li>
                            <li><a href="{{ route('about') }}"><i class="fa-solid fa-chevron-right"></i>About Us</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa-solid fa-chevron-right"></i>Free Registration</a></li>
                            <li><a href="{{ route('login') }}"><i class="fa-solid fa-chevron-right"></i>Login</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i>Contact Us</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Legal -->
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <h5>Legal & Support</h5>
                        <ul class="vm-footer-links">
                            <li><a href="{{ route('terms') }}"><i class="fa-solid fa-chevron-right"></i>Terms & Conditions</a></li>
                            <li><a href="{{ route('privacy') }}"><i class="fa-solid fa-chevron-right"></i>Privacy Policy</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i>Help & Support</a></li>
                            <li><a href="{{ route('contact') }}"><i class="fa-solid fa-chevron-right"></i>Report a Profile</a></li>
                        </ul>
                    </div>

                    <!-- Col 4: Contact -->
                    <div class="col-lg-4 col-md-6">
                        <h5>Contact Us</h5>
                        <div class="footer-contact-item">
                            <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div class="text">
                                <strong>Office Address</strong>
                                Tamil Nadu, India
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="icon"><i class="fa-solid fa-phone"></i></div>
                            <div class="text">
                                <strong>Phone / WhatsApp</strong>
                                +91 XXXXX XXXXX
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                            <div class="text">
                                <strong>Email Support</strong>
                                info@srivaarahimatrimony.com
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="icon"><i class="fa-solid fa-clock"></i></div>
                            <div class="text">
                                <strong>Support Hours</strong>
                                Mon – Sat, 9 AM – 7 PM IST
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="vm-footer-bottom">
                <div class="container">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                        <span>© {{ date('Y') }} Sri Vaarahi Matrimony. All Rights Reserved.</span>
                        <span>Made with <i class="fa-solid fa-heart" style="color:#e00c84;"></i> for Tamil families worldwide</span>
                    </div>
                </div>
            </div>
        </footer>

        <a id="totop" href="#top" style="background:linear-gradient(135deg,#e00c84,#a90771);border:none;"><i class="fa-solid fa-chevron-up"></i></a>
    </div>

    <!-- scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Sticky nav shadow
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('vm-navbar');
            if (window.scrollY > 20) nav.classList.add('scrolled');
            else nav.classList.remove('scrolled');
        });

        // Mobile toggle
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.getElementById('mobileNav').classList.toggle('open');
        });

        // Logout confirm
        function confirmLogout(event, element) {
            event.preventDefault();
            Swal.fire({
                title: 'Confirm Logout',
                text: "Are you sure you want to log out from Sri Vaarahi Matrimony?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ab0772',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel',
                background: '#ffffff',
                customClass: { popup: 'rounded-4 shadow-lg border-0' }
            }).then((result) => {
                if (result.isConfirmed) {
                    element.closest('form').submit();
                }
            });
        }
    </script>

    @yield('scripts')
</body>
</html>
