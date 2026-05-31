@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $title ?? 'Members List' }}</h4>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="get" class="row g-2 align-items-center">
                        <div class="col-auto">
                            <select class="form-select" name="gender">
                                <option value="">Gender</option>
                                <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" name="status">
                                <option value="">Status</option>
                                <option value="active" {{ request('status') === 'active' || request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="inactive" {{ request('status') === 'inactive' || request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-light px-3">Reset</a>
                            
                            <!-- Premium Export Actions Dropdown -->
                            <div class="btn-group ms-1">
                                <button type="button" class="btn btn-outline-success dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-download me-1"></i> Export Data
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                                    <li><h6 class="dropdown-header text-muted">Export Filtered List</h6></li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', array_merge(request()->query(), ['format' => 'csv'])) }}">
                                            <i class="ti ti-file-type-csv text-primary me-2"></i> Export to CSV
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', array_merge(request()->query(), ['format' => 'excel'])) }}">
                                            <i class="ti ti-file-spreadsheet text-success me-2"></i> Export to Excel
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" target="_blank" href="{{ route('admin.members.export', array_merge(request()->query(), ['format' => 'pdf'])) }}">
                                            <i class="ti ti-file-type-pdf text-danger me-2"></i> Print / Save PDF
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header text-muted">Export Overall Entries</h6></li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', ['format' => 'csv']) }}">
                                            <i class="ti ti-file-type-csv text-muted me-2"></i> Export All to CSV
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.members.export', ['format' => 'excel']) }}">
                                            <i class="ti ti-file-spreadsheet text-muted me-2"></i> Export All to Excel
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="col-md-4 text-md-end">
                    @if(isset($show_add))
                    <a href="{{ route('admin.members.create') }}" class="btn btn-success"><i class="ti ti-plus me-1"></i> Add Member</a>
                    @endif
                </div> -->
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-centered align-middle table-nowrap mb-0" id="membersTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">S.No</th>
                            <th>MID No</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $i => $member)
                            <tr>
                                <td class="ps-3">{{ $i + 1 }}</td>
                                <td><span class="badge bg-light text-dark fw-bold fs-12">{{ $member->userid }}</span></td>
                                <td>
                                    <div class="fw-bold">{{ $member->name }}</div>
                                    <div class="text-muted small">{{ $member->emailid }}</div>
                                </td>
                                <td>{{ $member->gender }}</td>
                                <td>
                                    <div>{{ $member->mobileno }}</div>
                                    <div class="text-muted small">Joined: {{ date('d M Y', strtotime($member->date)) }}</div>
                                </td>
                                <td>
                                    @if($member->status == 1)
                                        @if($member->is_expired)
                                            <span class="badge bg-danger-subtle text-danger">Expired</span>
                                        @else
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @endif
                                    @elseif($member->status == 2)
                                        <span class="badge bg-secondary-subtle text-secondary">Suspended</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-sm btn-light"
                                            title="View Profile"><i class="ti ti-eye"></i></a>
                                        @if($member->status == 0)
                                            <form method="post" action="{{ route('admin.members.approve', $member->id) }}"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success-subtle text-success confirm-btn"
                                                    data-title="Approve Member?" data-text="Are you sure you want to approve this member?" data-confirm-btn="Yes, Approve" data-btn-class="btn-success" title="Approve"><i
                                                        class="ti ti-check"></i></button>
                                            </form>
                                        @endif
                                        @if($member->status == 1)
                                            <form method="post" action="{{ route('admin.members.suspend', $member->id) }}"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning-subtle text-warning confirm-btn"
                                                    data-title="Suspend Member?" data-text="Are you sure you want to suspend this member?" data-confirm-btn="Yes, Suspend" data-btn-class="btn-warning" title="Suspend"><i
                                                        class="ti ti-lock"></i></button>
                                            </form>
                                        @endif
                                        <form method="post" action="{{ route('admin.members.delete', $member->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger-subtle text-danger confirm-btn"
                                                data-title="Delete Member?" data-text="Are you sure you want to permanently delete this member?" data-confirm-btn="Yes, Delete" data-btn-class="btn-danger" title="Delete"><i
                                                    class="ti ti-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $members->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/datatables-basic.js'])
    <script>
        $(document).ready(function () {
            // Initialized by theme but we can add custom logic here
        });
    </script>
@endsection