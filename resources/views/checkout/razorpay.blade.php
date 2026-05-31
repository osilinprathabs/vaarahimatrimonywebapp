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
                <p class="text-muted mb-4">You are subscribing to the <b>{{ $plan->name }}</b> plan.</p>
                
                <div class="bg-light p-3 rounded mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Plan Amount</span>
                        <span class="fw-bold">₹{{ number_format($plan->amount, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total to Pay</span>
                        <span class="fw-bold text-primary fs-20">₹{{ number_format($plan->amount, 2) }}</span>
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
        "description": "{{ $plan->name }} Subscription",
        "image": "{{ asset(\App\Models\Setting::get('favicon')) }}",
        "order_id": "{{ $order->id }}",
        "handler": function (response){
            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', "{{ route('payment.callback') }}");

            var csrfInput = document.createElement('input');
            csrfInput.setAttribute('type', 'hidden');
            csrfInput.setAttribute('name', '_token');
            csrfInput.setAttribute('value', "{{ csrf_token() }}");
            form.appendChild(csrfInput);

            var paymentIdInput = document.createElement('input');
            paymentIdInput.setAttribute('type', 'hidden');
            paymentIdInput.setAttribute('name', 'razorpay_payment_id');
            paymentIdInput.setAttribute('value', response.razorpay_payment_id);
            form.appendChild(paymentIdInput);

            var orderIdInput = document.createElement('input');
            orderIdInput.setAttribute('type', 'hidden');
            orderIdInput.setAttribute('name', 'razorpay_order_id');
            orderIdInput.setAttribute('value', response.razorpay_order_id);
            form.appendChild(orderIdInput);

            var signatureInput = document.createElement('input');
            signatureInput.setAttribute('type', 'hidden');
            signatureInput.setAttribute('name', 'razorpay_signature');
            signatureInput.setAttribute('value', response.razorpay_signature);
            form.appendChild(signatureInput);

            document.body.appendChild(form);
            form.submit();
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
