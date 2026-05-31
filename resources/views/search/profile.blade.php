@extends('layouts.frontend')

@section('styles')
<style>
    .profile-header { background: linear-gradient(135deg, #ac0772 0%, #a90771 50%, #5d0156 100%); color: #fff; padding: 40px 0; border-radius: 0 0 50px 50px; margin-bottom: 30px; }
    .profile-main-img { border: 5px solid #fff; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 300px; height: 350px; object-fit: cover; }
    .premium-card { background: #fff; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px; border: none; overflow: hidden; }
    .premium-card .card-header { background: #fdf2f8; border-bottom: 2px solid #f9a8d4; padding: 15px 25px; }
    .premium-card .card-header h5 { color: #831843; font-weight: 800; text-transform: uppercase; margin: 0; font-size: 18px; display: flex; align-items: center; }
    .premium-card .card-header h5 i { margin-right: 12px; color: #ac0772; }
    .premium-card .card-body { padding: 25px; }
    .detail-row { display: flex; border-bottom: 1px solid #f3f4f6; padding: 12px 0; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { flex: 0 0 40%; color: #6b7280; font-weight: 600; font-size: 14px; }
    .detail-value { flex: 1; color: #111827; font-weight: 700; font-size: 15px; }
    .horoscope-table { width: 100%; border-collapse: collapse; }
    .horoscope-table td { border: 2px solid #ac0772; width: 25%; height: 100px; text-align: center; vertical-align: middle; padding: 5px; font-size: 12px; font-weight: 700; background: #fff; }
    .horoscope-table td span { display: block; background: #fdf2f8; margin-bottom: 2px; padding: 2px; border-radius: 3px; color: #ac0772; }
    .btn-contact { background: #ac0772; color: #fff; border-radius: 30px; padding: 12px 30px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; }
    .btn-contact:hover { background: #5d0156; color: #fff; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(172, 7, 114, 0.4); }
</style>
@endsection

@section('content')


<div class="profile-header">
    <div class="container">
        <div class="d-flex justify-content-end mb-2">
            <a href="javascript:history.back()" class="btn px-4 py-2 rounded-pill shadow-sm" style="border: 1px solid rgba(255,255,255,0.35); background: rgba(255,255,255,0.18); color: #fff; font-weight: 700; transition: all 0.3s; font-size: 14px;">
                <i class="fa fa-arrow-left me-2"></i> Back to Search Results
            </a>
        </div>
        <div class="row align-items-center">
            <div class="col-md-4 text-center">
                @if($targetUser->latestProfileImage)
                    <img src="{{ storage_url($targetUser->latestProfileImage->image_name) }}" class="profile-main-img" alt="{{ $targetUser->name }}">
                @else
                    <img src="{{ asset('assets/images/' . ($targetUser->gender == 'Female' ? 'female.png' : 'men.png')) }}" class="profile-main-img" alt="Default Image">
                @endif
            </div>
            <div class="col-md-8 text-md-left mt-4 mt-md-0">
                <h1 class="display-4 font-weight-bold">{{ $targetUser->name }}</h1>
                <p class="lead mb-4"><i class="fa fa-id-card-o"></i> {{ $targetUser->userid }} | <i class="fa fa-map-marker"></i> {{ $targetUser->work_city ?? $targetUser->city }}, {{ $country->country ?? '' }}</p>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    @php
                        $hasAccess = $user && $user->hasContactAccessTo($targetUser);
                    @endphp

                    @if($hasAccess)
                        <span class="badge bg-success text-white rounded-pill px-4 py-2 fs-14"><i class="fa fa-check-circle me-1"></i> Contact Access Unlocked</span>
                    @else
                        @if(!$interest || $interest->status == 'Withdrawn')
                            <form id="express-interest-form" action="{{ route('interest.send', $targetUser->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="button" class="btn btn-contact shadow-lg px-4 py-2" onclick="handleExpressInterest()"><i class="fa fa-heart me-1"></i> Express Interest</button>
                            </form>
                        @elseif($interest->status == 'Pending')
                            @if($interest->from_member_id == $user->id)
                                <button class="btn btn-warning text-white rounded-pill px-4 py-2 fs-14" disabled>
                                    <i class="fa fa-clock me-1"></i> Interest Pending
                                </button>
                                <form id="withdraw-interest-form" action="{{ route('interest.withdraw', $interest->id) }}" method="POST" class="d-inline ms-2">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3" onclick="handleWithdrawInterest()">Withdraw</button>
                                </form>
                            @else
                                <div class="d-flex gap-2">
                                    <form id="accept-interest-form" action="{{ route('interest.accept', $interest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-success rounded-pill px-4 py-2" onclick="handleAcceptInterest()"><i class="fa fa-check me-1"></i> Accept</button>
                                    </form>
                                    <form id="reject-interest-form" action="{{ route('interest.reject', $interest->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="button" class="btn btn-danger rounded-pill px-4 py-2" onclick="handleRejectInterest()"><i class="fa fa-times me-1"></i> Decline</button>
                                    </form>
                                </div>
                            @endif
                        @elseif($interest->status == 'Rejected')
                            <span class="badge bg-danger text-white rounded-pill px-4 py-2 fs-14"><i class="fa fa-ban me-1"></i> Request Declined</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Personal Summary -->
                <div class="premium-card">
                    <div class="card-header">
                        <h5><i class="fa fa-user"></i> About Me / என்னைப் பற்றி</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 text-muted" style="line-height: 1.8; font-size: 16px;">
                            {{ $targetUser->about_me ?? 'No details provided yet.' }}
                        </p>
                    </div>
                </div>

                <!-- Basic Details -->
                <div class="premium-card">
                    <div class="card-header">
                        <h5><i class="fa fa-info-circle"></i> Basic Details / அடிப்படை விவரங்கள்</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-row"><span class="detail-label">Name</span><span class="detail-value">{{ $targetUser->name }}</span></div>
                                <div class="detail-row"><span class="detail-label">Age</span><span class="detail-value">{{ $targetUser->age }}</span></div>
                                <div class="detail-row"><span class="detail-label">Gender</span><span class="detail-value">{{ $targetUser->gender }}</span></div>
                                <div class="detail-row"><span class="detail-label">Date of Birth</span><span class="detail-value">{{ date('d-m-Y', strtotime($targetUser->date_of_birth)) }}</span></div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-row"><span class="detail-label">Marital Status</span><span class="detail-value">{{ $targetUser->maritalstatus }}</span></div>
                                <div class="detail-row"><span class="detail-label">Height</span><span class="detail-value">{{ $targetUser->height }}</span></div>
                                <div class="detail-row"><span class="detail-label">Weight</span><span class="detail-value">{{ $targetUser->weight }}</span></div>
                                <div class="detail-row"><span class="detail-label">Mother Tongue</span><span class="detail-value">{{ $targetUser->language }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($hasAccess)
                    <!-- Education & Career -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-graduation-cap"></i> Education & Career / கல்வி மற்றும் தொழில்</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Education</span><span class="detail-value">{{ $targetUser->education }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Education Detail</span><span class="detail-value">{{ $targetUser->education_detail ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Employed In</span><span class="detail-value">{{ $targetUser->employment }}</span></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Occupation</span><span class="detail-value">{{ $targetUser->occupation }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Company</span><span class="detail-value">{{ $targetUser->company_name ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Monthly Income</span><span class="detail-value">{{ $targetUser->currency_value }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Religious Details -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-university"></i> Religious & Horoscope / மத விவரங்கள்</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Religion</span><span class="detail-value">{{ $religion->religion ?? 'Hindu' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Caste</span><span class="detail-value">{{ $caste->caste ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Subcaste</span><span class="detail-value">{{ $subcaste->subcaste ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Gothram</span><span class="detail-value">{{ $targetUser->gothram ?? 'N/A' }}</span></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Raasi</span><span class="detail-value">{{ $raasi->name ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Star</span><span class="detail-value">{{ $star->name ?? $targetUser->star }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Lagnam</span><span class="detail-value">{{ $targetUser->laknam ?? 'N/A' }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Dosham</span><span class="detail-value">{{ $dosham->dosham ?? 'None' }}</span></div>
                                </div>
                            </div>

                            @if($horoscope)
                            <div class="mt-4">
                                <h6 class="font-weight-bold text-center mb-3">Raasi Chart / ராசி கட்டம்</h6>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <table class="horoscope-table">
                                            @php
                                                $chart = [
                                                    ['r12', 'r1', 'r2', 'r3'],
                                                    ['r11', 'TITLE', 'TITLE', 'r4'],
                                                    ['r10', 'TITLE', 'TITLE', 'r5'],
                                                    ['r9', 'r8', 'r7', 'r6']
                                                ];
                                            @endphp
                                            @foreach($chart as $rowIndex => $row)
                                                <tr>
                                                    @foreach($row as $colIndex => $cell)
                                                        @if($cell === 'TITLE')
                                                            @if($rowIndex == 1 && $colIndex == 1)
                                                                <td colspan="2" rowspan="2" style="background: #fdf2f8; font-size: 24px; color: #ac0772; border: 2px solid #ac0772;"><b>ராசி</b></td>
                                                            @endif
                                                        @else
                                                            <td>
                                                                @php
                                                                    $key = str_replace('r', 'rasi_', $cell);
                                                                    $planets = $horoscope->$key ? explode('||', $horoscope->$key) : [];
                                                                @endphp
                                                                @foreach($planets as $p)
                                                                    <span>{{ $p }}</span>
                                                                @endforeach
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Family Details -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-users"></i> Family Details / குடும்ப விவரங்கள்</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Father's Name</span><span class="detail-value">{{ $targetUser->father_name }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Father's Job</span><span class="detail-value">{{ $targetUser->father_occupation }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Mother's Name</span><span class="detail-value">{{ $targetUser->mother_name }}</span></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Mother's Job</span><span class="detail-value">{{ $targetUser->mother_occupation }}</span></div>
                                    <div class="detail-row"><span class="detail-label">No of Siblings</span><span class="detail-value">{{ $targetUser->no_of_siblings }}</span></div>
                                    <div class="detail-row"><span class="detail-label">Siblings Married</span><span class="detail-value">{{ $targetUser->no_of_siblings_married }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assets & Financials -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-money"></i> Assets & Financials / சொத்து விவரங்கள்</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Gold Details</span><span class="detail-value">{{ $targetUser->gold_details ?? 'N/A' }}</span></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row"><span class="detail-label">Property/Assets</span><span class="detail-value">{{ $targetUser->assets ?? 'N/A' }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expectations -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-heartbeat"></i> Partner Expectation / வரன் எதிர்பார்ப்பு</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0 text-muted" style="line-height: 1.8; font-size: 16px;">
                                {{ $targetUser->expectation ?? 'No specific expectations mentioned.' }}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="premium-card text-center p-5 border-0 shadow-sm mb-4" style="background: rgba(172, 7, 114, 0.02); border-radius: 16px; border: 1px dashed rgba(172, 7, 114, 0.15);">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 70px; height: 70px; background-color: #fdf2f8; color: #ac0772;">
                            <i class="fa fa-lock" style="font-size: 32px;"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: #5d0156;">Advanced Member Information Locked</h4>
                        <p class="text-muted mx-auto mb-4" style="max-width: 480px; font-size: 14px; line-height: 1.6;">
                            For privacy and security reasons, advanced information (Education, Occupation, Family, Assets, and Horoscope Chart) are hidden.
                            <strong>Express Interest</strong> or accept their request to unlock the complete profile details!
                        </p>
                        @if(!$interest || $interest->status == 'Withdrawn')
                            <form id="express-interest-form-locked" action="{{ route('interest.send', $targetUser->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="button" class="btn btn-contact px-4 py-2 shadow-sm rounded-pill fw-bold" style="font-size: 14px;" onclick="handleExpressInterestLocked()"><i class="fa fa-heart me-2"></i> Express Interest Request</button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <!-- Contact Details & Privacy Card -->
                <div class="premium-card">
                    <div class="card-header" style="background: {{ $hasAccess ? '#dcfce7' : '#fee2e2' }}; border-bottom: 2px solid {{ $hasAccess ? '#bbf7d0' : '#fecaca' }};">
                        <h5 style="color: {{ $hasAccess ? '#15803d' : '#991b1b' }};"><i class="fa fa-phone-square"></i> Contact Details / தொடர்பு விவரங்கள்</h5>
                    </div>
                    <div class="card-body">
                        @if($hasAccess)
                            <div class="detail-row">
                                <span class="detail-label">Mobile</span>
                                <span class="detail-value text-success font-weight-bold">{{ $targetUser->mobileno }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">WhatsApp</span>
                                <span class="detail-value text-success font-weight-bold">{{ $targetUser->whatsapp_no ?? $targetUser->mobileno }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Email</span>
                                <span class="detail-value text-success font-weight-bold">{{ $targetUser->emailid }}</span>
                            </div>
                            <div class="alert alert-success border-0 small mt-3 mb-0" style="border-radius: 8px;">
                                <i class="fa fa-unlock-alt me-1"></i> Full contact information has been unlocked for mutual matches!
                            </div>
                            
                            {{-- Script to log the contact view automatically on page load --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    $.ajax({
                                        url: "{{ route('contact.log') }}",
                                        type: "POST",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            profile_id: "{{ $targetUser->id }}",
                                            interest_id: "{{ $interest->id ?? 0 }}"
                                        },
                                        success: function(response) {
                                            console.log("Contact view auto-logged!");
                                        }
                                    });
                                });
                            </script>
                        @else
                            <div class="detail-row">
                                <span class="detail-label">Mobile</span>
                                <span class="detail-value text-muted">{{ $targetUser->masked_mobile }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">WhatsApp</span>
                                <span class="detail-value text-muted font-italic"><i class="fa fa-lock me-1"></i> Hidden</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Email</span>
                                <span class="detail-value text-muted">{{ $targetUser->masked_email }}</span>
                            </div>
                            <div class="alert alert-warning border-0 small mt-3 mb-0" style="border-radius: 8px;">
                                <i class="fa fa-info-circle me-1"></i> Contact details are masked for security. Complete and accept interest request to reveal!
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Location Info -->
                <div class="premium-card">
                    <div class="card-header">
                        <h5><i class="fa fa-map"></i> Location / இருப்பிடம்</h5>
                    </div>
                    <div class="card-body">
                        <div class="detail-row"><span class="detail-label">Country</span><span class="detail-value">{{ $country->country ?? 'India' }}</span></div>
                        <div class="detail-row"><span class="detail-label">State</span><span class="detail-value">{{ $state->state ?? 'Tamil Nadu' }}</span></div>
                        <div class="detail-row"><span class="detail-label">City</span><span class="detail-value">{{ $city->city ?? $targetUser->city }}</span></div>
                        <div class="mt-3">
                            <p class="detail-label mb-1">Residence Address</p>
                            <p class="font-weight-bold">{{ $targetUser->address }}</p>
                        </div>
                    </div>
                </div>

                @if($hasAccess)
                    <!-- Physical Attributes -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-smile-o"></i> Appearance</h5>
                        </div>
                        <div class="card-body">
                            <div class="detail-row"><span class="detail-label">Complexion</span><span class="detail-value">{{ $targetUser->complexion ?? 'Fair' }}</span></div>
                            <div class="detail-row"><span class="detail-label">Body Type</span><span class="detail-value">{{ $targetUser->body_type ?? 'Average' }}</span></div>
                            <div class="detail-row"><span class="detail-label">Disability</span><span class="detail-value text-danger">{{ $targetUser->disability ?? 'None' }}</span></div>
                            <div class="detail-row"><span class="detail-label">Blood Group</span><span class="detail-value">{{ $targetUser->blood_group ?? 'N/A' }}</span></div>
                        </div>
                    </div>

                    <!-- Lifestyle -->
                    <div class="premium-card">
                        <div class="card-header">
                            <h5><i class="fa fa-glass"></i> Lifestyle</h5>
                        </div>
                        <div class="card-body">
                            <div class="detail-row"><span class="detail-label">Food Habit</span><span class="detail-value">{{ $targetUser->food_habit ?? 'Non-Vegetarian' }}</span></div>
                            <div class="detail-row"><span class="detail-label">Smoking</span><span class="detail-value">{{ $targetUser->smoking_habit ?? 'No' }}</span></div>
                            <div class="detail-row"><span class="detail-label">Drinking</span><span class="detail-value">{{ $targetUser->drinking_habit ?? 'No' }}</span></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Express Interest from Header
    function handleExpressInterest() {
        Swal.fire({
            title: 'Express Interest?',
            text: "Would you like to send an interest request to {{ $targetUser->name }}?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ac0772',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Express Interest!',
            cancelButtonText: 'Cancel',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('express-interest-form').submit();
            }
        });
    }

    // Express Interest from Locked block
    function handleExpressInterestLocked() {
        Swal.fire({
            title: 'Send Interest Request?',
            text: "Send an interest request to {{ $targetUser->name }} to unlock their complete profile details?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ac0772',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Send Request!',
            cancelButtonText: 'Cancel',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('express-interest-form-locked').submit();
            }
        });
    }

    // Withdraw Interest
    function handleWithdrawInterest() {
        Swal.fire({
            title: 'Withdraw Request?',
            text: "Are you sure you want to withdraw your interest request to {{ $targetUser->name }}?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Withdraw!',
            cancelButtonText: 'Cancel',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('withdraw-interest-form').submit();
            }
        });
    }

    // Accept Interest Request
    function handleAcceptInterest() {
        Swal.fire({
            title: 'Accept Interest Request?',
            text: "Accept {{ $targetUser->name }}'s request and unlock mutual contact details?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Accept!',
            cancelButtonText: 'Cancel',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('accept-interest-form').submit();
            }
        });
    }

    // Reject/Decline Interest Request
    function handleRejectInterest() {
        Swal.fire({
            title: 'Decline Request?',
            text: "Are you sure you want to decline this interest request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, Decline!',
            cancelButtonText: 'Cancel',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reject-interest-form').submit();
            }
        });
    }

    // Success/Error auto-alerts
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#ac0772',
                timer: 4000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#ac0772'
            });
        @endif
    });
</script>
@endsection

