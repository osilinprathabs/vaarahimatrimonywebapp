@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="page-title-box">
            <h4 class="page-title">Expired Members List</h4>
        </div>
        <div>
            <!-- Premium Export Actions Dropdown -->
            <div class="btn-group shadow-sm">
                <button type="button" class="btn btn-success dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-download me-1"></i> Export Expired
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', ['list_type' => 'expired', 'format' => 'csv']) }}">
                            <i class="ti ti-file-type-csv text-primary me-2"></i> Export to CSV
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', ['list_type' => 'expired', 'format' => 'excel']) }}">
                            <i class="ti ti-file-spreadsheet text-success me-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" target="_blank" href="{{ route('admin.members.export', ['list_type' => 'expired', 'format' => 'pdf']) }}">
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
            <table class="table table-hover table-centered align-middle table-nowrap mb-0" id="expiredTable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>MID No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Expiry Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $i => $member)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td><span class="badge bg-light text-dark fw-bold">{{ $member->userid }}</span></td>
                        <td class="fw-bold">{{ $member->name }}</td>
                        <td>{{ $member->gender }}</td>
                        <td>{{ $member->mobileno }}</td>
                        <td>
                            @if(isset($member->plan_end_date))
                                <span class="text-danger fw-semibold"><i class="ti ti-calendar-off me-1"></i> {{ date('d M Y', strtotime($member->plan_end_date)) }}</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1 fw-semibold">Profile Expired</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                                <i class="ti ti-eye me-1"></i> View Profile
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="ti ti-users-minus fs-32 d-block mb-2"></i>
                            No expired members found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $members->links() }}
        </div>
    </div>
</div>
@endsection
