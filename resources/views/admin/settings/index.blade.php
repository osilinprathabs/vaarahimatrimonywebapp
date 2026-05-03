@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">System Settings</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">General Configuration</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Website Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? '' }}" placeholder="e.g. Sri Vaarahi Matrimony">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Admin Menu Name</label>
                            <input type="text" name="menu_name" class="form-control" value="{{ $settings['menu_name'] ?? '' }}" placeholder="e.g. Vaarahi Admin">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Footer Text</label>
                            <textarea name="footer_text" class="form-control" rows="2">{{ $settings['footer_text'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Logo</label>
                            <input type="file" name="logo" class="form-control mb-2">
                            @if(isset($settings['logo']))
                                <div class="p-2 border rounded bg-light d-inline-block">
                                    <img src="{{ asset($settings['logo']) }}" alt="Logo" style="max-height: 50px;">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Favicon</label>
                            <input type="file" name="favicon" class="form-control mb-2">
                            @if(isset($settings['favicon']))
                                <div class="p-2 border rounded bg-light d-inline-block">
                                    <img src="{{ asset($settings['favicon']) }}" alt="Favicon" style="max-height: 32px;">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="border-radius: 8px;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm bg-primary text-white" style="border-radius: 12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-25 rounded fs-3">
                            <i class="ti ti-info-circle"></i>
                        </span>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">How to use?</h5>
                    </div>
                </div>
                <p class="text-white-50 mb-0">These settings control the global branding of your administrative panel and public pages. Changing the logo or website name will reflect immediately across all interfaces.</p>
            </div>
        </div>
    </div>
</div>
@endsection
