@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ $title ?? 'Add New Profile' }}</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">Profile Basic Information</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.members.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="onbehalf">Matrimony Profile For</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-users"></i></span>
                                <select name="onbehalf" id="onbehalf" class="form-select border-start-0" required>
                                    <option value="">Select Option</option>
                                    @foreach($onbehalfs as $onbe)
                                        <option value="{{ $onbe->id }}" {{ old('onbehalf') == $onbe->id ? 'selected' : '' }}>{{ $onbe->onbehalf }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('onbehalf') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="name">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-user"></i></span>
                                <input type="text" class="form-control border-start-0" id="name" name="name" required value="{{ old('name') }}" placeholder="Enter full name">
                            </div>
                            @error('name') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="gender">Gender</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-gender-male"></i></span>
                                <select class="form-select border-start-0" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            @error('gender') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="date_of_birth">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-calendar"></i></span>
                                <input type="date" class="form-control border-start-0" id="date_of_birth" name="date_of_birth" required value="{{ old('date_of_birth') }}">
                            </div>
                            @error('date_of_birth') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="email">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-mail"></i></span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com">
                            </div>
                            @error('email') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="mobileno">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-phone"></i></span>
                                <input type="text" class="form-control border-start-0" id="mobileno" name="mobileno" required value="{{ old('mobileno') }}" placeholder="Enter 10 digit number">
                            </div>
                            @error('mobileno') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="maritalstatus">Marital Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-heart"></i></span>
                                <select name="maritalstatus" class="form-select border-start-0" required>
                                    <option value="">Select Status</option>
                                    @foreach($marital_statuses as $ms)
                                        <option value="{{ $ms->marital_status }}" {{ old('maritalstatus') == $ms->marital_status ? 'selected' : '' }}>{{ $ms->marital_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="religion">Religion</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-world"></i></span>
                                <select name="religion" class="form-select border-start-0" required>
                                    <option value="">Select Religion</option>
                                    @foreach($religions as $rel)
                                        <option value="{{ $rel->id }}">{{ $rel->religion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold" for="password">Login Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="ti ti-lock"></i></span>
                                <input type="password" class="form-control border-start-0" id="password" name="password" required placeholder="Set password">
                            </div>
                            @error('password') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                        <a href="{{ route('admin.members.all') }}" class="btn btn-light px-4 fw-bold">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
