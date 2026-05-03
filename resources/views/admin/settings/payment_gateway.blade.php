@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Payment Gateway Configuration</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                <img src="https://razorpay.com/favicon.png" class="me-2" width="24">
                <h5 class="card-title mb-0 fw-bold">Razorpay Settings</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.payment_gateway.update') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Gateway Status</label>
                        <div class="form-check form-switch fs-15">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $gateway->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Enable Razorpay Payments</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" for="razorpay_key">Razorpay Key ID</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-key"></i></span>
                            <input type="text" class="form-control border-start-0" id="razorpay_key" name="razorpay_key" value="{{ $gateway->razorpay_key }}" placeholder="rzp_test_..." required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" for="razorpay_secret">Razorpay Key Secret</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-lock"></i></span>
                            <input type="password" class="form-control border-start-0" id="razorpay_secret" name="razorpay_secret" value="{{ $gateway->razorpay_secret }}" placeholder="••••••••••••••••" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" for="razorpay_webhook_secret">Webhook Secret (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="ti ti-shield-lock"></i></span>
                            <input type="password" class="form-control border-start-0" id="razorpay_webhook_secret" name="razorpay_webhook_secret" value="{{ $gateway->razorpay_webhook_secret }}" placeholder="Enter webhook secret if using webhooks">
                        </div>
                        <div class="form-text text-muted small mt-2">
                            <i class="ti ti-info-circle me-1"></i> Webhook URL: <code>{{ url('/payment/razorpay/webhook') }}</code>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Save Configuration</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4 bg-light-subtle" style="border-radius: 12px;">
            <div class="card-body p-4 text-center">
                <i class="ti ti-help-circle fs-32 text-primary mb-2"></i>
                <h5 class="fw-bold">How to get these keys?</h5>
                <p class="text-muted mb-0">Login to your Razorpay Dashboard, go to <b>Settings</b> > <b>API Keys</b> to generate your Key ID and Secret. Ensure you set the Webhook URL in Razorpay settings for automatic plan updates.</p>
            </div>
        </div>
    </div>
</div>
@endsection
