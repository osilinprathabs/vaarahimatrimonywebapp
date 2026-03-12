@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Premium Plans</h2>
</header>

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addPlanModal">Add Plan</button>
        </div>
        <h2 class="panel-title">Available Plans</h2>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Validity (Days)</th>
                        <th>Messages</th>
                        <th>Interests</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $i => $plan)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->amount }}</td>
                        <td>{{ $plan->validity }}</td>
                        <td>{{ $plan->messages }}</td>
                        <td>{{ $plan->interest }}</td>
                        <td>
                            <button class="btn btn-xs btn-success edit-plan-btn" 
                                    data-id="{{ $plan->id }}" 
                                    data-json="{{ json_encode($plan) }}"
                                    data-toggle="modal" 
                                    data-target="#editPlanModal">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Plan Modal -->
<div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.plans.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Plan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Plan Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Validity (Days)</label>
                            <input type="text" name="validity" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Messages</label>
                            <input type="text" name="messages" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Express Interest</label>
                            <input type="text" name="interest" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Plan Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Plan Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editPlanForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Edit Plan</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Plan Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="edit_amount" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Validity (Days)</label>
                            <input type="text" name="validity" id="edit_validity" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Messages</label>
                            <input type="text" name="messages" id="edit_messages" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.edit-plan-btn').on('click', function() {
        var plan = $(this).data('json');
        var url = "{{ route('admin.plans.update', ':id') }}";
        url = url.replace(':id', plan.id);

        $('#editPlanForm').attr('action', url);
        $('#edit_name').val(plan.name);
        $('#edit_amount').val(plan.amount);
        $('#edit_validity').val(plan.validity);
        $('#edit_messages').val(plan.messages);
    });
});
</script>
@endsection
