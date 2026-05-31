@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Premium Plans</h4>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-bold"><i class="ti ti-star me-2 text-warning"></i>Available Plans</h5>
                    <button class="btn btn-primary px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addPlanModal"
                        style="border-radius: 8px;">
                        <i class="ti ti-plus me-1"></i> Add New Plan
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">S.No</th>
                                    <th>Plan Details</th>
                                    <th>Amount</th>
                                    <th>Validity</th>
                                    <th>Privileges</th>
                                    <th class="text-center pe-4">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $i => $plan)
                                    <tr>
                                        <td class="ps-4 text-muted">{{ $i + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($plan->image)
                                                    <img src="{{ asset('uploads/' . $plan->image) }}" class="rounded me-2" width="40"
                                                        height="40" style="object-fit: cover;">
                                                @else
                                                    <div class="avatar-sm flex-shrink-0 me-2">
                                                        <span class="avatar-title bg-primary-subtle text-primary rounded fs-4">
                                                            <i class="ti ti-package"></i>
                                                        </span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark">{{ $plan->name }}</h6>
                                                    <small class="text-muted">ID: #PLN-{{ $plan->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span
                                                class="fw-bold text-primary fs-15">₹{{ number_format($plan->amount, 2) }}</span>
                                        </td>
                                        <td><span
                                                class="badge bg-info-subtle text-info px-2 py-1 border border-info-subtle">{{ $plan->validity }}
                                                Days</span></td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <small class="text-muted"><i
                                                        class="ti ti-message me-1"></i>{{ $plan->messages ?? 0 }}
                                                    Messages</small>
                                                <small class="text-muted"><i
                                                        class="ti ti-heart me-1"></i>{{ $plan->interest ?? 0 }}
                                                    Interests</small>
                                            </div>
                                        </td>
                                        <td class="text-center pe-4">
                                            <div class="d-flex justify-content-center gap-1">
                                                <button class="btn btn-sm btn-success-subtle text-success edit-plan-btn"
                                                    data-id="{{ $plan->id }}" data-json="{{ json_encode($plan) }}"
                                                    data-bs-toggle="modal" data-bs-target="#editPlanModal" title="Edit Plan">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                 <form action="{{ route('admin.plans.delete', $plan->id) }}" method="post" class="d-inline delete-plan-form">
                                                     @csrf
                                                     @method('DELETE')
                                                     <button type="button" class="btn btn-sm btn-danger-subtle text-danger delete-plan-btn" title="Delete Plan">
                                                         <i class="ti ti-trash"></i>
                                                     </button>
                                                 </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Plan Modal -->
    <div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                <form action="{{ route('admin.plans.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-bottom-0 pt-4 px-4">
                        <h5 class="modal-title fw-bold fs-18">Create New Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Plan Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="e.g. Gold Plan">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount (₹)</label>
                                <input type="number" name="amount" class="form-control" required placeholder="0.00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Validity (Days)</label>
                                <input type="number" name="validity" class="form-control" required placeholder="30">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Messages</label>
                                <input type="number" name="messages" class="form-control" placeholder="Max messages">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Express Interests</label>
                                <input type="number" name="interest" class="form-control" placeholder="Max interests">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Plan Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pb-4 px-4">
                        <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Save Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Plan Modal -->
    <div class="modal fade" id="editPlanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                <form id="editPlanForm" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-bottom-0 pt-4 px-4">
                        <h5 class="modal-title fw-bold fs-18">Edit Membership Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Plan Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount (₹)</label>
                                <input type="number" name="amount" id="edit_amount" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Validity (Days)</label>
                                <input type="number" name="validity" id="edit_validity" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Interest Count</label>
                                <input type="number" name="interest" id="edit_interest" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Update Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pb-4 px-4">
                        <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Update Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 CSS & JS CDNs -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Edit plan logic
            const editBtns = document.querySelectorAll('.edit-plan-btn');
            const editForm = document.getElementById('editPlanForm');

            editBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const plan = JSON.parse(this.getAttribute('data-json'));
                    let url = "{{ route('admin.plans.update', ':id') }}";
                    url = url.replace(':id', plan.id);

                    editForm.setAttribute('action', url);
                    document.getElementById('edit_name').value = plan.name;
                    document.getElementById('edit_amount').value = plan.amount;
                    document.getElementById('edit_validity').value = plan.validity;
                    document.getElementById('edit_interest').value = plan.interest;
                });
            });

            // 2. SweetAlert2 Delete Confirmation logic
            const deleteBtns = document.querySelectorAll('.delete-plan-btn');
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This premium plan package will be permanently deleted!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        background: '#ffffff',
                        customClass: {
                            popup: 'rounded-4 shadow-lg border-0'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // 3. Success / Error session flash popup alerts
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    background: '#ffffff',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            @endif
        });
    </script>
@endsection