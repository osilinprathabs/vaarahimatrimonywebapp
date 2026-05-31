@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted text-uppercase fs-12 fw-bold">Total Profiles</h6>
                        <h3 class="mb-0">{{ $profile_count }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-primary rounded fs-3">
                            <i class="ti ti-users"></i>
                        </span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.all') }}" class="text-primary fw-semibold fs-13">View Details <i class="ti ti-arrow-narrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted text-uppercase fs-12 fw-bold">Female Profiles</h6>
                        <h3 class="mb-0">{{ $female_count }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-info rounded fs-3">
                            <i class="ti ti-gender-female"></i>
                        </span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.all') }}?gender=Female" class="text-info fw-semibold fs-13">View Details <i class="ti ti-arrow-narrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted text-uppercase fs-12 fw-bold">Male Profiles</h6>
                        <h3 class="mb-0">{{ $male_count }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-warning rounded fs-3">
                            <i class="ti ti-gender-male"></i>
                        </span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.all') }}?gender=Male" class="text-warning fw-semibold fs-13">View Details <i class="ti ti-arrow-narrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted text-uppercase fs-12 fw-bold">Expired Profiles</h6>
                        <h3 class="mb-0">{{ $expired_count ?? 0 }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-danger rounded fs-3">
                            <i class="ti ti-alert-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.expired_list') }}" class="text-danger fw-semibold fs-13">View Details <i class="ti ti-arrow-narrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-4">
        <div class="card bg-primary text-white border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-white-50 mb-1 fw-bold fs-14">PENDING APPROVAL</h4>
                        <h2 class="text-white mb-0">{{ $pending_count }}</h2>
                    </div>
                    <div class="fs-1 text-white-50">
                        <i class="ti ti-clock"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.pending') }}" class="text-white fw-semibold">Take Action <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card bg-success text-white border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-white-50 mb-1 fw-bold fs-14">PREMIUM MEMBERS</h4>
                        <h2 class="text-white mb-0">{{ $premium_count }}</h2>
                    </div>
                    <div class="fs-1 text-white-50">
                        <i class="ti ti-star"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.premium') }}" class="text-white fw-semibold">View List <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card bg-secondary text-white border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-white-50 mb-1 fw-bold fs-14">FREE MEMBERS</h4>
                        <h2 class="text-white mb-0">{{ $free_count }}</h2>
                    </div>
                    <div class="fs-1 text-white-50">
                        <i class="ti ti-user"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.members.free') }}" class="text-white fw-semibold">View List <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(135deg, #ab0772 0%, #d41490 100%); color: white;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 text-uppercase fs-12 fw-bold">Interests Sent</h6>
                        <h3 class="mb-0 text-white">{{ $total_interests }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-20 rounded fs-3 text-white">
                            <i class="ti ti-heart"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%); color: white;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 text-uppercase fs-12 fw-bold">Accepted Mutual</h6>
                        <h3 class="mb-0 text-white">{{ $accepted_interests }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-20 rounded fs-3 text-white">
                            <i class="ti ti-check"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(135deg, #c62828 0%, #ef5350 100%); color: white;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 text-uppercase fs-12 fw-bold">Rejected Requests</h6>
                        <h3 class="mb-0 text-white">{{ $rejected_interests }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-20 rounded fs-3 text-white">
                            <i class="ti ti-ban"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card shadow-sm border-0" style="border-radius: 12px; background: linear-gradient(135deg, #f57c00 0%, #ffb74d 100%); color: white;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-white-50 text-uppercase fs-12 fw-bold">Pending Approval</h6>
                        <h3 class="mb-0 text-white">{{ $pending_interests }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-white bg-opacity-20 rounded fs-3 text-white">
                            <i class="ti ti-clock"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold"><i class="ti ti-award text-warning me-2"></i>Top Premium Members</h5>
                <span class="badge bg-light text-primary">Active Packages</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">MID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Plan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($top_premium_members as $member)
                            <tr>
                                <td class="ps-4 fw-bold text-primary">{{ $member->userid }}</td>
                                <td class="fw-bold">{{ $member->name }}</td>
                                <td>{{ $member->gender }}</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $member->plan }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No premium members found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold"><i class="ti ti-bolt text-danger me-2"></i>Most Active Users</h5>
                <span class="badge bg-light text-danger">Interests Sent</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">MID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Interests Sent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($most_active_users as $member)
                            <tr>
                                <td class="ps-4 fw-bold text-primary">{{ $member->userid }}</td>
                                <td class="fw-bold">{{ $member->name }}</td>
                                <td>{{ $member->gender }}</td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">{{ $member->sent_count }} Sent</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No interest activity recorded yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white;">
            <div class="card-body p-4">
                <h6 class="text-white-50 text-uppercase fw-bold mb-3"><i class="ti ti-trending-up me-1"></i> Highest Interest Sender</h6>
                @if($highest_sender)
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-white mb-1">{{ $highest_sender->name }}</h4>
                            <span class="text-white-50 small">{{ $highest_sender->userid }} | {{ $highest_sender->gender }}</span>
                        </div>
                        <div class="text-right">
                            <h2 class="fw-bold text-white mb-0">{{ $highest_sender->sent_count }}</h2>
                            <span class="text-white-50 small">Interests Sent</span>
                        </div>
                    </div>
                @else
                    <span class="text-white-50">No data available yet.</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #581c87 0%, #a855f7 100%); color: white;">
            <div class="card-body p-4">
                <h6 class="text-white-50 text-uppercase fw-bold mb-3"><i class="ti ti-arrow-down-left me-1"></i> Highest Interest Receiver</h6>
                @if($highest_receiver)
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h4 class="fw-bold text-white mb-1">{{ $highest_receiver->name }}</h4>
                            <span class="text-white-50 small">{{ $highest_receiver->userid }} | {{ $highest_receiver->gender }}</span>
                        </div>
                        <div class="text-right">
                            <h2 class="fw-bold text-white mb-0">{{ $highest_receiver->received_count }}</h2>
                            <span class="text-white-50 small">Received Requests</span>
                        </div>
                    </div>
                @else
                    <span class="text-white-50">No data available yet.</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">Recent Registrations</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-nowrap mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">S.No</th>
                                <th>Date</th>
                                <th>MID No</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_members as $i => $member)
                            <tr>
                                <td class="ps-4">{{ $i + 1 }}</td>
                                <td>{{ date('d M Y', strtotime($member->date)) }}</td>
                                <td><span class="badge bg-light text-dark fw-bold">{{ $member->userid }}</span></td>
                                <td class="fw-bold">{{ $member->name }}</td>
                                <td>{{ $member->gender }}</td>
                                <td>{{ $member->mobileno }}</td>
                                <td>
                                    @if($member->status == 1)
                                        @if($member->is_expired)
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-1" title="View Profile"><i class="ti ti-eye fs-18"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
