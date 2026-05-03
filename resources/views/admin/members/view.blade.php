@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Member Profile: {{ $member->name }}</h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-xl-4">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
            <div class="bg-primary py-5 px-3 text-center">
                @php
                    $profileImg = $images->where('type', 'Profile')->first();
                    $imgPath = $profileImg ? asset('storage/' . $profileImg->image_name) : asset('assets/images/profile/default.jpg');
                @endphp
                <img src="{{ $imgPath }}" class="rounded-circle border border-4 border-white shadow" style="width: 120px; height: 120px; object-fit: cover;" alt="{{ $member->name }}">
                <h4 class="text-white mt-3 mb-1 fw-bold">{{ $member->name }}</h4>
                <p class="text-white-50 mb-0"><span class="badge bg-white bg-opacity-25">{{ $member->userid }}</span></p>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="ti ti-gender-intersex me-2"></i>Gender</span>
                        <span class="fw-bold">{{ $member->gender }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="ti ti-phone me-2"></i>Mobile</span>
                        <span class="fw-bold">{{ $member->mobileno }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="ti ti-mail me-2"></i>Email</span>
                        <span class="fw-bold fs-12">{{ $member->emailid }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="ti ti-circle-check me-2"></i>Status</span>
                        @if($member->status == 1)
                            <span class="badge bg-success-subtle text-success">Active</span>
                        @elseif($member->status == 2)
                            <span class="badge bg-danger-subtle text-danger">Suspended</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning text-dark">Pending</span>
                        @endif
                    </li>
                </ul>
                <div class="mt-4 d-grid gap-2">
                    @if($member->status == 0)
                        <form method="post" action="{{ route('admin.members.approve', $member->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 fw-bold"><i class="ti ti-check me-1"></i> Approve Member</button>
                        </form>
                    @endif
                    @if($member->status != 2)
                        <form method="post" action="{{ route('admin.members.suspend', $member->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100"><i class="ti ti-ban me-1"></i> Suspend Account</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <ul class="nav nav-pills nav-justified bg-light p-1 rounded-pill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active rounded-pill fw-bold" data-bs-toggle="pill" href="#overview" role="tab">
                            <i class="ti ti-info-circle me-1"></i> Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fw-bold" data-bs-toggle="pill" href="#photos" role="tab">
                            <i class="ti ti-photo me-1"></i> Gallery
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content pt-2">
                    <div id="overview" class="tab-pane fade show active" role="tabpanel">
                        <!-- Basic Info -->
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="fw-bold mb-0 text-primary">Personal Details</h5>
                            <hr class="flex-grow-1 ms-3 my-0">
                        </div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Full Name</label>
                                <span class="fs-14 fw-semibold">{{ $member->name }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Gender</label>
                                <span class="fs-14 fw-semibold">{{ $member->gender }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Date of Birth</label>
                                <span class="fs-14 fw-semibold">{{ $member->date_of_birth ?? $member->dob ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Age</label>
                                <span class="fs-14 fw-semibold">{{ $member->age ?? 'N/A' }} Years</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Marital Status</label>
                                <span class="fs-14 fw-semibold">{{ $member->maritalstatus ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Mother Tongue</label>
                                <span class="fs-14 fw-semibold">{{ $member->language ?? $member->mother_tongue ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Religious Info -->
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="fw-bold mb-0 text-primary">Religious & Horoscope</h5>
                            <hr class="flex-grow-1 ms-3 my-0">
                        </div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Religion</label>
                                <span class="fs-14 fw-semibold">{{ $member->religion ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Caste / Subcaste</label>
                                <span class="fs-14 fw-semibold">{{ $member->caste ?? 'N/A' }} / {{ $member->subcaste ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Star / Raasi</label>
                                <span class="fs-14 fw-semibold">{{ $member->star ?? 'N/A' }} / {{ $member->raasi ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Gothram</label>
                                <span class="fs-14 fw-semibold">{{ $member->gothram ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Dosham</label>
                                <span class="fs-14 fw-semibold">{{ $member->dhosam ?? 'No' }} ({{ $member->dhosam_type ?? 'None' }})</span>
                            </div>
                        </div>

                        <!-- Professional Info -->
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="fw-bold mb-0 text-primary">Education & Profession</h5>
                            <hr class="flex-grow-1 ms-3 my-0">
                        </div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Education</label>
                                <span class="fs-14 fw-semibold">{{ $member->education ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Occupation</label>
                                <span class="fs-14 fw-semibold">{{ $member->occupation ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Income</label>
                                <span class="fs-14 fw-semibold">{{ $member->indian_currency_value ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Employment</label>
                                <span class="fs-14 fw-semibold">{{ $member->employment ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Family Info -->
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="fw-bold mb-0 text-primary">Family Details</h5>
                            <hr class="flex-grow-1 ms-3 my-0">
                        </div>
                        <div class="row g-4 mb-3">
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Father's Name</label>
                                <span class="fs-14 fw-semibold">{{ $member->father_name ?? 'N/A' }} ({{ $member->father_occupation ?? 'N/A' }})</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Mother's Name</label>
                                <span class="fs-14 fw-semibold">{{ $member->mother_name ?? 'N/A' }} ({{ $member->mother_occupation ?? 'N/A' }})</span>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Siblings</label>
                                <span class="fs-14 fw-semibold">{{ $member->no_of_siblings ?? 0 }} ({{ $member->no_of_siblings_married ?? 0 }} Married)</span>
                            </div>
                            <div class="col-md-12">
                                <label class="text-muted fs-11 text-uppercase fw-bold d-block mb-1">Family Origin</label>
                                <span class="fs-14 fw-semibold">{{ $member->family_origin ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Horoscope Charts -->
                        <div class="d-flex align-items-center mb-3 mt-5">
                            <h5 class="fw-bold mb-0 text-primary">Horoscope Charts</h5>
                            <hr class="flex-grow-1 ms-3 my-0">
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-center mb-3">Raasi Chart</h6>
                                <div class="horoscope-grid">
                                    <table class="table table-bordered text-center mb-0">
                                        <tr>
                                            <td style="width:25%; height:60px;">{{ $member->raasi_1 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->raasi_2 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->raasi_3 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->raasi_4 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->raasi_12 }}</td>
                                            <td colspan="2" rowspan="2" class="bg-light align-middle fw-bold">RAASI</td>
                                            <td style="height:60px;">{{ $member->raasi_5 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->raasi_11 }}</td>
                                            <td style="height:60px;">{{ $member->raasi_6 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->raasi_10 }}</td>
                                            <td style="height:60px;">{{ $member->raasi_9 }}</td>
                                            <td style="height:60px;">{{ $member->raasi_8 }}</td>
                                            <td style="height:60px;">{{ $member->raasi_7 }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-center mb-3">Amsam Chart</h6>
                                <div class="horoscope-grid">
                                    <table class="table table-bordered text-center mb-0">
                                        <tr>
                                            <td style="width:25%; height:60px;">{{ $member->amsam_1 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->amsam_2 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->amsam_3 }}</td>
                                            <td style="width:25%; height:60px;">{{ $member->amsam_4 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->amsam_12 }}</td>
                                            <td colspan="2" rowspan="2" class="bg-light align-middle fw-bold">AMSAM</td>
                                            <td style="height:60px;">{{ $member->amsam_5 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->amsam_11 }}</td>
                                            <td style="height:60px;">{{ $member->amsam_6 }}</td>
                                        </tr>
                                        <tr>
                                            <td style="height:60px;">{{ $member->amsam_10 }}</td>
                                            <td style="height:60px;">{{ $member->amsam_9 }}</td>
                                            <td style="height:60px;">{{ $member->amsam_8 }}</td>
                                            <td style="height:60px;">{{ $member->amsam_7 }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="photos" class="tab-pane fade" role="tabpanel">
                        <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Photo Gallery</h5>
                        <div class="row g-3">
                            @forelse($images as $img)
                            <div class="col-md-4">
                                <div class="card border shadow-none h-100 overflow-hidden" style="border-radius: 8px;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <span class="badge bg-dark bg-opacity-75">{{ $img->type }}</span>
                                    </div>
                                    <a href="{{ asset('storage/' . $img->image_name) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $img->image_name) }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="Member Image">
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center py-5">
                                <i class="ti ti-photo-off text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">No images uploaded for this member.</h5>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
