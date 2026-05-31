<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice INV-{{ sprintf('%04d', $payment->id) }} - Sri Vaarahi Matrimony</title>

    <!-- Google Fonts - Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #764ba2 0%, #ab0772 100%);
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --glass-bg: rgba(255, 255, 255, 0.85);
        }

        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        h1, h2, h3, h4, .company-logo, .invoice-title {
            font-family: 'Outfit', sans-serif;
        }

        .invoice-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(118, 75, 162, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.7);
            padding: 25px;
            margin-top: 10px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .invoice-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: var(--primary-gradient);
        }

        .invoice-header {
            border-bottom: 1px dashed var(--border-color);
            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .company-logo {
            font-size: 22px;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }

        .invoice-title {
            font-size: 26px;
            font-weight: 800;
            color: #ab0772;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .invoice-meta-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .invoice-meta-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .billing-title {
            font-size: 12px;
            font-weight: 800;
            color: #ab0772;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            border-bottom: 2px solid rgba(171, 7, 114, 0.1);
            padding-bottom: 5px;
            display: inline-block;
        }

        .billing-info {
            line-height: 1.7;
            font-size: 14px;
        }

        .table-invoice {
            margin-bottom: 20px;
        }

        .table-invoice thead th {
            background-color: #f1f5f9;
            border-bottom: none;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 10px 15px;
            letter-spacing: 0.5px;
        }

        .table-invoice tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
        }

        .total-amount-box {
            background: var(--primary-gradient);
            color: #fff;
            border-radius: 16px;
            padding: 15px 25px;
            box-shadow: 0 10px 30px rgba(171, 7, 114, 0.2);
        }

        .invoice-footer {
            border-top: 1px dashed var(--border-color);
            padding-top: 20px;
            margin-top: 25px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .badge-secure {
            background-color: rgba(118, 75, 162, 0.08);
            color: #764ba2;
            border: 1px solid rgba(118, 75, 162, 0.15);
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
        }

        .status-paid {
            color: #10b981;
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 14px;
            display: inline-block;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .status-pending {
            color: #f59e0b;
            background-color: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 14px;
            display: inline-block;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        @media print {
            html, body {
                height: 99%;
                overflow: hidden;
                background-color: #fff;
                margin: 0 !important;
                padding: 0 !important;
            }

            .invoice-card {
                box-shadow: none;
                margin: 0 !important;
                padding: 10px !important;
                border: none;
                background: none;
            }

            .btn-print-action {
                display: none !important;
            }

            /* Prevent layout splitting across pages */
            .invoice-header, .row, .table-responsive, .total-amount-box, .invoice-footer {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                {{-- Action buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-3 btn-print-action">
                    <a href="{{ route('profile.billing') }}"
                        class="btn btn-outline-secondary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa fa-arrow-left me-2"></i> Back to Billing
                    </a>
                    <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow"
                        style="background: var(--primary-gradient); border: none;">
                        <i class="fa fa-print me-2"></i> Print Invoice Receipt
                    </button>
                </div>

                {{-- Printable Invoice sheet --}}
                <div class="card invoice-card">

                    {{-- Header --}}
                    <div class="invoice-header">
                        <div class="row align-items-center">
                            <div class="col-7">
                                <div class="company-logo mb-2">
                                    <i class="fa fa-heart-pulse me-2"></i>Sri Vaarahi Matrimony
                                </div>
                                <p class="text-muted small mb-0 billing-info">
                                    No. 12, 122, Trichy Main Road,<br>
                                    Trichy - 620102, Tamil Nadu, India<br>
                                    <span class="fw-semibold">Support:</span> helpdesk@srivaarahimatrimony.com
                                </p>
                            </div>
                            <div class="col-5 text-end">
                                <div class="invoice-title mb-1">Receipt</div>
                                <div class="mt-2">
                                    <span class="invoice-meta-label d-block">INVOICE NO</span>
                                    <span class="invoice-meta-value fs-20 fw-bold text-dark">INV-{{ sprintf('%04d', $payment->id) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Meta Information --}}
                    <div class="row mb-3 g-3">
                        <div class="col-4">
                            <span class="invoice-meta-label d-block">PAYMENT DATE</span>
                            <span class="invoice-meta-value">
                                {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y, h:i A') }}
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="invoice-meta-label d-block">TRANSACTION REF / ORDER</span>
                            <span class="invoice-meta-value text-break text-primary fw-bold">{{ $payment->transaction_id ?? 'N/A' }}</span>
                        </div>
                        <div class="col-4">
                            <span class="invoice-meta-label d-block">PAYMENT METHOD</span>
                            <span class="invoice-meta-value d-block mt-1">
                                <span class="badge-secure"><i class="fa fa-shield-halved me-1.5"></i>Razorpay Secure</span>
                            </span>
                        </div>
                    </div>

                    {{-- Billing & Payment Info Row --}}
                    <div class="row mb-3 g-3">
                        <div class="col-6">
                            <div class="p-3 rounded-3 border h-100" style="background: rgba(248, 250, 252, 0.65); border-color: var(--border-color) !important;">
                                <div class="billing-title mb-2"><i class="fa fa-user me-1.5"></i>Billed To (Member Details)</div>
                                <div class="billing-info fw-bold text-dark fs-15 mb-1">{{ $user->name }}</div>
                                <div class="billing-info text-muted small" style="line-height: 1.55;">
                                    <span class="fw-semibold text-dark">Member ID:</span> {{ $user->userid }}<br>
                                    <span class="fw-semibold text-dark">Gender:</span> {{ $user->gender }}<br>
                                    <span class="fw-semibold text-dark">Phone:</span> {{ $user->mobileno }}<br>
                                    <span class="fw-semibold text-dark">Email:</span> {{ $user->emailid }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded-3 border h-100 d-flex flex-column justify-content-between" style="background: rgba(248, 250, 252, 0.65); border-color: var(--border-color) !important;">
                                <div>
                                    <div class="billing-title mb-2"><i class="fa fa-receipt me-1.5"></i>Transaction & Status</div>
                                    <div class="small text-muted" style="line-height: 1.55;">
                                        <span class="fw-semibold text-dark">Gateway:</span> Razorpay Secure Portal<br>
                                        <span class="fw-semibold text-dark">Secure Verification:</span> Signature Verified<br>
                                        <span class="fw-semibold text-dark">Currency:</span> INR (₹)
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top" style="border-top: 1px dashed var(--border-color) !important;">
                                    <span class="fw-bold text-dark small">Payment Status:</span>
                                    @if(strtolower($payment->status) === 'success')
                                        <span class="status-paid" style="padding: 4px 12px; font-size: 12px;"><i class="fa fa-circle-check me-1.5"></i>PAID</span>
                                    @else
                                        <span class="status-pending" style="padding: 4px 12px; font-size: 12px;"><i class="fa fa-clock me-1.5"></i>{{ strtoupper($payment->status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Itemized Table --}}
                    <div class="table-responsive mb-3">
                        <table class="table table-invoice align-middle">
                            <thead>
                                <tr>
                                    <th>Item Details / Subscription Plan</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Unit Price</th>
                                    <th class="text-end">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark fs-15 mb-1">
                                            {{ isset($payment->plan_name) ? $payment->plan_name : 'Booster Upgrade Package' }}
                                        </div>
                                        <span class="text-muted small">{{ $payment->remarks ?? 'Matrimony Premium Membership Plan allocation.' }}</span>
                                    </td>
                                    <td class="text-center fw-semibold text-dark">1</td>
                                    <td class="text-end fw-semibold text-dark">₹{{ number_format($payment->amount, 2) }}</td>
                                    <td class="text-end fw-bold text-dark">₹{{ number_format($payment->amount, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Final total row --}}
                    <div class="row align-items-center justify-content-end">
                        <div class="col-6 text-end">
                            <div class="d-inline-block text-start total-amount-box">
                                <div class="d-flex align-items-center justify-content-between gap-5 mb-2">
                                    <span class="fs-12 opacity-80 fw-semibold text-uppercase">SUBTOTAL</span>
                                    <span class="fw-bold">₹{{ number_format($payment->amount, 2) }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-5 mb-3">
                                    <span class="fs-12 opacity-80 fw-semibold text-uppercase">TAX / GST (0%)</span>
                                    <span class="fw-bold">₹0.00</span>
                                </div>
                                <hr class="bg-white bg-opacity-20 my-2" style="border-top: 1px solid rgba(255, 255, 255, 0.3);">
                                <div class="d-flex align-items-center justify-content-between gap-5 mt-2">
                                    <span class="fs-13 fw-bold text-uppercase" style="letter-spacing: 0.5px;">TOTAL AMOUNT PAID</span>
                                    <span class="fs-22 fw-extrabold">₹{{ number_format($payment->amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Terms and signature --}}
                    <div class="invoice-footer text-center">
                        <p class="mb-2">Thank you for choosing <strong>Sri Vaarahi Matrimony</strong>. We wish you the very best in your partner search!</p>
                        <p class="small text-muted mb-0">This is a computer-generated receipt, no physical signature is required.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>