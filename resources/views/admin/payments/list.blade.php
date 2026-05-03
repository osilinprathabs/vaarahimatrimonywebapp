@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Payment List</h4>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0" id="paymentsTable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Date</th>
                        <th>MID No</th>
                        <th>Member Name</th>
                        <th>Plan Name</th>
                        <th>Amount</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $i => $payment)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td>{{ date('d M Y', strtotime($payment->payment_date)) }}</td>
                        <td><span class="badge bg-light text-dark fw-bold">{{ $payment->userid }}</span></td>
                        <td class="fw-bold">{{ $payment->name }}</td>
                        <td>{{ $payment->plan_name ?? 'N/A' }}</td>
                        <td class="fw-bold text-primary">₹{{ number_format($payment->amount, 2) }}</td>
                        <td class="text-center">
                            @if($payment->payment_status == 'Approved')
                                <span class="badge bg-success-subtle text-success px-2 py-1">Approved</span>
                            @elseif($payment->payment_status == 'Pending')
                                <span class="badge bg-warning-subtle text-warning px-2 py-1">Pending</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-2 py-1">{{ $payment->payment_status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#paymentsTable').DataTable();
});
</script>
@endsection
