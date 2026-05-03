@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Configure {{ $gateway->name }}</h4>
        </div>
    </div>
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <a href="{{ route('admin.settings.payment_gateway') }}" class="btn btn-sm btn-light me-3"><i class="ti ti-arrow-left"></i></a>
                <h5 class="card-title mb-0 fw-bold">{{ $gateway->name }} Integration</h5>
            </div>
            <div class="card-body p-4 pt-0">
                <form action="{{ route('admin.settings.payment_gateway.update', $gateway->id) }}" method="POST">
                    @csrf
                    
                    <div class="alert alert-info border-0 shadow-sm mb-4 small d-flex">
                        <i class="ti ti-info-circle fs-20 me-2"></i>
                        <div>
                            Configure the credentials below to enable <b>{{ $gateway->name }}</b>. Ensure you use the correct environment (Test/Live) keys.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Active Status</label>
                        <div class="form-check form-switch fs-16">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $gateway->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Enable this gateway for customer checkout</label>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Secret Key</label>
                            <input type="password" name="secret_key" class="form-control" value="{{ $gateway->secret_key }}" placeholder="Enter Secret Key">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Publishable Key</label>
                            <input type="text" name="publishable_key" class="form-control" value="{{ $gateway->publishable_key }}" placeholder="Enter Publishable Key">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Webhook Secret</label>
                            <input type="password" name="webhook_secret" class="form-control" value="{{ $gateway->webhook_secret }}" placeholder="Enter Webhook Secret">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Webhook URL</label>
                            <input type="text" name="webhook_url" class="form-control" value="{{ $gateway->webhook_url }}" placeholder="Enter Webhook URL">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Environment Mode</label>
                        <div class="d-flex gap-3 mt-1">
                            <style>
                                .custom-radio .form-check-input { display: none; }
                                .custom-radio .form-check-input:checked + .form-check-label { font-weight: bold; }
                            </style>
                            <div class="form-check custom-radio ps-0">
                                <input class="form-check-input" type="radio" name="environment" id="mode_test" value="test" {{ $gateway->environment == 'test' ? 'checked' : '' }}>
                                <label class="form-check-label px-3 py-2 border rounded cursor-pointer w-100 text-center {{ $gateway->environment == 'test' ? 'bg-warning-subtle border-warning' : '' }}" for="mode_test">
                                    <i class="ti ti-test-pipe me-1"></i> Test Mode
                                </label>
                            </div>
                            <div class="form-check custom-radio ps-0">
                                <input class="form-check-input" type="radio" name="environment" id="mode_live" value="live" {{ $gateway->environment == 'live' ? 'checked' : '' }}>
                                <label class="form-check-label px-3 py-2 border rounded cursor-pointer w-100 text-center {{ $gateway->environment == 'live' ? 'bg-success-subtle border-success' : '' }}" for="mode_live">
                                    <i class="ti ti-rocket me-1"></i> Live Mode
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Gateway Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ $gateway->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $gateway->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="test" {{ $gateway->status == 'test' ? 'selected' : '' }}>Test Mode</option>
                        </select>
                    </div>

                    <hr class="my-4 opacity-50">

                    <div class="d-flex justify-content-end mt-4 pt-2">
                        <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Save {{ $gateway->name }} Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
