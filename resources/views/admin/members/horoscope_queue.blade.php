@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Horoscope Approval Queue</h2>
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
                        <th>Horoscope File</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($horoscopes as $i => $horoscope)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $horoscope->userid }}</td>
                        <td>{{ $horoscope->name }}</td>
                        <td>
                            <a href="{{ asset('uploads/horoscopes/' . $horoscope->image) }}" target="_blank" class="btn btn-xs btn-info">
                                <i class="fa fa-file-image-o"></i> View File
                            </a>
                        </td>
                        <td>
                            @if($horoscope->status == 0)
                                <span class="label label-warning">Pending</span>
                            @elseif($horoscope->status == 1)
                                <span class="label label-success">Approved</span>
                            @else
                                <span class="label label-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.members.horoscope_update', $horoscope->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-xs btn-success" {{ $horoscope->status == 1 ? 'disabled' : '' }}>Approve</button>
                            </form>
                            <form action="{{ route('admin.members.horoscope_update', $horoscope->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="2">
                                <button type="submit" class="btn btn-xs btn-danger" {{ $horoscope->status == 2 ? 'disabled' : '' }}>Reject</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $horoscopes->links() }}
    </div>
</section>
@endsection
