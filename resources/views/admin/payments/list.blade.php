@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Payment List</h2>
</header>

<section class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="paymentsTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>MID No</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $i => $payment)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ $payment->userid }}</td>
                        <td>{{ $payment->name }}</td>
                        <td>{{ $payment->plan_name ?? 'N/A' }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>
                            @if($payment->payment_status == 'Approved')
                                <span class="label label-success">Approved</span>
                            @else
                                <span class="label label-warning">{{ $payment->payment_status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-md">
            {{ $payments->links() }}
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#paymentsTable').DataTable();
});
</script>
@endsection
