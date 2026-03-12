@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>General Settings</h2>
</header>

<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">System Configuration</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" action="{{ route('admin.settings.update') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 control-label">Expire Date</label>
                        <div class="col-md-3">
                            <select name="expire_status" class="form-control">
                                <option value="">Select</option>
                                <option value="date" {{ ($settings->expire_status ?? '') == 'date' ? 'selected' : '' }}>Date</option>
                                <option value="month" {{ ($settings->expire_status ?? '') == 'month' ? 'selected' : '' }}>Month</option>
                                <option value="year" {{ ($settings->expire_status ?? '') == 'year' ? 'selected' : '' }}>Year</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="count" class="form-control" value="{{ $settings->count ?? '' }}" placeholder="Count">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
