<!DOCTYPE html>
<html lang="en" data-menu-color="dark" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <title>{{ \App\Models\Setting::get('site_name', 'Vaarahi Matrimony') }} | Admin</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link href="{{ asset(\App\Models\Setting::get('favicon', 'images/favicon.ico')) }}" rel="shortcut icon"/>

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @yield('styles')

    @include('shared.partials.head-css')

    <style>
        .content-page {
            margin-left: 260px;
            transition: all .2s ease-out;
            padding: 15px 15px 0 15px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        @media (max-width: 767.98px) {
            .content-page {
                margin-left: 0;
            }
        }
        .content-page > .container-fluid {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }
        .page-title-box {
            padding: 5px 0 10px 0 !important;
        }
        .page-title-box .page-title {
            margin: 0 !important;
            line-height: 1.2 !important;
        }
        .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
    </style>
</head>

<body>
    <!-- Full viewport premium preloader to prevent Flash of Unstyled Content (FOUC) and sidebar layout shifts during Vite load -->
    <div id="preloader" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: #1e1e2d; display: flex; align-items: center; justify-content: center; z-index: 99999; transition: opacity 0.35s ease, transform 0.35s ease;">
        <div class="text-center">
            @if(\App\Models\Setting::get('favicon'))
                <img src="{{ asset(\App\Models\Setting::get('favicon')) }}" alt="Loading..." class="animate-pulse" style="width: 75px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.5));">
            @else
                <div class="spinner-border text-light" role="status" style="width: 3.5rem; height: 3.5rem;"></div>
            @endif
        </div>
    </div>

    <!-- YouTube-style horizontal loading bar for SPA transitions -->
    <div id="spa-loading-bar" style="position: fixed; top: 0; left: 0; width: 0%; height: 3px; background: linear-gradient(90deg, #ab0772 0%, #e00c84 100%); z-index: 100000; transition: width 0.35s ease, opacity 0.35s ease; opacity: 0; pointer-events: none;"></div>

    <!-- Begin page -->
    <div class="wrapper">
        @include('shared.partials.topbar')
        @include('shared.partials.sidenav')

        <div class="content-page" style="position: relative;">

            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="pt-1 pb-3 flex-grow-1">
                    @yield('content')
                </div>
            </div>

            @include('shared.partials.footer')
        </div>
    </div>

    @include('shared.partials.footer-scripts')

    @yield('scripts')

    <script>
        // 1. Smoothly fade out and hide the full-screen preloader once resources are ready
        (function() {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                const fadeOut = () => {
                    preloader.style.opacity = '0';
                    setTimeout(() => {
                        preloader.style.display = 'none';
                    }, 350);
                };
                if (document.readyState === 'complete') {
                    fadeOut();
                } else {
                    window.addEventListener('load', fadeOut);
                    // Fail-safe: Hide after 2 seconds max to avoid getting stuck
                    setTimeout(fadeOut, 2000);
                }
            }
        })();

        // 2. Custom SPA PJAX Transition Engine to reload ONLY content, keeping the sidebar persistent
        (function() {
            // Function to run a smooth dynamic navigation transitions
            function navigateToSPA(url, pushState = true) {
                const loadingBar = document.getElementById('spa-loading-bar');
                const contentPage = document.querySelector('.content-page');

                if (loadingBar) {
                    loadingBar.style.opacity = '1';
                    loadingBar.style.width = '30%';
                }

                // Smooth blur transition on active page view
                if (contentPage) {
                    contentPage.style.transition = 'filter 0.2s ease, opacity 0.2s ease';
                    contentPage.style.filter = 'blur(4px)';
                    contentPage.style.opacity = '0.75';
                }

                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        if (loadingBar) loadingBar.style.width = '70%';
                        return response.text();
                    })
                    .then(htmlText => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(htmlText, 'text/html');
                        
                        // Extract and swap only the inner content-page container
                        const newContentPage = doc.querySelector('.content-page');
                        if (newContentPage && contentPage) {
                            contentPage.innerHTML = newContentPage.innerHTML;
                        }

                        // Sync Title
                        document.title = doc.title;

                        // Push route history
                        if (pushState) {
                            history.pushState({ spa: true }, doc.title, url);
                        }

                        // Synchronize Side menu navigation highlight classes
                        syncSidebarState(url);

                        // Reinitialize UI elements/scripts for the newly loaded page elements
                        reinitializeDynamicScripts();

                        // Fast-complete the progress bar animation
                        if (loadingBar) {
                            loadingBar.style.width = '100%';
                            setTimeout(() => {
                                loadingBar.style.opacity = '0';
                                setTimeout(() => { loadingBar.style.width = '0%'; }, 350);
                            }, 150);
                        }

                        // Restore view clarity
                        if (contentPage) {
                            contentPage.style.filter = 'none';
                            contentPage.style.opacity = '1';
                        }

                        window.scrollTo({ top: 0, behavior: 'instant' });
                    })
                    .catch(err => {
                        console.warn('SPA Navigation encountered error, falling back to standard reload:', err);
                        window.location.href = url;
                    });
            }

            // Sync navigation active links in the side menu
            function syncSidebarState(currentUrl) {
                const links = document.querySelectorAll('.side-nav-link, .side-nav-item a');
                links.forEach(link => {
                    const item = link.closest('.side-nav-item');
                    const href = link.getAttribute('href');
                    
                    if (href && (currentUrl === href || currentUrl.startsWith(href + '?') || currentUrl.startsWith(href + '/'))) {
                        link.classList.add('active');
                        if (item) item.classList.add('active');
                    } else {
                        link.classList.remove('active');
                        if (item) item.classList.remove('active');
                    }
                });
            }

            // Re-runs core setup scripts for dynamic components (like Bootstrap utilities & simplebar scrollbars)
            function reinitializeDynamicScripts() {
                // Lucide icons
                if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
                    lucide.createIcons({ icons: lucide.icons });
                }

                // Bootstrap tooltips and popovers
                if (typeof bootstrap !== 'undefined') {
                    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el));
                    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
                }

                // SimpleBar re-init if element is present
                const scrollable = document.querySelector('.scrollbar');
                if (scrollable && typeof SimpleBar !== 'undefined') {
                    new SimpleBar(scrollable);
                }
            }

            // Intercept internal link click interactions
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a');
                if (!link) return;

                const url = link.getAttribute('href');
                if (!url) return;

                // Exclude external, anchors, scripts, files, logout, prints, clear-cache, and modal trigger clicks
                if (
                    url.startsWith('#') || 
                    url.startsWith('javascript:') || 
                    link.getAttribute('target') === '_blank' || 
                    link.hasAttribute('data-bs-toggle') ||
                    url.includes('/logout') || 
                    url.includes('clear-cache') || 
                    url.includes('download') ||
                    url.includes('print') ||
                    (!url.startsWith(window.location.origin) && url.includes('://'))
                ) {
                    return;
                }

                e.preventDefault();
                navigateToSPA(url);
            });

            // Handle back and forward history actions
            window.addEventListener('popstate', function() {
                navigateToSPA(window.location.href, false);
            });
        })();
    </script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Session alert notifications (rendered in SweetAlert2 popup)
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 4000,
                    showConfirmButton: false,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif

            // 2. Global Delete Action Confirmation Popup Interceptor
            document.addEventListener('submit', function(e) {
                const form = e.target;
                
                // Inspect if this is a DELETE form (method spoofing with value=DELETE)
                const methodInput = form.querySelector('input[name="_method"]');
                const isDelete = methodInput && (methodInput.value.toUpperCase() === 'DELETE');
                
                if (isDelete) {
                    // Check if already authenticated via confirmation dialog
                    if (form.dataset.confirmed === 'true') {
                        return;
                    }
                    
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action will permanently delete this record!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        }
                    });
                }
            });

            // 3. Global confirm-btn click interceptor
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.confirm-btn');
                if (!btn) return;
                
                e.preventDefault();
                
                const title = btn.dataset.title || 'Are you sure?';
                const text = btn.dataset.text || 'Do you want to proceed with this action?';
                const confirmText = btn.dataset.confirmBtn || 'Yes, proceed';
                const btnClass = btn.dataset.btnClass || 'btn-primary';
                
                let confirmColor = '#c1097a'; // Default theme pink
                if (btnClass === 'btn-success') confirmColor = '#10b981';
                else if (btnClass === 'btn-warning') confirmColor = '#f59e0b';
                else if (btnClass === 'btn-danger') confirmColor = '#ef4444';
                
                const form = btn.closest('form');
                
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: confirmColor,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Cancel',
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (form) {
                            form.dataset.confirmed = 'true';
                            form.submit();
                        } else {
                            const href = btn.getAttribute('href');
                            if (href) {
                                window.location.href = href;
                            }
                        }
                    }
                });
            });

            // 4. Logout click interceptor
            document.addEventListener('click', function(e) {
                const logoutLink = e.target.closest('a');
                if (!logoutLink) return;
                
                const url = logoutLink.getAttribute('href');
                if (url && (url.includes('/admin/logout') || logoutLink.classList.contains('logout-btn'))) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Confirm Logout',
                        text: "Are you sure you want to log out from the admin panel?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ab0772',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, Logout',
                        cancelButtonText: 'Cancel',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
