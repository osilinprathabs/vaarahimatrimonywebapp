<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Report (PDF/Print) - Sri Vaarahi Matrimony</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #333;
            padding: 30px;
        }
        .header-section {
            border-bottom: 2px solid #eaedf1;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .report-title {
            font-weight: 800;
            color: #1e293b;
        }
        .meta-text {
            color: #64748b;
            font-size: 14px;
        }
        .table th {
            background-color: #f8fafc !important;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table td {
            font-size: 13px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="header-section d-flex justify-content-between align-items-center">
            <div>
                <h3 class="report-title m-0">Sri Vaarahi Matrimony</h3>
                <p class="meta-text m-0">Payments Transaction Report — Generated on {{ date('d M Y, h:i A') }}</p>
            </div>
            <div class="no-print">
                <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="ti ti-printer"></i> Print / Save as PDF</button>
                <button onclick="window.close()" class="btn btn-light btn-sm">Close Window</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">S.No</th>
                        <th>Payment Date</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Plan Name</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $payment)
                        <tr>
                            <td class="text-center fw-semibold text-muted">{{ $index + 1 }}</td>
                            <td>{{ date('d M Y', strtotime($payment->payment_date)) }}</td>
                            <td><strong class="text-primary">{{ $payment->userid }}</strong></td>
                            <td class="fw-bold">{{ $payment->name }}</td>
                            <td>{{ $payment->plan_name ?? 'N/A' }}</td>
                            <td class="fw-bold text-dark">₹{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td class="text-center">
                                @if(in_array(strtolower($payment->status), ['approved', 'success']))
                                    <span class="text-success fw-bold">Approved</span>
                                @elseif(in_array(strtolower($payment->status), ['pending', '']))
                                    <span class="text-warning fw-bold">Pending</span>
                                @else
                                    <span class="text-danger fw-bold">{{ $payment->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
