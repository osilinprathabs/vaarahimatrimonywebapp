<header class="app-topbar">
    <div class="container-fluid topbar-menu">
        <div class="d-flex align-items-center gap-2">
            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <a class="logo-light" href="{{ route('admin.dashboard') }}">
                    <span class="logo-lg"><b style="font-size:20px;color:#fff;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
                </a>
                <a class="logo-dark" href="{{ route('admin.dashboard') }}">
                    <span class="logo-lg"><b style="font-size:20px;color:#000;">{{ \App\Models\Setting::get('menu_name', 'Vaarahi Admin') }}</b></span>
                </a>
            </div>
            <!-- Sidebar Menu Toggle Button -->
            <button class="sidenav-toggle-button btn btn-primary btn-icon">
                <i class="ti ti-menu-4"></i>
            </button>
            <div class="app-search d-none d-xl-flex" id="search-box-rounded">
                <input class="form-control rounded-pill topbar-search" name="search" placeholder="Quick Search Members..." type="search" />
                <i class="ti ti-search app-search-icon text-muted"></i>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="topbar-item d-none d-sm-flex">
                <a href="{{ route('admin.clear_cache') }}" class="topbar-link" title="Clear & Optimize Cache">
                    <i class="ti ti-refresh topbar-link-icon text-warning"></i>
                </a>
            </div>
            <div class="topbar-item d-none d-sm-flex">
                <button class="topbar-link" data-bs-target="#theme-settings-offcanvas" data-bs-toggle="offcanvas" type="button">
                    <i class="ti ti-settings topbar-link-icon"></i>
                </button>
            </div>
            <div class="topbar-item" id="theme-dropdown">
                <div class="dropdown">
                    <button aria-expanded="false" aria-haspopup="false" class="topbar-link" data-bs-toggle="dropdown" type="button">
                        <i class="ti ti-sun topbar-link-icon"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" data-thememode="dropdown">
                        <label class="dropdown-item"><input class="form-check-input d-none" name="data-bs-theme" type="radio" value="light" /><i class="ti ti-sun align-middle me-1"></i> Light</label>
                        <label class="dropdown-item"><input class="form-check-input d-none" name="data-bs-theme" type="radio" value="dark" /><i class="ti ti-moon align-middle me-1"></i> Dark</label>
                        <label class="dropdown-item"><input class="form-check-input d-none" name="data-bs-theme" type="radio" value="system" /><i class="ti ti-sun-moon align-middle me-1"></i> System</label>
                    </div>
                </div>
            </div>
            <div class="topbar-item nav-user" id="user-dropdown-detailed">
                <div class="dropdown">
                    <a aria-expanded="false" aria-haspopup="false" class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" href="#!">
                        <img alt="user-image" class="rounded-circle me-lg-2 d-flex" src="/images/users/user-1.jpg" width="32" />
                        <div class="d-lg-flex align-items-center gap-1 d-none">
                            <span>
                                <h5 class="my-0 lh-1 pro-username">{{ session('admin_username', 'Admin') }}</h5>
                                <span class="fs-xs lh-1">Administrator</span>
                            </span>
                            <i class="ti ti-chevron-down align-middle"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-header noti-title"><h6 class="text-overflow m-0">Welcome 👋!</h6></div>
                        <a class="dropdown-item" href="{{ route('admin.change_password') }}"><i class="ti ti-user-circle me-1 fs-lg align-middle"></i> <span class="align-middle">My Profile</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fw-semibold text-danger" href="{{ route('admin.logout') }}"><i class="ti ti-logout me-1 fs-lg align-middle"></i> <span class="align-middle">Log Out</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
