@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Master: {{ $label }}</h4>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fw-bold">{{ $label }} Data</h5>
        <button class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#addModal"><i class="ti ti-plus me-1"></i> Add New</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0" id="masterTable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Name</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $item)
                    <tr>
                        @php
                            $itemName = $item->$type ?? $item->name ?? $item->star ?? $item->raasi ?? $item->education ?? $item->occupation ?? $item->id;
                        @endphp
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td class="fw-bold">{{ $itemName }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success-subtle text-success me-1 edit-btn" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $itemName }}"
                                    data-parent-id="{{ $item->religion ?? $item->caste ?? '' }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal" title="Edit"><i class="ti ti-edit"></i></button>
                            <form action="{{ route('admin.master.delete', [$type, $item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger-subtle text-danger" onclick="return confirm('Are you sure?')" title="Delete"><i class="ti ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <form action="{{ route('admin.master.store', $type) }}" method="post">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Add {{ $label }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                    </div>
                    @if($type == 'caste' || $type == 'subcaste')
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ $type == 'caste' ? 'Religion' : 'Caste' }}</label>
                        <select name="parent_id" class="form-select" required>
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
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <form id="editForm" action="" method="post">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit {{ $label }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" placeholder="Enter name" required>
                    </div>
                    @if($type == 'caste' || $type == 'subcaste')
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ $type == 'caste' ? 'Religion' : 'Caste' }}</label>
                        <select name="parent_id" id="edit_parent_id" class="form-select" required>
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
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/js/pages/datatables-basic.js'])
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-btn');
    const editForm = document.getElementById('editForm');
    const editName = document.getElementById('edit_name');
    const editParentId = document.getElementById('edit_parent_id');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const parentId = this.getAttribute('data-parent-id');
            let url = "{{ route('admin.master.update', [$type, ':id']) }}";
            url = url.replace(':id', id);

            editForm.setAttribute('action', url);
            editName.value = name;
            if (editParentId) editParentId.value = parentId;
        });
    });
});
</script>
@endsection
