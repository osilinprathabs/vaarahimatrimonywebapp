@extends('shared.base', ['title' => 'Compact Layout']) @section('styles') @endsection @section('content')
<!-- Begin page -->
<div class="wrapper">
    @include('shared.partials.topbar') @include('shared.partials.sidenav')

    <!-- ============================================================== -->
    <!-- Start Main Content -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="container-fluid">@include('shared.partials.page-title', ['title' => 'Compact'])</div>
        <!-- container -->
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info alert-bordered border-start border-info d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle fs-xxl"></i>
                        <div>
                            To use the compact layout, follow this structure: wrap your page title in
                            <code>&lt;div class="container-fluid"&gt;</code>
                            and place your main content inside
                            <code>&lt;div class="container-xl"&gt;</code>
                            . This ensures proper spacing and alignment.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="m-0">Your custom content here</h4>
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col-->
            </div>
            <!-- end row-->
        </div>
        @include('shared.partials.footer')
    </div>
    <!-- ============================================================== -->
    <!-- End of Main Content -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- customizer -->
@include('shared.partials.customizer')

<!-- Footer Scripts -->
@include('shared.partials.footer-scripts') @endsection @section('scripts') @endsection
