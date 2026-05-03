<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a class="logo" href="{{ route('admin.dashboard') }}">
        <span class="logo logo-light">
            <span class="logo-lg"><b
                    style="font-size:20px;color:#fff;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
            <span class="logo-sm"><b style="font-size:16px;color:#fff;">VM</b></span>
        </span>
        <span class="logo logo-dark">
            <span class="logo-lg"><b
                    style="font-size:20px;color:#000;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
            <span class="logo-sm"><b style="font-size:16px;color:#000;">VM</b></span>
        </span>
    </a>
    <div class="scrollbar" data-simplebar="">
        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-title mt-2">Main</li>
                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                @if(in_array(session('role'), ['admin', 'staff', 'mediator']))
                    <li class="side-nav-title mt-2">Members</li>
                    <li class="side-nav-item">
                        <a aria-controls="profiles-menu" aria-expanded="false" class="side-nav-link"
                            data-bs-toggle="collapse" href="#profiles-menu">
                            <span class="menu-icon"><i class="ti ti-users"></i></span>
                            <span class="menu-text">Profiles</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="profiles-menu">
                            <ul class="sub-menu">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{ route('admin.members.all') }}">Members Detail</a>
                                </li>
                                @if(in_array(session('role'), ['admin', 'staff']))
                                    <li class="side-nav-item">
                                        <a class="side-nav-link d-flex align-items-center justify-content-between" href="{{ route('admin.members.pending') }}">
                                            <span>Member Approval</span>
                                            @php $pendingCount = \App\Models\User::where('status', 0)->count(); @endphp
                                            @if($pendingCount > 0)
                                                <span class="badge bg-danger rounded-pill ms-1">{{ $pendingCount }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a class="side-nav-link d-flex align-items-center justify-content-between" href="{{ route('admin.members.photo_queue') }}">
                                            <span>Photo Approval</span>
                                            @php $pendingPhotos = \Illuminate\Support\Facades\DB::table('profile_images')->where('status', 0)->count(); @endphp
                                            @if($pendingPhotos > 0)
                                                <span class="badge bg-warning rounded-pill ms-1 text-dark">{{ $pendingPhotos }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a class="side-nav-link d-flex align-items-center justify-content-between" href="{{ route('admin.members.horoscope_queue') }}">
                                            <span>Horoscope Approval</span>
                                            @php $pendingHoroscopes = \Illuminate\Support\Facades\DB::table('jathagam_images')->where('status', 0)->count(); @endphp
                                            @if($pendingHoroscopes > 0)
                                                <span class="badge bg-warning rounded-pill ms-1 text-dark">{{ $pendingHoroscopes }}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a class="side-nav-link" href="{{ route('admin.members.premium') }}">Premium Members</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                @endif

                @if(in_array(session('role'), ['admin', 'staff', 'mediator']))
                    <li class="side-nav-title mt-2">Search & Plans</li>
                    <li class="side-nav-item">
                        <a href="{{ route('admin.search.basic') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-search"></i></span>
                            <span class="menu-text">Search Members</span>
                        </a>
                    </li>
                    @if(in_array(session('role'), ['admin', 'staff']))
                        <li class="side-nav-item">
                            <a href="{{ route('admin.plans') }}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-currency-dollar"></i></span>
                                <span class="menu-text">Premium Plans</span>
                            </a>
                        </li>
                    @endif
                @endif

                @if(in_array(session('role'), ['admin', 'staff']))
                    <li class="side-nav-title mt-2">Payments & Reports</li>
                    <li class="side-nav-item">
                        <a href="{{ route('admin.payment_list') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-report-money"></i></span>
                            <span class="menu-text">Payment List</span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="{{ route('admin.expired_list') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-alert-triangle"></i></span>
                            <span class="menu-text">Expired List</span>
                        </a>
                    </li>
                @endif

                @if(session('role') === 'admin')
                    <li class="side-nav-title mt-2">Configuration</li>
                    <li class="side-nav-item">
                        <a aria-controls="master-menu" aria-expanded="false" class="side-nav-link" data-bs-toggle="collapse"
                            href="#master-menu">
                            <span class="menu-icon"><i class="ti ti-settings"></i></span>
                            <span class="menu-text">Master Data</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="master-menu">
                            <ul class="sub-menu">
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'religion') }}">Religion</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'caste') }}">Caste</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'subcaste') }}">Sub Caste</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'raasi') }}">Rashi</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'star') }}">Star</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'education') }}">Education</a></li>
                                <li class="side-nav-item"><a class="side-nav-link"
                                        href="{{ route('admin.master.index', 'occupation') }}">Occupation</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.settings.payment_gateway') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-credit-card"></i></span>
                            <span class="menu-text">Payment Gateway</span>
                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{ route('admin.settings') }}" class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-brand-chrome"></i></span>
                            <span class="menu-text">System Settings</span>
                        </a>
                    </li>
                @endif

                <li class="side-nav-item mt-2">
                    <a href="{{ route('admin.logout') }}" class="side-nav-link text-danger">
                        <span class="menu-icon text-danger"><i class="ti ti-logout"></i></span>
                        <span class="menu-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>