@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Expired Members List</h2>
</header>

<section class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="expiredTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>MID No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $i => $member)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $member->userid }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->gender }}</td>
                        <td>{{ $member->mobileno }}</td>
                        <td>
                            @if(isset($member->plan_end_date))
                                {{ $member->plan_end_date }}
                            @else
                                <span class="text-danger">Profile Expired</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.members.view', $member->id) }}" class="btn btn-xs btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-md">
            {{ $members->links() }}
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#expiredTable').DataTable();
});
</script>
@endsection
