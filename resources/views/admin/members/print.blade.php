<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Report (PDF/Print) - Sri Vaarahi Matrimony</title>
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
                <p class="meta-text m-0">Members Export Report — Generated on {{ date('d M Y, h:i A') }}</p>
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
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>Plan</th>
                        <th>Reg. Date</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $index => $member)
                        <tr>
                            <td class="text-center fw-semibold text-muted">{{ $index + 1 }}</td>
                            <td><strong class="text-primary">{{ $member->userid }}</strong></td>
                            <td class="fw-bold">{{ $member->name }}</td>
                            <td>{{ $member->gender }}</td>
                            <td>{{ $member->mobileno }}</td>
                            <td>{{ $member->email ?? 'N/A' }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $member->plan ?? 'Free' }}</span></td>
                            <td>{{ date('d M Y', strtotime($member->date)) }}</td>
                            <td class="text-center">
                                @if($member->status == 1)
                                    <span class="text-success fw-bold">Active</span>
                                @elseif($member->status == 0)
                                    <span class="text-warning fw-bold">Pending</span>
                                @elseif($member->status == 2)
                                    <span class="text-danger fw-bold">Suspended</span>
                                @else
                                    <span class="text-muted fw-bold">Deleted</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Auto trigger browser native high-fidelity print to PDF dialog
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
