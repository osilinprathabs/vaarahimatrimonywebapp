@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Master: {{ $label }}</h2>
</header>

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addModal">Add New</button>
        </div>
        <h2 class="panel-title">{{ $label }} Data</h2>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="masterTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $item)
                    <tr>
                        @php
                            $itemName = $item->$type ?? $item->name ?? $item->star ?? $item->raasi ?? $item->education ?? $item->occupation ?? $item->id;
                        @endphp
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $itemName }}</td>
                        <td>
                            <button class="btn btn-xs btn-success edit-btn" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $itemName }}"
                                    data-parent-id="{{ $item->religion ?? $item->caste ?? '' }}"
                                    data-toggle="modal" 
                                    data-target="#editModal">Edit</button>
                            <form action="{{ route('admin.master.delete', [$type, $item->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.master.store', $type) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add {{ $label }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    @if($type == 'caste' || $type == 'subcaste')
                    <div class="form-group">
                        <label>{{ $type == 'caste' ? 'Religion' : 'Caste' }}</label>
                        <select name="parent_id" class="form-control" required>
                            @php
                                $parents = ($type == 'caste') ? \App\Models\Religion::all() : \App\Models\Caste::all();
                                $parentType = ($type == 'caste') ? 'religion' : 'caste';
                            @endphp
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->$parentType }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editForm" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit {{ $label }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    @if($type == 'caste' || $type == 'subcaste')
                    <div class="form-group">
                        <label>{{ $type == 'caste' ? 'Religion' : 'Caste' }}</label>
                        <select name="parent_id" id="edit_parent_id" class="form-control" required>
                            @php
                                $parents = ($type == 'caste') ? \App\Models\Religion::all() : \App\Models\Caste::all();
                                $parentType = ($type == 'caste') ? 'religion' : 'caste';
                            @endphp
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->$parentType }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#masterTable').DataTable();

    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var parentId = $(this).data('parent-id');
        var url = "{{ route('admin.master.update', [$type, ':id']) }}";
        url = url.replace(':id', id);

        $('#editForm').attr('action', url);
        $('#edit_name').val(name);
        $('#edit_parent_id').val(parentId);
    });
});
</script>
@endsection
