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
