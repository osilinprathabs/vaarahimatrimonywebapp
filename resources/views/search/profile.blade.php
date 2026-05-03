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
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-4">
                @if($targetUser->latestProfileImage)
                    <img src="{{ asset('storage/' . $targetUser->latestProfileImage->image_name) }}" class="profile-main-img" alt="{{ $targetUser->name }}">
                @else
                    <img src="{{ asset('assets/images/' . ($targetUser->gender == 'Female' ? 'female.png' : 'men.png')) }}" class="profile-main-img" alt="Default Image">
                @endif
            </div>
            <div class="col-md-8 text-md-left mt-4 mt-md-0">
                <h1 class="display-4 font-weight-bold">{{ $targetUser->name }}</h1>
                <p class="lead mb-4"><i class="fa fa-id-card-o"></i> {{ $targetUser->userid }} | <i class="fa fa-map-marker"></i> {{ $targetUser->work_city ?? $targetUser->city }}, {{ $country->country ?? '' }}</p>
                <div class="d-flex flex-wrap gap-3">
                    <button class="btn btn-contact shadow-lg mr-3">Request Contact <i class="fa fa-phone"></i></button>
                    <button class="btn btn-light rounded-pill px-4 font-weight-bold" style="color: #ac0772;">Send Interest <i class="fa fa-heart"></i></button>
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
            </div>

            <div class="col-lg-4">
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
            </div>
        </div>
    </div>
</section>
@endsection

