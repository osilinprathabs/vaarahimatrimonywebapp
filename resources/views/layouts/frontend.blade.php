<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vaarahi Matrimony</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png') }}" />

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flaticon.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify-icons.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prettyPhoto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shortcodes.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/mystyle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/megamenu.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rs6.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    @yield('styles')
</head>
<body>
    <div class="page">
        <header id="masthead" class="header ttm-header-style-04">
            <div class="top_bar ttm-bgcolor-grey ttm-textcolor-darkgrey clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="top_bar_contact_item"> 
                                @auth
                                    <a href="#" style="float: left;color:white;">Welcome!&nbsp;&nbsp;{{ Auth::user()->name }}</a>
                                @endauth
                                &nbsp;ஸ்ரீ வாராஹி அம்மன் துணை
                                @auth
                                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                        @csrf
                                        <i class="fa fa-user-circle-o" style="float:right;color:white;margin-top: 16px;">&nbsp;<a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="float: right;color:white;">Logout</a></i>
                                    </form>
                                @else
                                    <i class="fa fa-user-circle-o" style="float:right;color:white;margin-top: 16px;">&nbsp;<a href="{{ route('login') }}" style="float: right;color:white;">Login</a></i>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ttm-widget_header" style="background-color: #fffee4; padding: 0px 0;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="site-branding">
                                <a class="home-link" href="{{ url('/') }}" title="Vaarahi Matrimony" rel="home">
                                    <img id="logo-dark" class="img-center img-fluid" src="{{ asset('assets/images/logo/matrimony.png') }}" alt="logo-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="site-header-menu" class="site-header-menu ttm-bgcolor-darkgrey">
                <div class="site-header-menu-inner ttm-stickable-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="site-navigation">
                                    <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                        <span class="menubar-box"><span class="menubar-inner"></span></span>
                                    </div>
                                    <nav class="main-menu menu-mobile ml-auto" id="menu">
                                        <ul class="menu">
                                            @auth
                                                <li class="mega-menu-item active">
                                                    <a href="{{ route('dashboard') }}" class="mega-menu-link" style="color:white;">Dashboard<br>டாஷ்போர்டு</a>
                                                </li>
                                            @else
                                                <li class="mega-menu-item active">
                                                    <a href="{{ url('/') }}" class="mega-menu-link">Home <br> முகப்பு</a>
                                                </li>
                                            @endauth
                                            <li class="mega-menu-item"><a href="{{ route('about') }}" class="mega-menu-link">About Us <br> எங்களை பற்றி</a></li>
                                            @auth
                                                <li class="mega-menu-item">
                                                    <a href="#" class="mega-menu-link" onclick="console.log('Search clicked')">Search <br> தேடல்</a>
                                                    <ul class="mega-submenu">
                                                        <li><a href="{{ route('search.advanced') }}">Advanced Search</a></li>
                                                        <li><a href="{{ route('search.id') }}">ID Search</a></li>
                                                    </ul>
                                                </li>
                                            @endauth
                                            <li><a href="{{ route('contact') }}">Contact Us <br> தொடர்புக்கு</a></li>
                                            @guest
                                                <li><a href="{{ route('login') }}">Login <br> நுழைக</a></li>
                                            @else
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                                                        @csrf
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout <br> வெளியேறு</a>
                                                    </form>
                                                </li>
                                            @endguest
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="footer widget-footer clearfix">
            <div class="second-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 widget-area">
                            <div class="widget widget_text clearfix">
                                <h3 class="widget-title">About Vaarahi Matrimony</h3>
                                <div class="textwidget widget-text">We’ve delivered fabulous wedding event experiences over the last two decades.</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 widget-area">
                            <div class="widget widget_nav_menu clearfix">
                                <h3 class="widget-title">Our Services</h3>
                                <ul class="menu-footer-services">
                                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 widget-area">
                            <div class="widget widget_nav_menu clearfix">
                                <h3 class="widget-title">Quick Links</h3>
                                <ul class="menu-footer-services">
                                    <li><a href="{{ route('register') }}">Free Registration</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer-text">
                <div class="container">
                    <div class="row copyright">
                        <div class="col-md-12 text-center">
                            <span>Copyright © {{ date('Y') }}. All rights reserved by Vaarahi Matrimony</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a id="totop" href="#top"><i class="fa fa-angle-up"></i></a>
    </div>

    <!-- scripts -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/tether.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('assets/js/jquery.easing.js') }}"></script>    
    <script src="{{ asset('assets/js/jquery-waypoints.js') }}"></script>    
    <script src="{{ asset('assets/js/jquery-validate.js') }}"></script> 
    <script src="{{ asset('assets/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/numinate.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-isotope.js') }}"></script>
    <script src="{{ asset('assets/js/price_range_script.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Revolution Slider -->
    <script src="{{ asset('assets/revolution/js/slider.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
    <!-- SLIDER REVOLUTION 6.0 EXTENSIONS -->
    <script src="{{ asset('assets/revolution/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('assets/revolution/js/rs6.min.js') }}"></script>
    
    @yield('scripts')
</body>
</html>
