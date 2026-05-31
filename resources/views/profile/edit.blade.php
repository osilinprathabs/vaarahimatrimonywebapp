@extends('layouts.frontend')

@section('styles')
<style>
    .profile-card {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        background: #fff;
    }
    .edit-tab-btn {
        padding: 12px 20px;
        font-weight: 700;
        color: #64748b;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }
    .edit-tab-btn:hover {
        color: #ab0772;
    }
    .edit-tab-btn.active {
        color: #ab0772;
        border-bottom-color: #ab0772;
    }
    label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        color: #475569;
        margin-bottom: 6px;
        letter-spacing: 0.3px;
    }
    .form-control, .form-select {
        height: 48px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 10px 16px;
        font-size: 15px;
        color: #1e293b;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ab0772;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(171, 7, 114, 0.1);
    }
    .table-horoscope td {
        width: 25%;
        height: 90px !important;
        position: relative;
        padding: 4px !important;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
    }
    .table-horoscope select[multiple] {
        height: 100% !important;
        width: 100% !important;
        border: none !important;
        background: transparent !important;
        font-size: 11px !important;
        padding: 2px !important;
    }
    .btn-save-profile {
        background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%) !important;
        border: none;
        border-radius: 30px;
        padding: 12px 30px;
        font-weight: bold;
        color: #fff;
        transition: all 0.3s ease;
    }
    .btn-save-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(169, 7, 113, 0.3);
    }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            {{-- Member Sidebar Left --}}
            @include('partials.member_sidebar')

            {{-- Main Form Right --}}
            <div class="col-lg-9">
                <div class="card profile-card shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold mb-1" style="color: #ab0772;">Edit My Profile Details</h3>
                                <p class="text-muted small mb-0">Keep your details updated to find matches faster.</p>
                            </div>
                            <a href="{{ route('profile.view', $user->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fa fa-eye me-1"></i> View Public Profile
                            </a>
                        </div>
                    </div>

                    @if(session('status') === 'profile-updated')
                        <div class="alert alert-success border-0 shadow-sm mx-4 mt-3 py-3 px-4 d-flex align-items-center" style="border-radius: 12px;">
                            <i class="fa fa-check-circle fs-4 me-3 text-success"></i>
                            <div>
                                <strong class="d-block text-success">Profile Saved Successfully!</strong>
                                <span class="small text-muted">All details have been updated and are now live.</span>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mx-4 mt-3 py-3 px-4" style="border-radius: 12px;">
                            <strong class="d-block text-danger mb-2"><i class="fa fa-exclamation-circle me-2"></i>Please resolve the following errors:</strong>
                            <ul class="mb-0 small text-danger ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body p-4">
                        {{-- Tabs Navigation --}}
                        <ul class="nav nav-tabs border-bottom mb-4" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link edit-tab-btn active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">
                                    <i class="fa fa-user me-2"></i>Basic & Contact
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link edit-tab-btn" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab">
                                    <i class="fa fa-graduation-cap me-2"></i>Education & Career
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link edit-tab-btn" id="astro-tab" data-bs-toggle="tab" data-bs-target="#astro" type="button" role="tab">
                                    <i class="fa fa-moon me-2"></i>Astro & Religion
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link edit-tab-btn" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab">
                                    <i class="fa fa-users me-2"></i>Personal & Family
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link edit-tab-btn" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                                    <i class="fa fa-shield-halved me-2"></i>Security & Uploads
                                </button>
                            </li>
                        </ul>

                        {{-- Form Start --}}
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="tab-content" id="profileTabsContent">
                                {{-- Tab 1: Basic & Contact --}}
                                <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Name / வரன் பெயர் <span class="text-danger">*</span></label>
                                            <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Gender / பாலினம் <span class="text-danger">*</span></label>
                                            <select name="gender" class="form-select" required>
                                                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male / ஆண்</option>
                                                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female / பெண்</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email ID / மின்னஞ்சல் <span class="text-danger">*</span></label>
                                            <input name="emailid" type="email" class="form-control" value="{{ old('emailid', $user->emailid) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>WhatsApp Number / வாட்ஸ்அப் எண் <span class="text-danger">*</span></label>
                                            <input name="whatsapp_no" type="text" class="form-control" value="{{ old('whatsapp_no', $user->whatsapp_no) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Date of Birth / பிறந்த தேதி <span class="text-danger">*</span></label>
                                            <input name="dob" type="date" class="form-control" value="{{ old('dob', $user->date_of_birth) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Time of Birth / பிறந்த நேரம் <span class="text-danger">*</span></label>
                                            <input name="birth_time" type="time" class="form-control" value="{{ old('birth_time', $user->birth_time) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Birth Place / பிறந்த இடம் <span class="text-danger">*</span></label>
                                            <input name="birth_city" type="text" class="form-control" value="{{ old('birth_city', $user->birth_city) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Marital Status / திருமண நிலை <span class="text-danger">*</span></label>
                                            <select name="maritalstatus" class="form-select" required>
                                                @foreach($marital_statuses as $mar)
                                                    <option value="{{ $mar->marital_status }}" {{ old('maritalstatus', $user->maritalstatus) == $mar->marital_status ? 'selected' : '' }}>{{ $mar->marital_status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Profile For / சுயவிபரம் யாருக்கு <span class="text-danger">*</span></label>
                                            <select name="onbehalf" class="form-select" required>
                                                @foreach($onbehalfs as $onbe)
                                                    <option value="{{ $onbe->id }}" {{ old('onbehalf', $user->onbehalf) == $onbe->id ? 'selected' : '' }}>{{ $onbe->onbehalf }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mother Tongue / தாய்மொழி <span class="text-danger">*</span></label>
                                            <select name="language" class="form-select" required>
                                                <option value="Tamil / தமிழ்" {{ old('language', $user->language) == 'Tamil / தமிழ்' ? 'selected' : '' }}>Tamil / தமிழ்</option>
                                                <option value="English / ஆங்கிலம்" {{ old('language', $user->language) == 'English / ஆங்கிலம்' ? 'selected' : '' }}>English / ஆங்கிலம்</option>
                                                <option value="Telugu / தெலுங்கு" {{ old('language', $user->language) == 'Telugu / தெலுங்கு' ? 'selected' : '' }}>Telugu / தெலுங்கு</option>
                                                <option value="Kannada / கன்னடம்" {{ old('language', $user->language) == 'Kannada / கன்னடம்' ? 'selected' : '' }}>Kannada / கன்னடம்</option>
                                                <option value="Malayalam / மலையாளம்" {{ old('language', $user->language) == 'Malayalam / மலையாளம்' ? 'selected' : '' }}>Malayalam / மலையாளம்</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 2: Education & Career --}}
                                <div class="tab-pane fade" id="education" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Education / கல்வி தகுதி <span class="text-danger">*</span></label>
                                            <select name="education" class="form-select" required>
                                                @foreach($educations as $edu)
                                                    <option value="{{ $edu->education }}" {{ old('education', $user->education) == $edu->education ? 'selected' : '' }}>{{ $edu->education }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Education Detail / கல்வி விவரம்</label>
                                            <input name="education_detail" type="text" class="form-control" value="{{ old('education_detail', $user->education_detail) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Employed In / வேலை வகை <span class="text-danger">*</span></label>
                                            <select name="employment" class="form-select" required>
                                                @foreach($employments as $emp)
                                                    <option value="{{ $emp->employment }}" {{ old('employment', $user->employment) == $emp->employment ? 'selected' : '' }}>{{ $emp->employment }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Occupation / தொழில் <span class="text-danger">*</span></label>
                                            <select name="occupation" class="form-select" required>
                                                @foreach($occupations as $occ)
                                                    <option value="{{ $occ->occupation }}" {{ old('occupation', $user->occupation) == $occ->occupation ? 'selected' : '' }}>{{ $occ->occupation }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Company Name / நிறுவனத்தின் பெயர்</label>
                                            <input name="company_name" type="text" class="form-control" value="{{ old('company_name', $user->company_name) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Monthly Income / மாத வருமானம் <span class="text-danger">*</span></label>
                                            <select name="indian_currency_value" class="form-select" required>
                                                @foreach($currency_values as $cv)
                                                    <option value="{{ $cv->currency_value }}" {{ old('indian_currency_value', $user->currency_value) == $cv->currency_value ? 'selected' : '' }}>{{ $cv->currency_value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Work Location / பணிபுரியும் நாடு</label>
                                            <select name="work_location" class="form-select">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->countryid }}" {{ old('work_location', $user->work_location) == $country->countryid ? 'selected' : '' }}>{{ $country->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 3: Astro & Religion --}}
                                <div class="tab-pane fade" id="astro" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Caste / ஜாதி <span class="text-danger">*</span></label>
                                            <select name="caste" id="caste" class="form-select" required>
                                                @foreach($castes as $caste)
                                                    <option value="{{ $caste->id }}" {{ old('caste', $user->caste) == $caste->id ? 'selected' : '' }}>{{ $caste->caste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Subcaste / உட்பிரிவு <span class="text-danger">*</span></label>
                                            <select name="subcaste" id="subcaste" class="form-select" required>
                                                @foreach($subcastes as $sub)
                                                    <option value="{{ $sub->id }}" {{ old('subcaste', $user->subcaste) == $sub->id ? 'selected' : '' }}>{{ $sub->subcaste }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Raasi / ராசி <span class="text-danger">*</span></label>
                                            <select name="raasi" id="raasi" class="form-select" required>
                                                @foreach($raasis as $r)
                                                    <option value="{{ $r->id }}" {{ old('raasi', $user->raasi) == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Star / நட்சத்திரம் <span class="text-danger">*</span></label>
                                            <select name="star" id="star" class="form-select" required>
                                                @foreach($stars as $s)
                                                    <option value="{{ $s->id }}" {{ old('star', $user->star) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Gothram / கோத்திரம்</label>
                                            <input name="gothram" type="text" class="form-control" value="{{ old('gothram', $user->gothram) }}">
                                        </div>

                                        {{-- Horoscope Charts --}}
                                        <div class="col-lg-12 mt-4">
                                            <div class="row">
                                                {{-- Raasi Grid --}}
                                                <div class="col-md-6">
                                                    <h5 class="fw-bold mb-3" style="color: #ab0772;">Raasi Chart / ராசி கட்டம்</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-horoscope text-center">
                                                            @php
                                                                $planets = ["Lagnam", "Sun", "Moon", "Mars", "Mercury", "Jupiter", "Venus", "Saturn", "Rahu", "Kethu"];
                                                                function getPreselectedPlanets($horo, $cellNum) {
                                                                    if (!$horo) return [];
                                                                    $key = "rasi_" . $cellNum;
                                                                    return $horo->$key ? explode('||', $horo->$key) : [];
                                                                }
                                                                function renderHoroSelect($planets, $preselected, $cellNum, $type) {
                                                                    $html = '<select name="'.$type.'_'.$cellNum.'[]" class="form-select" multiple>';
                                                                    foreach ($planets as $p) {
                                                                        $sel = in_array($p, $preselected) ? 'selected' : '';
                                                                        $html .= '<option value="'.$p.'" '.$sel.'>'.$p.'</option>';
                                                                    }
                                                                    $html .= '</select>';
                                                                    return $html;
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 12), 12, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 1), 1, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 2), 2, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 3), 3, 'raasi') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 11), 11, 'raasi') !!}</td>
                                                                <td colspan="2" rowspan="2" class="align-middle bg-white fw-bold text-primary">ராசி</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 4), 4, 'raasi') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 10), 10, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 5), 5, 'raasi') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 9), 9, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 8), 8, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 7), 7, 'raasi') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedPlanets($horoscope, 6), 6, 'raasi') !!}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                {{-- Amsam Grid --}}
                                                <div class="col-md-6">
                                                    <h5 class="fw-bold mb-3" style="color: #ab0772;">Amsam Chart / அம்சம் கட்டம்</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-horoscope text-center">
                                                            @php
                                                                function getPreselectedAmsamPlanets($horo, $cellNum) {
                                                                    if (!$horo) return [];
                                                                    $key = "amsam_" . $cellNum;
                                                                    return $horo->$key ? explode('||', $horo->$key) : [];
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 12), 12, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 1), 1, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 2), 2, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 3), 3, 'amsam') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 11), 11, 'amsam') !!}</td>
                                                                <td colspan="2" rowspan="2" class="align-middle bg-white fw-bold text-primary">அம்சம்</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 4), 4, 'amsam') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 10), 10, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 5), 5, 'amsam') !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 9), 9, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 8), 8, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 7), 7, 'amsam') !!}</td>
                                                                <td>{!! renderHoroSelect($planets, getPreselectedAmsamPlanets($horoscope, 6), 6, 'amsam') !!}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 4: Personal & Family --}}
                                <div class="tab-pane fade" id="family" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label>Height / உயரம் <span class="text-danger">*</span></label>
                                            <select name="height" class="form-select" required>
                                                @foreach($heights as $h)
                                                    <option value="{{ $h->height }}" {{ old('height', $user->height) == $h->height ? 'selected' : '' }}>{{ $h->height }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Weight / எடை <span class="text-danger">*</span></label>
                                            <select name="weight" class="form-select" required>
                                                @for($i=35; $i<=150; $i++)
                                                    <option value="{{ $i }}" {{ old('weight', $user->weight) == $i ? 'selected' : '' }}>{{ $i }} Kgs</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Body Type / உடல் அமைப்பு</label>
                                            <select name="body_type" class="form-select">
                                                <option value="Average" {{ old('body_type', $user->body_type) == 'Average' ? 'selected' : '' }}>Average</option>
                                                <option value="Slim" {{ old('body_type', $user->body_type) == 'Slim' ? 'selected' : '' }}>Slim</option>
                                                <option value="Athletic" {{ old('body_type', $user->body_type) == 'Athletic' ? 'selected' : '' }}>Athletic</option>
                                                <option value="Heavy" {{ old('body_type', $user->body_type) == 'Heavy' ? 'selected' : '' }}>Heavy</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Complexion / நிறம்</label>
                                            <select name="complexion" class="form-select">
                                                <option value="Fair" {{ old('complexion', $user->complexion) == 'Fair' ? 'selected' : '' }}>Fair</option>
                                                <option value="Very Fair" {{ old('complexion', $user->complexion) == 'Very Fair' ? 'selected' : '' }}>Very Fair</option>
                                                <option value="Wheatish" {{ old('complexion', $user->complexion) == 'Wheatish' ? 'selected' : '' }}>Wheatish</option>
                                                <option value="Dark" {{ old('complexion', $user->complexion) == 'Dark' ? 'selected' : '' }}>Dark</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Physical Disability</label>
                                            <select name="disability" class="form-select">
                                                <option value="None" {{ old('disability', $user->disability) == 'None' ? 'selected' : '' }}>None</option>
                                                <option value="Physically Challenged" {{ old('disability', $user->disability) == 'Physically Challenged' ? 'selected' : '' }}>Physically Challenged</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Father's Name / தந்தை பெயர்</label>
                                            <input name="father_name" type="text" class="form-control" value="{{ old('father_name', $user->father_name) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Father's Occupation / தந்தை தொழில்</label>
                                            <input name="father_occupation" type="text" class="form-control" value="{{ old('father_occupation', $user->father_occupation) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mother's Name / தாய் பெயர்</label>
                                            <input name="mother_name" type="text" class="form-control" value="{{ old('mother_name', $user->mother_name) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mother's Occupation / தாய் தொழில்</label>
                                            <input name="mother_occupation" type="text" class="form-control" value="{{ old('mother_occupation', $user->mother_occupation) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>No of Siblings / உடன்பிறப்புகள் <span class="text-danger">*</span></label>
                                            <input name="no_of_siblings" type="text" class="form-control" value="{{ old('no_of_siblings', $user->no_of_siblings) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Siblings Married / திருமணமானவர்கள் <span class="text-danger">*</span></label>
                                            <input name="no_of_siblings_married" type="text" class="form-control" value="{{ old('no_of_siblings_married', $user->no_of_siblings_married) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Family Type / குடும்ப வகை</label>
                                            <select name="family_type" class="form-select">
                                                <option value="Nuclear" {{ old('family_type', $user->family_type) == 'Nuclear' ? 'selected' : '' }}>Nuclear</option>
                                                <option value="Joint" {{ old('family_type', $user->family_type) == 'Joint' ? 'selected' : '' }}>Joint</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Gold Details / பவுன் விவரங்கள்</label>
                                            <input name="gold_details" type="text" class="form-control" value="{{ old('gold_details', $user->gold_details) }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label>Address / முகவரி <span class="text-danger">*</span></label>
                                            <textarea name="address" rows="3" class="form-control" style="height: auto;" required>{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 5: Security & Uploads --}}
                                <div class="tab-pane fade" id="security" role="tabpanel">
                                    <div class="row g-3">
                                        {{-- File Uploads --}}
                                        <div class="col-lg-12">
                                            <h5 class="fw-bold mb-3" style="color: #ab0772;"><i class="fa fa-folder-open me-2"></i>Documents & Images</h5>
                                            <div class="row g-3 mb-4">
                                                <div class="col-md-6">
                                                    <label>Aadhaar Card / ஆதார் அட்டை</label>
                                                    <input name="aadhaar" type="file" class="form-control">
                                                    <div class="form-text">Upload to update your Aadhaar Card document.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Horoscope Image / ஜாதக படம்</label>
                                                    <input name="jathagam" type="file" class="form-control">
                                                    <div class="form-text">Upload a scanned copy of your horoscope.</div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Password Security --}}
                                        <div class="col-lg-12 border-top pt-4">
                                            <h5 class="fw-bold mb-3" style="color: #ab0772;"><i class="fa fa-key me-2"></i>Change Password</h5>
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label>Current Password</label>
                                                    <input name="current_password" type="password" class="form-control" placeholder="Enter current password">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>New Password</label>
                                                    <input name="new_password" type="password" class="form-control" placeholder="Min 6 characters">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Confirm New Password</label>
                                                    <input name="new_password_confirmation" type="password" class="form-control" placeholder="Confirm new password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-save-profile">
                                    <i class="fa fa-save me-2"></i> Save Profile Details
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Dynamic Subcaste loading
    $('#caste').change(function() {
        var caste_id = $(this).val();
        if (caste_id) {
            $.ajax({
                url: '/api/subcastes/' + caste_id,
                type: 'GET',
                success: function(data) {
                    $('#subcaste').empty().append('<option value="">Select Subcaste</option>');
                    $.each(data, function(index, sub) {
                        $('#subcaste').append('<option value="'+sub.id+'">'+sub.subcaste+'</option>');
                    });
                }
            });
        }
    });

    // Dynamic Star loading
    $('#raasi').change(function() {
        var raasi_id = $(this).val();
        if (raasi_id) {
            $.ajax({
                url: '/api/stars/' + raasi_id,
                type: 'GET',
                success: function(data) {
                    $('#star').empty().append('<option value="">Select Star</option>');
                    $.each(data, function(index, star) {
                        $('#star').append('<option value="'+star.id+'">'+star.name+'</option>');
                    });
                }
            });
        }
    });
});
</script>
@endsection
