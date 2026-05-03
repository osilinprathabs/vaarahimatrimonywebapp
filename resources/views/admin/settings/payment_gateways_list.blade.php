@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title">Payment Gateways</h4>
            <button class="btn btn-success px-3" data-bs-toggle="modal" data-bs-target="#addGatewayModal">
                <i class="ti ti-plus me-1"></i> Add Gateway
            </button>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3" style="width: 60px;">S.No</th>
                        <th>Gateway Name</th>
                        <th>Status</th>
                        <th>Mode</th>
                        <th>Last Updated</th>
                        <th class="text-end pe-3">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gateways as $i => $gateway)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light p-2 rounded me-3">
                                    <i class="ti ti-{{ strtolower($gateway->name) == 'razorpay' ? 'brand-paypal' : (strtolower($gateway->name) == 'stripe' ? 'credit-card' : 'wallet') }} fs-20 text-primary"></i>
                                </div>
                                <span class="fw-bold fs-14">{{ $gateway->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-switch fs-18">
                                <form action="{{ route('admin.settings.payment_gateway.toggle', $gateway->id) }}" method="POST">
                                    @csrf
                                    <input class="form-check-input cursor-pointer" type="checkbox" onchange="this.form.submit()" {{ $gateway->is_active ? 'checked' : '' }}>
                                </form>
                            </div>
                        </td>
                        <td>
                            @if($gateway->status == 'active')
                                <span class="badge bg-success-subtle text-success">Live Mode</span>
                            @elseif($gateway->status == 'test')
                                <span class="badge bg-warning-subtle text-warning">Test Mode</span>
                            @else
                                <span class="badge bg-light text-muted">Inactive</span>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $gateway->updated_at->format('d M Y, h:i A') }}
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.settings.payment_gateway.edit', $gateway->id) }}" class="btn btn-sm btn-light" title="Configure"><i class="ti ti-settings"></i></a>
                                <form action="{{ route('admin.settings.payment_gateway.delete', $gateway->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger-subtle text-danger" onclick="return confirm('Delete this gateway?')" title="Delete"><i class="ti ti-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Gateway Modal -->
<div class="modal fade" id="addGatewayModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Add New Payment Gateway</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.settings.payment_gateway.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gateway Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. PayTM, GPay, AmazonPay" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold">Create Gateway</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
