@extends('layouts.frontend')

@section('styles')
    <style>
        .billing-booster-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            border: 2px solid transparent;
            background: #fff;
        }

        .billing-booster-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08) !important;
        }

        .billing-booster-card.bronze {
            border-color: #cd7f32;
        }

        .billing-booster-card.silver {
            border-color: #c0c0c0;
        }

        .billing-booster-card.gold {
            border-color: #ffd700;
        }

        .booster-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
            text-uppercase: true;
        }
    </style>
@endsection

@section('content')
    <section class="py-5" style="background-color: #f0f2f5; min-height: 100vh;">
        <div class="container">
            <div class="row g-4">
                {{-- Import member sidebar navigation --}}
                @include('partials.member_sidebar')

                <div class="col-lg-9">
                    {{-- Flash Message Display --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                            style="border-radius: 12px;">
                            <i class="fa fa-circle-check me-2"></i> <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
                            style="border-radius: 12px;">
                            <i class="fa fa-circle-xmark me-2"></i> <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Active Plan Summary Card --}}
                    <div class="card border-0 shadow mb-5 p-4 text-white position-relative overflow-hidden"
                        style="border-radius: 15px; background: linear-gradient(135deg, #764ba2 0%, #ab0772 100%);">

                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <span class="badge rounded-pill px-3 py-1 text-uppercase fs-11 fw-bold mb-2"
                                    style="background-color: rgba(255, 255, 255, 0.25); color: #fff;">My Active Plan</span>
                                <h2 class="fw-bold mb-1">{{ $user->plan ?? 'FREE' }} Package</h2>
                                <p class="fs-14 mb-3" style="opacity: 0.85;">
                                    Validity Expiry:
                                    @if($planAssign && $planAssign->plan_end_date)
                                        <strong>{{ \Carbon\Carbon::parse($planAssign->plan_end_date)->format('d M Y') }}</strong>
                                    @else
                                        <strong class="text-warning">Lifetime / Free</strong>
                                    @endif
                                </p>

                                {{-- Interest Usage Progress Bar --}}
                                @php
                                    $usedInt = $planAssign ? $planAssign->used_interests : 0;
                                    $totalInt = $planAssign ? $planAssign->total_interests : 0;
                                    $remInt = max(0, $totalInt - $usedInt);
                                    $percent = $totalInt > 0 ? min(100, round(($usedInt / $totalInt) * 100)) : 0;
                                @endphp
                                <div class="pe-md-5 mb-2">
                                    <div class="d-flex justify-content-between mb-1 small">
                                        <span style="opacity: 0.85;">Interest Credits Balance</span>
                                        <span class="fw-bold">{{ $usedInt }} / {{ $totalInt }} Used</span>
                                    </div>
                                    <div class="progress"
                                        style="height: 8px; border-radius: 4px; background-color: rgba(255, 255, 255, 0.2);">
                                        <div class="progress-bar bg-white"
                                            style="width: {{ $percent }}%; border-radius: 4px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 text-md-end mt-3 mt-md-0">
                                <div class="p-3 rounded-3 d-inline-block text-start"
                                    style="background-color: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.2);">
                                    <div class="fs-12" style="color: rgba(255, 255, 255, 0.75);">REMAINING INTERESTS</div>
                                    <div class="fs-32 fw-bold text-white lh-1">{{ $remInt }}</div>
                                    <div class="fs-11 mt-1" style="color: rgba(255, 255, 255, 0.75);">Need more? Buy a
                                        booster pack below!</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Available Plans --}}
                    @php
                        $hasActivePremiumPlan = false;
                        if ($planAssign && $planAssign->plan_status === 'Active' && $planAssign->plan_end_date) {
                            $hasActivePremiumPlan = \Carbon\Carbon::parse($planAssign->plan_end_date)->isFuture();
                        }
                        if (strtolower($user->plan) === 'free' || empty($user->plan)) {
                            $hasActivePremiumPlan = false;
                        }
                        if ($planAssign && $planAssign->used_interests >= $planAssign->total_interests) {
                            $hasActivePremiumPlan = false;
                        }
                    @endphp
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold text-dark mb-0">Available Plans</h4>
                            <span class="badge bg-primary rounded-pill px-3 py-1 fs-12 fw-bold text-white">Upgrade Option</span>
                        </div>
                        <p class="text-muted small mt-n2 mb-4">Choose a premium plan package below to get access to advanced matching, star matching, priority contact reveal, and much more.</p>

                        <div class="row g-4">
                            @forelse($availablePlans as $plan)
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-0 h-100 p-4 position-relative"
                                        style="border-radius: 16px; background: #fff; transition: all 0.3s; border: 1px solid #eef0f3;">
                                        @if(strtolower($plan->name) === 'gold' || strtolower($plan->name) === 'premium' || strtolower($plan->name) === 'diamond')
                                            <span class="position-absolute top-0 end-0 bg-danger text-white fs-10 fw-bold px-3 py-1"
                                                style="border-radius: 0 16px 0 16px; text-transform: uppercase;">Best Seller</span>
                                        @endif
                                        <div class="text-muted text-uppercase fs-11 fw-bold mb-2">{{ $plan->name }} Plan</div>
                                        <h3 class="fw-bold mb-1 text-dark">₹{{ number_format($plan->amount, 2) }}</h3>
                                        <p class="text-muted fs-12 mb-3">Validity: <strong>{{ $plan->validity }} Days</strong></p>

                                        <ul class="list-unstyled mb-4 small text-muted"
                                            style="font-size: 13px; line-height: 1.6;">
                                            <li class="mb-2"><i class="fa fa-check-circle text-success me-2"></i><strong>{{ $plan->interest }}</strong> Interest Requests</li>
                                            <li class="mb-2">
                                                <i class="fa {{ $plan->star_matching ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-2"></i>
                                                Star Matching
                                            </li>
                                            <li class="mb-2">
                                                <i class="fa {{ $plan->premium_list ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-2"></i>
                                                Premium Search Priority
                                            </li>
                                            <li class="mb-2">
                                                <i class="fa {{ $plan->unlimited_profile_access ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} me-2"></i>
                                                Unlimited Profile View
                                            </li>
                                        </ul>

                                        <div class="mt-auto">
                                            @if($hasActivePremiumPlan)
                                                <button type="button" class="btn btn-secondary w-100 fw-bold rounded-pill" disabled style="opacity: 0.65; cursor: not-allowed;">
                                                    <i class="fa fa-lock me-1"></i> Plan Locked
                                                </button>
                                            @else
                                                <form action="{{ route('payment.initiate') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                                    <button type="submit" class="btn btn-outline-primary w-100 fw-bold rounded-pill">Choose Plan</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-4 text-muted">
                                    No membership plans are currently active.
                                </div>
                            @endforelse
                        </div>

                        @if($hasActivePremiumPlan)
                            <div class="alert alert-warning border-0 shadow-sm p-3 rounded-3 mt-4 d-flex align-items-center gap-3 animate__animated animate__fadeIn" style="background-color: rgba(245, 158, 11, 0.08); color: #b45309;">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                                    <i class="fa fa-lock fs-18"></i>
                                </div>
                                <div>
                                    <div class="fw-bold fs-14">Plan Purchase Locked</div>
                                    <div class="small opacity-90">You already have an active Premium membership plan. To prevent duplicate billing, you can purchase or renew a plan after your current active plan expires on <strong>{{ \Carbon\Carbon::parse($planAssign->plan_end_date)->format('d M Y') }}</strong>.</div>
                                </div>
                            </div>
                        @endif
                    </div>



                    {{-- Billing & Transaction History --}}
                    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold text-dark">Invoice & Payment History</h5>
                            <i class="fa fa-receipt text-muted fs-20"></i>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Invoice ID</th>
                                            <th>Details</th>
                                            <th>Transaction Ref</th>
                                            <th>Payment Date</th>
                                            <th>Amount Paid</th>
                                            <th>Status</th>
                                            <th class="text-center pe-4">Receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $item)
                                            <tr>
                                                <td class="ps-4 fw-bold text-dark">INV-{{ sprintf('%04d', $item->id) }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-bold text-dark">{{ isset($item->plan_name) ? $item->plan_name : 'Extra Interests Booster' }}</span>
                                                        <span
                                                            class="small text-muted">{{ $item->remarks ?? 'Membership Upgrade' }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-light text-primary border px-2 py-1">{{ $item->transaction_id ?? 'N/A' }}</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->payment_date)->format('d M Y, h:i A') }}
                                                </td>
                                                <td class="fw-bold text-success">₹{{ number_format($item->amount, 2) }}</td>
                                                <td>
                                                    @if(strtolower($item->status) === 'success')
                                                        <span class="badge rounded-pill px-3 py-1"
                                                            style="background-color: rgba(40, 167, 69, 0.1); color: #28a745; font-weight: 600;">Success</span>
                                                    @else
                                                        <span class="badge rounded-pill px-3 py-1"
                                                            style="background-color: rgba(255, 193, 7, 0.15); color: #e0a800; font-weight: 600;">{{ $item->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center pe-4">
                                                    <a href="{{ route('profile.invoice.print', $item->id) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary rounded-circle"
                                                        style="width: 32px; height: 32px; padding: 0; line-height: 30px;"
                                                        title="Print Receipt">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">No transactions found.
                                                    Upgraded plans will be tracked here.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Inline Razorpay Add-on Order Javascript Trigger --}}
    @if(session('razorpay_addon_order'))
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var options = {
                    "key": "{{ session('razorpay_key') }}",
                    "amount": "{{ session('razorpay_addon_order')->amount }}",
                    "currency": "INR",
                    "name": "Sri Vaarahi Matrimony",
                    "description": "{{ session('addon_name') }} Purchase",
                    "order_id": "{{ session('razorpay_addon_order')->order_id }}",
                    "handler": function (response) {
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
                        "color": "#ab0772"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();
            });
        </script>
    @endif
@endsection