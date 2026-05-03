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
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-3">Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-light px-3">Reset</a>
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
                                                <button type="submit" class="btn btn-sm btn-success-subtle text-success"
                                                    onclick="return confirm('Approve this member?')" title="Approve"><i
                                                        class="ti ti-check"></i></button>
                                            </form>
                                        @endif
                                        @if($member->status == 1)
                                            <form method="post" action="{{ route('admin.members.suspend', $member->id) }}"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning-subtle text-warning"
                                                    onclick="return confirm('Suspend this member?')" title="Suspend"><i
                                                        class="ti ti-lock"></i></button>
                                            </form>
                                        @endif
                                        <form method="post" action="{{ route('admin.members.delete', $member->id) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger-subtle text-danger"
                                                onclick="return confirm('Delete this member?')" title="Delete"><i
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