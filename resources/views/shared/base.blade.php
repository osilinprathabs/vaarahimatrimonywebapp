<!DOCTYPE html>

<html @yield('html_attribute') lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ $title }} | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Paces is a modern, responsive admin dashboard available on ThemeForest. Ideal for building CRM, CMS, project management tools, and custom web applications with a clean UI, flexible layouts, and rich features." name="description"/>
    <meta content="Paces, admin dashboard, ThemeForest, Bootstrap 5 admin, responsive admin, CRM dashboard, CMS admin, web app UI, admin theme, premium admin template" name="keywords"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link href="/images/favicon.ico" rel="shortcut icon"/>

    @yield('styles')

    @include('shared.partials/head-css')

</head>
<body @yield('body_attribute')>

@yield('content')

@include('shared.partials/footer-scripts')

@yield('scripts')

</body>
</html>
