@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title">Interest Management</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Interests</li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Statistics Row --}}
<div class="row mt-3 g-3">
    <div class="col-md">
        <a href="{{ route('admin.interests.list') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 {{ !$status ? 'bg-primary text-white' : 'bg-white' }}" style="border-radius: 12px;">
                <div class="card-body py-3">
                    <h6 class="{{ !$status ? 'text-white-50' : 'text-muted' }} text-uppercase fs-11 fw-bold mb-1">All Interests</h6>
                    <h3 class="mb-0 {{ !$status ? 'text-white' : 'text-dark' }}">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md">
        <a href="{{ route('admin.interests.list', 'pending') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 {{ $status == 'pending' ? 'bg-warning text-dark' : 'bg-white' }}" style="border-radius: 12px;">
                <div class="card-body py-3">
                    <h6 class="{{ $status == 'pending' ? 'text-dark-50' : 'text-muted' }} text-uppercase fs-11 fw-bold mb-1">Pending</h6>
                    <h3 class="mb-0 {{ $status == 'pending' ? 'text-dark' : 'text-warning' }}">{{ $stats['pending'] }}</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md">
        <a href="{{ route('admin.interests.list', 'accepted') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 {{ $status == 'accepted' ? 'bg-success text-white' : 'bg-white' }}" style="border-radius: 12px;">
                <div class="card-body py-3">
                    <h6 class="{{ $status == 'accepted' ? 'text-white-50' : 'text-muted' }} text-uppercase fs-11 fw-bold mb-1">Accepted</h6>
                    <h3 class="mb-0 {{ $status == 'accepted' ? 'text-white' : 'text-success' }}">{{ $stats['accepted'] }}</h3>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md">
        <a href="{{ route('admin.interests.list', 'rejected') }}" class="text-decoration-none">
            <div class="card shadow-sm border-0 {{ $status == 'rejected' ? 'bg-danger text-white' : 'bg-white' }}" style="border-radius: 12px;">
                <div class="card-body py-3">
                    <h6 class="{{ $status == 'rejected' ? 'text-white-50' : 'text-muted' }} text-uppercase fs-11 fw-bold mb-1">Rejected</h6>
                    <h3 class="mb-0 {{ $status == 'rejected' ? 'text-white' : 'text-danger' }}">{{ $stats['rejected'] }}</h3>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Interests List Card --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">
                    {{ $status ? ucfirst($status) . ' Requests' : 'All Expressed Interests' }}
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn btn-sm btn-outline-success d-flex align-items-center"><i class="ti ti-download me-1"></i> Export CSV</a>
                    <form action="{{ url()->current() }}" method="GET" class="d-flex" style="max-width: 300px;">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control" placeholder="Search MID or Name..." value="{{ request('search') }}">
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
                                <th class="ps-4">Interest ID</th>
                                <th>From Member</th>
                                <th>To Member</th>
                                <th>Plan Used</th>
                                <th class="text-center">Credit Deducted</th>
                                <th>Status</th>
                                <th>Expressed Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($interests as $item)
                            <tr>
                                <td class="ps-4 fw-bold">INT{{ sprintf('%04d', $item->id) }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $item->sender->name ?? 'N/A' }}</span>
                                        <span class="small text-muted">{{ $item->sender->userid ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $item->receiver->name ?? 'N/A' }}</span>
                                        <span class="small text-muted">{{ $item->receiver->userid ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-primary border px-3 rounded-pill">{{ $item->plan_name ?? 'Free' }}</span>
                                </td>
                                <td class="text-center fw-bold text-success">{{ $item->consumed_interests }}</td>
                                <td>
                                    @if($item->status == 'Accepted')
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Accepted</span>
                                    @elseif($item->status == 'Pending')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill">Pending</span>
                                    @elseif($item->status == 'Rejected')
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 rounded-pill">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 rounded-pill">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No interest requests found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($interests->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $interests->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
