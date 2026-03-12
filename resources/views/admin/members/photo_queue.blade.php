@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Photo Approval Queue</h2>
</header>

<section class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Member ID</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($photos as $i => $photo)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $photo->userid }}</td>
                        <td>{{ $photo->name }}</td>
                        <td>
                            <a href="{{ asset('uploads/profiles/' . $photo->image) }}" target="_blank">
                                <img src="{{ asset('uploads/profiles/' . $photo->image) }}" width="80" height="80" class="img-thumbnail">
                            </a>
                        </td>
                        <td>
                            @if($photo->status == 0)
                                <span class="label label-warning">Pending</span>
                            @elseif($photo->status == 1)
                                <span class="label label-success">Approved</span>
                            @else
                                <span class="label label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.members.photo_update', $photo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-xs btn-success" {{ $photo->status == 1 ? 'disabled' : '' }}>Approve</button>
                            </form>
                            <form action="{{ route('admin.members.photo_update', $photo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="2">
                                <button type="submit" class="btn btn-xs btn-danger" {{ $photo->status == 2 ? 'disabled' : '' }}>Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $photos->links() }}
    </div>
</section>
@endsection
