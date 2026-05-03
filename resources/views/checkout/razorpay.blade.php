@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow border-0 p-5" style="border-radius: 20px;">
                <div class="mb-4">
                    <img src="https://razorpay.com/favicon.png" width="48" alt="Razorpay">
                </div>
                <h3 class="fw-bold mb-3">Complete Your Payment</h3>
                <p class="text-muted mb-4">You are subscribing to the <b>{{ $plan->plan_name }}</b> plan.</p>
                
                <div class="bg-light p-3 rounded mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Plan Amount</span>
                        <span class="fw-bold">₹{{ number_format($plan->plan_price, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total to Pay</span>
                        <span class="fw-bold text-primary fs-20">₹{{ number_format($plan->plan_price, 2) }}</span>
                    </div>
                </div>

                <button id="rzp-button1" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">Pay Now with Razorpay</button>
                
                <p class="mt-4 small text-muted">
                    <i class="ti ti-shield-check me-1"></i> Secure payment powered by Razorpay
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $razorpay_key }}",
        "amount": "{{ $order->amount }}",
        "currency": "INR",
        "name": "{{ \App\Models\Setting::get('site_name', 'Vaarahi Matrimony') }}",
        "description": "{{ $plan->plan_name }} Subscription",
        "image": "{{ asset(\App\Models\Setting::get('favicon')) }}",
        "order_id": "{{ $order->id }}",
        "handler": function (response){
            // Razorpay returns payment_id, order_id, signature
            // For extra security, we could verify here, but we rely on Webhook for activation
            window.location.href = "{{ route('dashboard') }}?payment=success";
        },
        "prefill": {
            "name": "{{ $user->name }}",
            "email": "{{ $user->emailid }}",
            "contact": "{{ $user->mobileno }}"
        },
        "theme": {
            "color": "#c1097a"
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }

    // Auto-open on load
    window.onload = function() {
        document.getElementById('rzp-button1').click();
    };
</script>
@endsection
