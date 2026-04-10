@extends('layouts.admin')

@section('content')
<header class="page-header">
    <h2>{{ $title ?? 'Add Member' }}</h2>
</header>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Member Details</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" method="POST" action="{{ route('admin.members.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Full Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="gender">Gender</label>
                        <div class="col-md-6">
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Save Member</button>
                            <a href="{{ route('admin.members.all') }}" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
