@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Basic Search</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold"><i class="ti ti-search me-2"></i>Filter Members</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.search.basic') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-user"></i></span>
                                <input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="Enter name...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">MID No</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-id"></i></span>
                                <input type="text" name="userid" class="form-control" value="{{ request('userid') }}" placeholder="e.g. MID123">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Gender</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-gender-intersex"></i></span>
                                <select name="gender" class="form-select">
                                    <option value="">All Genders</option>
                                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Mobile No</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-phone"></i></span>
                                <input type="text" name="mobileno" class="form-control" value="{{ request('mobileno') }}" placeholder="Enter mobile...">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4 fw-bold" style="border-radius: 8px;">
                                <i class="ti ti-search me-1"></i> Search Results
                            </button>
                            <a href="{{ route('admin.search.basic') }}" class="btn btn-light px-4 fw-bold" style="border-radius: 8px;">
                                <i class="ti ti-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($members->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Search Results ({{ $members->total() }})</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">S.No</th>
                                <th>MID No</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $i => $member)
                            <tr>
                                <td class="ps-4 text-muted">{{ ($members->currentPage()-1) * $members->perPage() + $i + 1 }}</td>
                                <td><span class="badge bg-light text-dark fw-bold border">{{ $member->userid }}</span></td>
                                <td class="fw-bold text-dark">{{ $member->name }}</td>
                                <td>
                                    @if($member->gender == 'Male')
                                        <span class="text-primary"><i class="ti ti-gender-male me-1"></i>{{ $member->gender }}</span>
                                    @else
                                        <span class="text-danger"><i class="ti ti-gender-female me-1"></i>{{ $member->gender }}</span>
                                    @endif
                                </td>
                                <td>{{ $member->mobileno }}</td>
                                <td>
                                    @if($member->status == 1)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Active</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 text-dark">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-sm btn-outline-primary rounded-circle p-1" title="View Profile">
                                        <i class="ti ti-eye fs-18"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-center">
                    {{ $members->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(request()->isMethod('post'))
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body text-center py-5">
                <i class="ti ti-search-off text-muted mb-3" style="font-size: 3rem;"></i>
                <h5 class="text-muted">No records found matching your criteria.</h5>
                <p class="text-muted-50">Try adjusting your filters or search terms.</p>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
