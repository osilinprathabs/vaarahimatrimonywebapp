<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a class="logo" href="{{ route('admin.dashboard') }}">
        <span class="logo logo-light">
            <span class="logo-lg"><b style="font-size:20px;color:#fff;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
            <span class="logo-sm"><b style="font-size:16px;color:#fff;">VM</b></span>
        </span>
        <span class="logo logo-dark">
            <span class="logo-lg"><b style="font-size:20px;color:#000;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
            <span class="logo-sm"><b style="font-size:16px;color:#000;">VM</b></span>
        </span>
    </a>

    <div class="scrollbar" data-simplebar="">
        <div id="sidenav-menu">
            <ul class="side-nav">

                {{-- Dashboard --}}
                <li class="side-nav-title mt-2">Main</li>
                <li class="side-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                {{-- Members section --}}
                @if(in_array(session('role'), ['admin', 'staff', 'mediator']))
                    <li class="side-nav-title mt-2">Members</li>

                    <li class="side-nav-item {{ request()->routeIs('admin.members.all') ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.members.all') ? 'active' : '' }}" href="{{ route('admin.members.all') }}">
                            <span class="menu-icon"><i class="ti ti-users"></i></span>
                            <span class="menu-text">Members Detail</span>
                        </a>
                    </li>

                    @if(in_array(session('role'), ['admin', 'staff']))
                        <li class="side-nav-item {{ request()->routeIs('admin.members.pending') ? 'active' : '' }}">
                            <a class="side-nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.members.pending') ? 'active' : '' }}" href="{{ route('admin.members.pending') }}">
                                <span class="d-flex align-items-center gap-2">
                                    <span class="menu-icon"><i class="ti ti-user-check"></i></span>
                                    <span class="menu-text">Member Approval</span>
                                </span>
                                @php $pendingCount = \App\Models\User::where('status', 0)->count(); @endphp
                                @if($pendingCount > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('admin.members.photo_queue') ? 'active' : '' }}">
                            <a class="side-nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.members.photo_queue') ? 'active' : '' }}" href="{{ route('admin.members.photo_queue') }}">
                                <span class="d-flex align-items-center gap-2">
                                    <span class="menu-icon"><i class="ti ti-photo"></i></span>
                                    <span class="menu-text">Photo Approval</span>
                                </span>
                                @php $pendingPhotos = \Illuminate\Support\Facades\DB::table('profile_images')->where('status', 0)->count(); @endphp
                                @if($pendingPhotos > 0)
                                    <span class="badge bg-warning rounded-pill text-dark">{{ $pendingPhotos }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('admin.members.horoscope_queue') ? 'active' : '' }}">
                            <a class="side-nav-link d-flex align-items-center justify-content-between {{ request()->routeIs('admin.members.horoscope_queue') ? 'active' : '' }}" href="{{ route('admin.members.horoscope_queue') }}">
                                <span class="d-flex align-items-center gap-2">
                                    <span class="menu-icon"><i class="ti ti-calendar-star"></i></span>
                                    <span class="menu-text">Horoscope Approval</span>
                                </span>
                                @php $pendingHoroscopes = \Illuminate\Support\Facades\DB::table('jathagam_images')->where('status', 0)->count(); @endphp
                                @if($pendingHoroscopes > 0)
                                    <span class="badge bg-warning rounded-pill text-dark">{{ $pendingHoroscopes }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('admin.members.premium') ? 'active' : '' }}">
                            <a class="side-nav-link {{ request()->routeIs('admin.members.premium') ? 'active' : '' }}" href="{{ route('admin.members.premium') }}">
                                <span class="menu-icon"><i class="ti ti-crown"></i></span>
                                <span class="menu-text">Premium Members</span>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Search & Plans --}}
                @if(in_array(session('role'), ['admin', 'staff', 'mediator']))
                    <li class="side-nav-title mt-2">Search &amp; Plans</li>

                    <li class="side-nav-item {{ request()->routeIs('admin.search.basic') ? 'active' : '' }}">
                        <a href="{{ route('admin.search.basic') }}" class="side-nav-link {{ request()->routeIs('admin.search.basic') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ti ti-search"></i></span>
                            <span class="menu-text">Search Members</span>
                        </a>
                    </li>

                    @if(in_array(session('role'), ['admin', 'staff']))
                        <li class="side-nav-item {{ request()->routeIs('admin.plans') ? 'active' : '' }}">
                            <a href="{{ route('admin.plans') }}" class="side-nav-link {{ request()->routeIs('admin.plans') ? 'active' : '' }}">
                                <span class="menu-icon"><i class="ti ti-currency-dollar"></i></span>
                                <span class="menu-text">Premium Plans</span>
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Payments & Reports --}}
                @if(in_array(session('role'), ['admin', 'staff']))
                    <li class="side-nav-title mt-2">Payments &amp; Reports</li>

                    <li class="side-nav-item {{ request()->routeIs('admin.payment_list') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment_list') }}" class="side-nav-link {{ request()->routeIs('admin.payment_list') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ti ti-report-money"></i></span>
                            <span class="menu-text">Payment List</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.expired_list') ? 'active' : '' }}">
                        <a href="{{ route('admin.expired_list') }}" class="side-nav-link {{ request()->routeIs('admin.expired_list') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ti ti-alert-triangle"></i></span>
                            <span class="menu-text">Expired List</span>
                        </a>
                    </li>
                @endif

                {{-- Configuration (Admin only) --}}
                @if(session('role') === 'admin')
                    <li class="side-nav-title mt-2">Configuration</li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'religion' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'religion' ? 'active' : '' }}" href="{{ route('admin.master.index', 'religion') }}">
                            <span class="menu-icon"><i class="ti ti-building-temple"></i></span>
                            <span class="menu-text">Religion</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'caste' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'caste' ? 'active' : '' }}" href="{{ route('admin.master.index', 'caste') }}">
                            <span class="menu-icon"><i class="ti ti-list"></i></span>
                            <span class="menu-text">Caste</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'subcaste' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'subcaste' ? 'active' : '' }}" href="{{ route('admin.master.index', 'subcaste') }}">
                            <span class="menu-icon"><i class="ti ti-list-details"></i></span>
                            <span class="menu-text">Sub Caste</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'raasi' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'raasi' ? 'active' : '' }}" href="{{ route('admin.master.index', 'raasi') }}">
                            <span class="menu-icon"><i class="ti ti-star"></i></span>
                            <span class="menu-text">Rashi</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'star' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'star' ? 'active' : '' }}" href="{{ route('admin.master.index', 'star') }}">
                            <span class="menu-icon"><i class="ti ti-sparkles"></i></span>
                            <span class="menu-text">Star</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'education' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'education' ? 'active' : '' }}" href="{{ route('admin.master.index', 'education') }}">
                            <span class="menu-icon"><i class="ti ti-school"></i></span>
                            <span class="menu-text">Education</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.master.index') && request()->route('type') === 'occupation' ? 'active' : '' }}">
                        <a class="side-nav-link {{ request()->routeIs('admin.master.index') && request()->route('type') === 'occupation' ? 'active' : '' }}" href="{{ route('admin.master.index', 'occupation') }}">
                            <span class="menu-icon"><i class="ti ti-briefcase"></i></span>
                            <span class="menu-text">Occupation</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.settings.payment_gateway*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.payment_gateway') }}" class="side-nav-link {{ request()->routeIs('admin.settings.payment_gateway*') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ti ti-credit-card"></i></span>
                            <span class="menu-text">Payment Gateway</span>
                        </a>
                    </li>

                    <li class="side-nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings') }}" class="side-nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                            <span class="menu-icon"><i class="ti ti-adjustments"></i></span>
                            <span class="menu-text">System Settings</span>
                        </a>
                    </li>
                @endif

                {{-- Logout --}}
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