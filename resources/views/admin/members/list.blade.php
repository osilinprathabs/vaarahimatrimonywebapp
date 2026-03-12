@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>{{ $title ?? 'Members List' }}</h2>
</header>

<section class="panel">
    <div class="panel-body">
        <!-- Filter form -->
        <form name="filter-form" id="form-filter" method="get" class="form-inline" style="margin-bottom:15px;">
            <div class="form-group">
                <select class="form-control" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
            &nbsp;
            <div class="form-group">
                <select class="form-control" id="status_filter" name="status">
                    <option value="">Select Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            &nbsp;
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ url()->current() }}" class="btn btn-default">Reset</a>
            &nbsp;&nbsp;
            @if(isset($show_add))
            <a href="{{ route('admin.members.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Member</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="membersTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>MID No</th>
                        <th>Gender</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $i => $member)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $member->date }}</td>
                        <td>{{ $member->userid }}</td>
                        <td>{{ $member->gender }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->mobileno }}</td>
                        <td>{{ $member->emailid }}</td>
                        <td>{{ $member->password }}</td>
                        <td>
                            @if($member->status == 1)
                                @if($member->is_expired)
                                    <span class="label label-danger">Expired</span>
                                @else
                                    <span class="label label-success">Active</span>
                                @endif
                            @elseif($member->status == 2)
                                <span class="label label-danger">Suspended</span>
                            @else
                                <span class="label label-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> View</a>
                        </td>
                        <td>
                            @if($member->status == 0)
                            <form method="post" action="{{ route('admin.members.approve', $member->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-xs btn-success" onclick="return confirm('Approve this member?')">Approve</button>
                            </form>
                            @endif
                            <form method="post" action="{{ route('admin.members.delete', $member->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Delete this member?')">Delete</button>
                            </form>
                            @if($member->status == 1)
                            <form method="post" action="{{ route('admin.members.suspend', $member->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-xs btn-warning" onclick="return confirm('Suspend this member?')">Suspend</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $members->appends(request()->query())->links() }}
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#membersTable').DataTable({
        "pageLength": 25,
        "order": [[0, "desc"]],
        "columnDefs": [{"targets": [-1, -2], "orderable": false}]
    });
});
</script>
@endsection
