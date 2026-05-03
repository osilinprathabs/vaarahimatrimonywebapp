@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Photo Approval Queue</h4>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Photo Preview</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($photos as $i => $photo)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td><span class="badge bg-light text-dark fw-bold">{{ $photo->userid }}</span></td>
                        <td class="fw-bold">{{ $photo->name }}</td>
                        <td>
                            <a href="{{ asset('uploads/profiles/' . $photo->image) }}" target="_blank" class="d-inline-block">
                                <img src="{{ asset('uploads/profiles/' . $photo->image) }}" width="60" height="60" class="rounded shadow-sm" style="object-fit: cover;">
                            </a>
                        </td>
                        <td class="text-center">
                            @if($photo->status == 0)
                                <span class="badge bg-warning-subtle text-warning px-2 py-1">Pending</span>
                            @elseif($photo->status == 1)
                                <span class="badge bg-success-subtle text-success px-2 py-1">Approved</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-2 py-1">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                @if($photo->status != 1)
                                <form action="{{ route('admin.members.photo_update', $photo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-sm btn-success-subtle text-success" title="Approve"><i class="ti ti-check"></i></button>
                                </form>
                                @endif
                                @if($photo->status != 2)
                                <form action="{{ route('admin.members.photo_update', $photo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-sm btn-danger-subtle text-danger" title="Reject"><i class="ti ti-x"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $photos->links() }}
        </div>
    </div>
</div>
@endsection
