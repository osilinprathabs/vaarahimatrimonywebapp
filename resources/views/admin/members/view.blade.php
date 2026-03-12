@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>Member Details: {{ $member->name }} ({{ $member->userid }})</h2>
</header>

<div class="row">
    <div class="col-md-4">
        <section class="panel">
            <div class="panel-body">
                <div class="thumb-info mb-md">
                    @php
                        $profileImg = $images->where('type', 'Profile')->first();
                        $imgPath = $profileImg ? asset('upload/' . $profileImg->image_name) : asset('assets/images/profile/default.jpg');
                    @endphp
                    <img src="{{ $imgPath }}" class="rounded img-responsive" alt="{{ $member->name }}">
                    <div class="thumb-info-title">
                        <span class="thumb-info-inner">{{ $member->name }}</span>
                        <span class="thumb-info-type">{{ $member->gender }}</span>
                    </div>
                </div>

                <div class="widget-toggle-expand mb-md">
                    <div class="widget-header">
                        <h6>Quick Info</h6>
                    </div>
                    <div class="widget-content-collapsed">
                        <ul class="simple-todo-list">
                            <li><strong>Mobile:</strong> {{ $member->mobileno }}</li>
                            <li><strong>Email:</strong> {{ $member->emailid }}</li>
                            <li><strong>Status:</strong> 
                                @if($member->status == 1) <span class="label label-success">Active</span>
                                @elseif($member->status == 2) <span class="label label-danger">Suspended</span>
                                @else <span class="label label-warning">Pending</span> @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-8">
        <div class="tabs">
            <ul class="nav nav-tabs tabs-primary">
                <li class="active">
                    <a href="#overview" data-toggle="tab">Overview</a>
                </li>
                <li>
                    <a href="#photos" data-toggle="tab">Photos</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="overview" class="tab-pane active">
                    <h4 class="mb-md">Personal Information</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr><th>Name</th><td>{{ $member->name }}</td></tr>
                            <tr><th>Gender</th><td>{{ $member->gender }}</td></tr>
                            <tr><th>DOB</th><td>{{ $member->dob ?? 'N/A' }}</td></tr>
                            <tr><th>Marital Status</th><td>{{ $member->maritalstatus ?? 'N/A' }}</td></tr>
                            <tr><th>Religion</th><td>{{ $member->religion ?? 'N/A' }}</td></tr>
                            <tr><th>Caste</th><td>{{ $member->caste ?? 'N/A' }}</td></tr>
                            <tr><th>Educational Qualification</th><td>{{ $member->education ?? 'N/A' }}</td></tr>
                            <tr><th>Occupation</th><td>{{ $member->occupation ?? 'N/A' }}</td></tr>
                        </table>
                    </div>
                </div>
                <div id="photos" class="tab-pane">
                    <h4 class="mb-md">Profile & Document Images</h4>
                    <div class="row">
                        @forelse($images as $img)
                        <div class="col-md-4 mb-md">
                            <label>{{ $img->type }}</label>
                            <a href="{{ asset('upload/' . $img->image_name) }}" target="_blank">
                                <img src="{{ asset('upload/' . $img->image_name) }}" class="img-responsive thumbnail">
                            </a>
                        </div>
                        @empty
                        <p class="col-md-12">No images uploaded.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
