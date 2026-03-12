@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Dashboard</h2>
</header>

<!-- start: page -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total Profiles</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $profile_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ route('admin.members.all') }}">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel panel-featured-left panel-featured-secondary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fa fa-female" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total No of Female</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $female_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.members.all') }}?gender=Female" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel panel-featured-left panel-featured-tertiary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-tertiary">
                                    <i class="fa fa-male" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total No of Male</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $male_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.members.all') }}?gender=Male" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel panel-featured-left panel-featured-danger">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-danger">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Expired Profiles</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $expired_count ?? 0 }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.expired_list') }}" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-4">
                <section class="panel panel-featured-left panel-featured-quaternary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-quaternary">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Pending Approval</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $pending_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.members.pending') }}" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Premium Members</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $premium_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.members.premium') }}" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel panel-featured-left panel-featured-secondary">
                    <div class="panel-body">
                        <div class="widget-summary widget-summary-md">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Free Members</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $free_count }}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('admin.members.free') }}" class="text-muted text-uppercase">(View Details)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Recent Members Table -->
        <div class="row" style="margin-top:30px;">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Recent Members</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Date</th>
                                    <th>MID No</th>
                                    <th>Gender</th>
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_members as $i => $member)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $member->date }}</td>
                                    <td>{{ $member->userid }}</td>
                                    <td>{{ $member->gender }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->mobileno }}</td>
                                    <td>
                                        @if($member->status == 1)
                                            @if($member->is_expired)
                                                <span class="label label-danger">Expired</span>
                                            @else
                                                <span class="label label-success">Active</span>
                                            @endif
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
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
