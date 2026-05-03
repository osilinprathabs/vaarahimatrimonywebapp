@extends('shared.base', ['title' => 'On Hover Menu']) @section('html_attribute') data-sidenav-size="on-hover" @endsection @section('styles') @endsection @section('content')
<!-- Begin page -->
<div class="wrapper">
    @include('shared.partials.topbar') @include('shared.partials.sidenav')

    <!-- ============================================================== -->
    <!-- Start Main Content -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="container-fluid">
            @include('shared.partials.page-title', ['title' => 'On Hover Menu'])

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-bordered border-start border-warning d-flex align-items-start gap-2">
                        <i class="ti ti-info-circle fs-xxl"></i>
                        <div>
                            To enable the icon view menu with full menu on hover, add
                            <code>data-sidenav-size="on-hover"</code>
                            to the
                            <code>&lt;html&gt;</code>
                            tag in your layout.
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
        <!-- container -->

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
