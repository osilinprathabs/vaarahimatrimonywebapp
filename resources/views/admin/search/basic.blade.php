@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Basic Search</h2>
</header>

<section class="panel">
    <div class="panel-body">
        <form action="{{ route('admin.search.basic') }}" method="post" class="form-horizontal form-bordered">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ request('name') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">MID No</label>
                        <input type="text" name="userid" class="form-control" value="{{ request('userid') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Mobile No</label>
                        <input type="text" name="mobileno" class="form-control" value="{{ request('mobileno') }}">
                    </div>
                </div>
            </div>
            <div class="row mt-lg">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('admin.search.basic') }}" class="btn btn-default">Reset</a>
                </div>
            </div>
        </form>

        @if($members->count() > 0)
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>MID No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Status</th>
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
                            @if($member->status == 1)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-warning">Pending</span>
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
            {{ $members->appends(request()->all())->links() }}
        </div>
        @elseif(request()->isMethod('post'))
            <p class="text-center mt-lg">No records found.</p>
        @endif
    </div>
</section>
@endsection
