<!DOCTYPE html>
<html lang="en" class="fixed">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin | Vaarahi Matrimony</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/jquery-datatables/media/css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/bootstrap/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/magnific-popup/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/morris/morris.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/skins/default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/stylesheets/theme-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/elusive-icons/css/elusive-webfont.css') }}" />
    @yield('styles')
</head>
<body>
    <section class="body">
        <header class="header">
            <div class="logo-container">
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <b style="font-size:20px;color:#fff; padding-left:10px;">Vaarahi Matrimony</b>
                </a>
                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
            <div class="header-right">
                <span style="font-size:15px;color:#fff;"><b><i>Admin Panel</i></b></span>
                <span class="separator"></span>
                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src="{{ asset('admin-assets/images/!logged-user.jpg') }}" alt="Admin" class="img-circle" />
                        </figure>
                        <div class="profile-info">
                            <span class="name" style="text-transform:uppercase;">{{ session('admin_username', 'Admin') }}</span>
                        </div>
                        <i class="fa custom-caret"></i>
                    </a>
                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('admin.change_password') }}">
                                    <i class="fa fa-lock"></i> Change Password
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="{{ route('admin.logout') }}">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end: header -->

        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">
                <div class="sidebar-header">
                    <div class="sidebar-title">Matrimony Admin</div>
                    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li id="dashboard" class="{{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <!-- Profiles -->
                                <li id="profiles" class="nav-parent {{ request()->routeIs('admin.members*') ? 'nav-expanded nav-active' : '' }}">
                                    <a>
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <span>Profiles</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li class="{{ request()->routeIs('admin.members.all') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.all') }}"><span>Members Detail</span></a>
                                        </li>
                                        <li class="{{ request()->routeIs('admin.members.premium') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.premium') }}"><span>Premium Members</span></a>
                                        </li>
                                        <li class="{{ request()->routeIs('admin.members.free') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.free') }}"><span>Free Members</span></a>
                                        </li>
                                        <li class="{{ request()->routeIs('admin.members.deleted') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.deleted') }}"><span>Deleted Members</span></a>
                                        </li>
                                        <li class="{{ request()->routeIs('admin.members.photo_queue') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.photo_queue') }}"><span>Photo Approval</span></a>
                                        </li>
                                        <li class="{{ request()->routeIs('admin.members.horoscope_queue') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.members.horoscope_queue') }}"><span>Horoscope Approval</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Search -->
                                <li id="search" class="nav-parent {{ request()->routeIs('admin.search*') ? 'nav-expanded nav-active' : '' }}">
                                    <a>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <span>Search</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li class="{{ request()->routeIs('admin.search.basic') ? 'nav-active' : '' }}">
                                            <a href="{{ route('admin.search.basic') }}"><span>Basic Search</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('admin.members.pending') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.members.pending') }}">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span>Member Approval</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.plans') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.plans') }}">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        <span>Premium Plans</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.payment_list') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.payment_list') }}">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        <span>Payment List</span>
                                    </a>
                                </li>

                                <li class="{{ request()->routeIs('admin.expired_list') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.expired_list') }}">
                                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                                        <span>Expired List</span>
                                    </a>
                                </li>

                                <!-- Configuration -->
                                <li id="config" class="nav-parent">
                                    <a href="javascript:;">
                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                        <span>Configuration</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li><a href="{{ route('admin.settings') }}"><span>Profile Expired Status</span></a></li>
                                    </ul>
                                </li>

                                <!-- Master -->
                                <li id="master" class="nav-parent">
                                    <a href="javascript:;">
                                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                        <span>Master</span>
                                    </a>
                                    <ul class="nav nav-children">
                                        <li><a href="{{ route('admin.master.index', 'religion') }}"><span>Religion</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'caste') }}"><span>Caste</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'subcaste') }}"><span>Sub Caste</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'gotharam') }}"><span>Gotharam</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'raasi') }}"><span>Rashi</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'star') }}"><span>Star</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'education') }}"><span>Education</span></a></li>
                                        <li><a href="{{ route('admin.master.index', 'occupation') }}"><span>Occupation</span></a></li>
                                    </ul>
                                </li>

                                <li class="{{ request()->routeIs('admin.change_password') ? 'nav-active' : '' }}">
                                    <a href="{{ route('admin.change_password') }}">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        <span>Change Password</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.logout') }}">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
            <!-- end: sidebar -->

            <section role="main" class="content-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </section>
        </div>
    </section>

    <script src="{{ asset('admin-assets/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('admin-assets/javascripts/theme.js') }}"></script>
    <script src="{{ asset('admin-assets/javascripts/theme.custom.js') }}"></script>
    <script src="{{ asset('admin-assets/javascripts/theme.init.js') }}"></script>
    <script src="{{ asset('admin-assets/javascripts/tables/examples.datatables.default.js') }}"></script>
    @yield('scripts')
</body>
</html>
