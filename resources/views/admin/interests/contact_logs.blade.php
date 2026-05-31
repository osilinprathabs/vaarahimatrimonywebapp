@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title">Contact Access Logs</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Contact Access Logs</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold">Reveal Activity Log</h5>
                    <p class="text-muted small mb-0">Tracks all instances where contact details were viewed after interest acceptance.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn btn-sm btn-outline-success d-flex align-items-center"><i class="ti ti-download me-1"></i> Export CSV</a>
                    <form action="{{ route('admin.contact_access_logs') }}" method="GET" class="d-flex" style="max-width: 300px;">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control" placeholder="Search Member ID or Name..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">S.No</th>
                                <th>Viewer Member (Customer A)</th>
                                <th>Profile Owner (Customer B)</th>
                                <th>Interest ID</th>
                                <th>Mobile Revealed</th>
                                <th>Email Revealed</th>
                                <th>Viewed Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $index => $log)
                            <tr>
                                <td class="ps-4 text-muted">{{ $logs->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $log->viewer->name ?? 'N/A' }}</span>
                                        <span class="small text-muted">{{ $log->viewer->userid ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $log->profileOwner->name ?? 'N/A' }}</span>
                                        <span class="small text-muted">{{ $log->profileOwner->userid ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-primary border px-2 py-1">INT{{ sprintf('%04d', $log->interest_id) }}</span>
                                </td>
                                <td>
                                    <span class="text-success font-weight-bold"><i class="ti ti-phone me-1"></i> {{ $log->mobile_viewed ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="text-muted"><i class="ti ti-mail me-1"></i> {{ $log->email_viewed ?? 'N/A' }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($log->viewed_time)->format('d M Y, h:i A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No contact view logs recorded yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($logs->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $logs->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
