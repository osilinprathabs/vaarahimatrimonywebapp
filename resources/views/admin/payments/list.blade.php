@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="page-title-box">
            <h4 class="page-title">Payment List</h4>
        </div>
        <div>
            <!-- Premium Export Actions Dropdown -->
            <div class="btn-group shadow-sm">
                <button type="button" class="btn btn-success dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-download me-1"></i> Export Payments
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.payments.export', ['format' => 'csv']) }}">
                            <i class="ti ti-file-type-csv text-primary me-2"></i> Export to CSV
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.payments.export', ['format' => 'excel']) }}">
                            <i class="ti ti-file-spreadsheet text-success me-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" target="_blank" href="{{ route('admin.payments.export', ['format' => 'pdf']) }}">
                            <i class="ti ti-file-type-pdf text-danger me-2"></i> Print / Save PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Date</th>
                        <th>MID No</th>
                        <th>Member Name</th>
                        <th>Plan Name</th>
                        <th>Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $i => $payment)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td>{{ date('d M Y', strtotime($payment->payment_date)) }}</td>
                        <td><span class="badge bg-light text-dark fw-bold">{{ $payment->userid }}</span></td>
                        <td class="fw-bold">{{ $payment->name }}</td>
                        <td>{{ $payment->plan_name ?? 'N/A' }}</td>
                        <td class="fw-bold text-primary">₹{{ number_format($payment->amount, 2) }}</td>
                        <td class="text-center">
                            @if(in_array(strtolower($payment->status), ['approved', 'success']))
                                <span class="badge bg-success-subtle text-success px-2.5 py-1 fw-semibold">Approved</span>
                            @elseif(in_array(strtolower($payment->status), ['pending', '']))
                                <span class="badge bg-warning-subtle text-warning px-2.5 py-1 fw-semibold">Pending</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1 fw-semibold">{{ ucfirst($payment->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(in_array(strtolower($payment->status), ['pending', '']))
                                <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-success rounded-pill px-3 py-1 shadow-sm" onclick="return confirm('Verify this payment and activate the Premium Plan for {{ addslashes($payment->name) }}?')">
                                        <i class="ti ti-circle-check me-1"></i> Verify &amp; Approve
                                    </button>
                                </form>
                            @else
                                <span class="text-success fw-semibold fs-13"><i class="ti ti-circle-check-filled me-1"></i> Verified</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="ti ti-receipt-off fs-32 d-block mb-2"></i>
                            No payment transactions recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
