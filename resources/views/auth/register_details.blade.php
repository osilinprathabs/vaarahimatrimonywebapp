@extends('layouts.frontend')

@section('styles')
    <style>
        #grad1 {
            background-color: #f8f9fa;
        }

        .select2-container--default .select2-selection--single {
            height: 52px !important;
            border: 1px solid #585757;
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 0px
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform fieldset .form-card {
            text-align: left;
            padding: 0px 30px 30px;
        }

        .reg-head {
            font-size: 28px;
            text-transform: uppercase;
            font-weight: 800;
            color: #a90771;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 35px;
        }

        .action-button {
            width: 100px;
            background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%) !important;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000;
            width: 25%;
            height: 100px !important;
        }

        input[type="text"],
        input[type="password"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #212121;
            margin-bottom: 15px;
            border-radius: 3px;
            font-size: 16px;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        h4 {
            color: #a0066e;
            margin-top: 20px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        #resumeModal .modal-header {
            background: #12243d;
            color: #cc9f53;
            border-bottom: 2px solid #cc9f53;
        }

        #resumeModal .btn-primary {
            background: #12243d;
            border-color: #cc9f53;
            color: #cc9f53;
        }

        #resumeModal .btn-secondary {
            background: #6c757d;
            border: none;
        }
    </style>
@endsection

@section('content')
    <section
        style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}');padding-top: 20px;padding-bottom: 20px;">
        <div class="container" id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-11 col-sm-11 col-md-10 col-lg-10 text-center p-0 mt-3 mb-2">
                    <div class="card shadow">
                        <h2><strong>REGISTER NOW</strong></h2>
                        <p>Fill all form fields to complete your profile</p>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                @if(session('generated_password'))
                                    <div class="alert alert-success border-0 shadow-sm mx-4 mt-4 text-start">
                                        <h4 class="alert-heading fw-bold"><i class="bi bi-shield-lock me-2"></i>Registration
                                            Successful!</h4>
                                        <p class="mb-0">Your account has been created. Your generated password is: <strong
                                                class="fs-4 text-primary">{{ session('generated_password') }}</strong></p>
                                        <hr>
                                        <p class="mb-0 small text-muted">Please note this password. You can change it later from
                                            your profile settings.</p>
                                    </div>
                                @endif
                                <form id="msform" method="post" action="{{ route('register.details.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- Step 1: Basic Details -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Basic Details / அடிப்படை விவரங்கள்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Name / வரன் பெயர் <span class="text-danger">*</span></label>
                                                    <input name="name" type="text" value="{{ old('name', $user->name) }}"
                                                        required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Gender / பாலினம் <span class="text-danger">*</span></label>
                                                    <select name="gender" required>
                                                        <option value="">Select</option>
                                                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male / ஆண்</option>
                                                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female / பெண்</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Email / மின்னஞ்சல் <span class="text-danger">*</span></label>
                                                    <input name="emailid" type="email"
                                                        value="{{ old('emailid', $user->emailid) }}" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Phone Number / தொலைப்பேசி எண் <span
                                                            class="text-danger">*</span></label>
                                                    <input name="mobileno" type="text" value="{{ $user->mobileno }}"
                                                        readonly required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Date of Birth / பிறந்த தேதி <span
                                                            class="text-danger">*</span></label>
                                                    <input name="dob" type="date" value="{{ old('dob') }}" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Time of Birth / பிறந்த நேரம் <span
                                                            class="text-danger">*</span></label>
                                                    <input name="birth_time" type="time" value="{{ old('birth_time') }}"
                                                        required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Birth Place / பிறந்த இடம் <span
                                                            class="text-danger">*</span></label>
                                                    <input name="birth_city" type="text" value="{{ old('birth_city') }}"
                                                        placeholder="Enter Birth Place" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Profile Created For / யாருக்காக <span
                                                            class="text-danger">*</span></label>
                                                    <select name="onbehalf" required>
                                                        <option value="">Select</option>
                                                        @foreach($onbehalfs as $onbe)
                                                            <option value="{{ $onbe->id }}" {{ old('onbehalf', $user->onbehalf) == $onbe->id ? 'selected' : '' }}>
                                                                {{ $onbe->onbehalf }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Marital Status / திருமண நிலை <span
                                                            class="text-danger">*</span></label>
                                                    <select name="maritalstatus" required>
                                                        <option value="">Select</option>
                                                        @foreach($marital_statuses as $mar)
                                                            <option value="{{ $mar->marital_status }}" {{ old('maritalstatus') == $mar->marital_status ? 'selected' : '' }}>
                                                                {{ $mar->marital_status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Mother Tongue / தாய்மொழி <span
                                                            class="text-danger">*</span></label>
                                                    <select name="language" required>
                                                        <option value="">Select</option>
                                                        <option value="Tamil / தமிழ்">Tamil / தமிழ்</option>
                                                        <option value="English / ஆங்கிலம்">English / ஆங்கிலம்</option>
                                                        <option value="Telugu / தெலுங்கு">Telugu / தெலுங்கு</option>
                                                        <option value="Kannada / கன்னடம்">Kannada / கன்னடம்</option>
                                                        <option value="Malayalam / மலையாளம்">Malayalam / மலையாளம்</option>
                                                        <option value="Hindi / இந்தி">Hindi / இந்தி</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Whatsapp Number <span class="text-danger">*</span></label>
                                                    <input name="whatsapp_no" type="text"
                                                        value="{{ old('whatsapp_no', $user->mobileno) }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    <!-- Step 2: Education & Professional -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Education & Professional / கல்வி மற்றும் தொழில்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Education / கல்வி தகுதி <span
                                                            class="text-danger">*</span></label>
                                                    <select name="education" required>
                                                        <option value="">Select</option>
                                                        @foreach($educations as $edu)
                                                            <option value="{{ $edu->education }}">{{ $edu->education }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Education Detail / கல்வி விவரம்</label>
                                                    <input name="education_detail" type="text"
                                                        placeholder="Degree, Major etc.">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Employed In / வேலை வகை <span class="text-danger">*</span></label>
                                                    <select name="employment" required>
                                                        <option value="">Select</option>
                                                        @foreach($employments as $emp)
                                                            <option value="{{ $emp->employment }}">{{ $emp->employment }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Occupation / தொழில் <span class="text-danger">*</span></label>
                                                    <select name="occupation" required>
                                                        <option value="">Select</option>
                                                        @foreach($occupations as $occ)
                                                            <option value="{{ $occ->occupation }}">{{ $occ->occupation }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Company Name / நிறுவனத்தின் பெயர்</label>
                                                    <input name="company_name" type="text">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Monthly Income / மாத வருமானம் <span
                                                            class="text-danger">*</span></label>
                                                    <select name="indian_currency_value" required>
                                                        <option value="">Select</option>
                                                        @foreach($currency_values as $cv)
                                                            <option value="{{ $cv->currency_value }}">{{ $cv->currency_value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Work Location / பணிபுரியும் நாடு</label>
                                                    <select name="work_location" id="work_country">
                                                        <option value="">Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->countryid }}">{{ $country->country }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    <!-- Step 3: Personal Details -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Personal Details / தனிப்பட்ட விவரங்கள்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Height / உயரம் <span class="text-danger">*</span></label>
                                                    <select name="height" required>
                                                        <option value="">Select</option>
                                                        @foreach($heights as $h)
                                                            <option value="{{ $h->height }}">{{ $h->height }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Weight / எடை <span class="text-danger">*</span></label>
                                                    <select name="weight" required>
                                                        <option value="">Select</option>
                                                        @for($i = 35; $i <= 150; $i++)
                                                            <option value="{{ $i }}">{{ $i }} Kgs</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Body Type / உடல் அமைப்பு</label>
                                                    <select name="body_type">
                                                        <option value="">Select</option>
                                                        <option value="Average">Average</option>
                                                        <option value="Slim">Slim</option>
                                                        <option value="Athletic">Athletic</option>
                                                        <option value="Heavy">Heavy</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Complexion / நிறம்</label>
                                                    <select name="complexion">
                                                        <option value="">Select</option>
                                                        <option value="Fair">Fair</option>
                                                        <option value="Very Fair">Very Fair</option>
                                                        <option value="Wheatish">Wheatish</option>
                                                        <option value="Dark">Dark</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Physical Disability / ஊனம் ஏதேனும் உண்டா?</label>
                                                    <select name="disability">
                                                        <option value="None">None</option>
                                                        <option value="Physically Challenged">Physically Challenged</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    <!-- Step 4: Family Details -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Family Details / குடும்ப விவரங்கள்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Caste / ஜாதி <span class="text-danger">*</span></label>
                                                    <select name="caste" id="caste" required>
                                                        <option value="">Select</option>
                                                        @foreach($castes as $caste)
                                                            <option value="{{ $caste->id }}">{{ $caste->caste }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Subcaste / உட்பிரிவு <span class="text-danger">*</span></label>
                                                    <select name="subcaste" id="subcaste" required>
                                                        <option value="">Select Caste First</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Gothram / கோத்திரம்</label>
                                                    <input name="gothram" type="text" placeholder="Gothram">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Father's Name / தந்தை பெயர்</label>
                                                    <input name="father_name" type="text">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Father's Occupation / தந்தை தொழில்</label>
                                                    <input name="father_occupation" type="text">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Mother's Name / தாய் பெயர்</label>
                                                    <input name="mother_name" type="text">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Mother's Occupation / தாய் தொழில்</label>
                                                    <input name="mother_occupation" type="text">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>No of Siblings / உடன்பிறப்புகள் <span
                                                            class="text-danger">*</span></label>
                                                    <input name="no_of_siblings" type="text"
                                                        placeholder="e.g. 1 Brother, 2 Sisters" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Siblings Married / திருமணமானவர்கள் <span
                                                            class="text-danger">*</span></label>
                                                    <input name="no_of_siblings_married" type="text"
                                                        placeholder="e.g. 1 Sister Married" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Family Type / குடும்ப வகை</label>
                                                    <select name="family_type">
                                                        <option value="Nuclear">Nuclear</option>
                                                        <option value="Joint">Joint</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    <!-- Step 5: Horoscope & Location -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Horoscope Details / ஜாதக விவரங்கள்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Raasi / ராசி <span class="text-danger">*</span></label>
                                                    <select name="raasi" id="raasi" required>
                                                        <option value="">Select</option>
                                                        @foreach($raasis as $r)
                                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Star / நட்சத்திரம் <span class="text-danger">*</span></label>
                                                    <select name="star" id="star" required>
                                                        <option value="">Select Raasi First</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12 mt-3">
                                                    <h4>Raasi Chart / ராசி கட்டம்</h4>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered text-center">
                                                            <tr>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td>
                                                                    <<select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                        </select>
                                                                </td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td colspan="2" rowspan="2" class="align-middle">
                                                                    <h4>ராசி</h4>
                                                                </td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>

                                                            </tr>
                                                            <tr>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                            </tr>
                                                            <tr>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select> </td>
                                                                <td><select name="raasi_1[]" class="form-control" multiple>
                                                                        <option value="Lagnam">Lagnam (லக்கனம்)</option>
                                                                        <option value="Sun">Sun (சூரியன்)</option>
                                                                        <option value="Moon">Moon (சந்திரன்)</option>
                                                                        <option value="Mars">Mars (செவ்வாய்)</option>
                                                                        <option value="Mercury">Mercury (புதன்)</option>
                                                                        <option value="Jupiter">Jupiter (குரு)</option>
                                                                        <option value="Venus">Venus (சுக்கிரன்)</option>
                                                                        <option value="Saturn">Saturn (சனி)</option>
                                                                        <option value="Rahu">Rahu (ராகு)</option>
                                                                        <option value="Kethu">Kethu (கேது)</option>
                                                                    </select></td>

                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Address / முகவரி <span class="text-danger">*</span></label>
                                                    <textarea name="address" rows="3" required></textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Gold Details / பவுன் விவரங்கள்</label>
                                                    <input name="gold_details" type="text" placeholder="e.g. 50 Sovereigns">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>

                                    <!-- Step 6: Uploads -->
                                    <fieldset>
                                        <div class="form-card">
                                            <h3 class="reg-head">Uploads / பதிவேற்றம்</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>Profile Photo / வரன் புகைப்படம்</label>
                                                    <input name="profile_img" type="file">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Aadhaar Card / ஆதார் அட்டை <span
                                                            class="text-danger">*</span></label>
                                                    <input name="aadhaar" type="file" required>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Horoscope Image / ஜாதக படம்</label>
                                                    <input name="jathagam" type="file">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous"
                                            value="Previous" />
                                        <button type="submit" class="action-button">Submit</button>
                                    </fieldset>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resume Registration Modal -->
    <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resumeModalLabel">Resume Registration? / பதிவைத் தொடரவா?</h5>
                </div>
                <div class="modal-body text-center">
                    <p>It looks like you have some unsaved registration data from your last visit. Would you like to
                        continue where you left off?</p>
                    <p>நீங்கள் கடைசியாகப் பதிவு செய்த விவரங்கள் உள்ளன. அதைத் தொடர விரும்புகிறீர்களா?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="btnStartNew">Start New / புதிதாகத் தொடங்கு</button>
                    <button type="button" class="btn btn-primary" id="btnResume">Resume / தொடரவும்</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var current_fs, next_fs, previous_fs;

            $(".next").click(function () {
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                // Basic validation for required fields in current fieldset
                var valid = true;
                current_fs.find('input[required], select[required], textarea[required]').each(function () {
                    if ($(this).val() == "") {
                        $(this).css('border-color', 'red');
                        valid = false;
                    } else {
                        $(this).css('border-color', '#212121');
                    }
                });

                if (valid) {
                    next_fs.show();
                    current_fs.hide();
                    window.scrollTo(0, 0);
                }
            });

            $(".previous").click(function () {
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
                previous_fs.show();
                current_fs.hide();
                window.scrollTo(0, 0);
            });

            // AJAX for Subcaste
            $('#caste').change(function () {
                var caste_id = $(this).val();
                if (caste_id) {
                    $.ajax({
                        url: '/api/subcastes/' + caste_id,
                        type: 'GET',
                        success: function (data) {
                            $('#subcaste').empty().append('<option value="">Select Subcaste</option>');
                            $.each(data, function (index, sub) {
                                $('#subcaste').append('<option value="' + sub.id + '">' + sub.subcaste + '</option>');
                            });

                            // Restore value if loading from cache
                            let storedData = localStorage.getItem('v_matrimony_reg_cache');
                            if (storedData) {
                                let formData = JSON.parse(storedData);
                                if (formData.subcaste) {
                                    $('#subcaste').val(formData.subcaste);
                                }
                            }
                        }
                    });
                }
            });

            // AJAX for Stars
            $('#raasi').change(function () {
                var raasi_id = $(this).val();
                if (raasi_id) {
                    $.ajax({
                        url: '/api/stars/' + raasi_id,
                        type: 'GET',
                        success: function (data) {
                            $('#star').empty().append('<option value="">Select Star</option>');
                            $.each(data, function (index, star) {
                                $('#star').append('<option value="' + star.id + '">' + star.name + '</option>');
                            });

                            // Restore value if loading from cache
                            let storedData = localStorage.getItem('v_matrimony_reg_cache');
                            if (storedData) {
                                let formData = JSON.parse(storedData);
                                if (formData.star) {
                                    $('#star').val(formData.star);
                                }
                            }
                        }
                    });
                }
            });

            // Handle AJAX for States if needed
            $('#work_country').change(function () {
                var country_id = $(this).val();
                // Implement state matching logic if needed
            });

            // --- Form Persistence Logic ---
            const STORAGE_KEY = 'v_matrimony_reg_cache';
            const STEP_KEY = 'v_matrimony_reg_step';

            function saveFormData() {
                let formData = {};
                $('#msform').find('input:not([type="file"]), select, textarea').each(function () {
                    let name = $(this).attr('name');
                    if (name && name !== '_token') {
                        formData[name] = $(this).val();
                    }
                });
                localStorage.setItem(STORAGE_KEY, JSON.stringify(formData));

                // Save current step
                let currentStep = $('fieldset:visible').index('fieldset');
                localStorage.setItem(STEP_KEY, currentStep);
            }

            function clearFormData() {
                localStorage.removeItem(STORAGE_KEY);
                localStorage.removeItem(STEP_KEY);
            }

            function loadFormData() {
                let storedData = localStorage.getItem(STORAGE_KEY);
                if (storedData) {
                    let formData = JSON.parse(storedData);
                    $.each(formData, function (name, value) {
                        let $el = $('[name="' + name + '"]');
                        if ($el.length) {
                            $el.val(value);
                            // Trigger change for AJAX dependent fields
                            if (name === 'caste' || name === 'raasi') {
                                $el.trigger('change');
                            }
                        }
                    });

                    // Restore step
                    let savedStep = localStorage.getItem(STEP_KEY);
                    if (savedStep && savedStep > 0) {
                        $('fieldset').hide();
                        $('fieldset').eq(savedStep).show();
                    }
                }
            }

            // Monitor all inputs
            $('#msform').on('input change', 'input:not([type="file"]), select, textarea', function () {
                saveFormData();
            });

            // Handle Modal actions
            $('#btnResume').click(function () {
                loadFormData();
                $('#resumeModal').modal('hide');
            });

            $('#btnStartNew').click(function () {
                clearFormData();
                $('#resumeModal').modal('hide');
            });

            // Clear on submit
            $('#msform').submit(function () {
                clearFormData();
            });

            // Check on Load
            setTimeout(function () {
                if (localStorage.getItem(STORAGE_KEY)) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Resume Registration? / பதிவைத் தொடரவா?',
                            html: `<p class="mb-2 text-dark">It looks like you have some unsaved registration data from your last visit. Would you like to continue where you left off?</p>
                                       <p class="mb-0 text-muted small fw-bold">நீங்கள் கடைசியாகப் பதிவு செய்த விவரங்கள் உள்ளன. அதைத் தொடர விரும்புகிறீர்களா?</p>`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#ab0772',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Resume / தொடரவும்',
                            cancelButtonText: 'Start New / புதிதாகத் தொடங்கு',
                            background: '#ffffff',
                            customClass: {
                                popup: 'rounded-4 shadow-lg border-0'
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadFormData();
                            } else {
                                clearFormData();
                            }
                        });
                    } else {
                        // Safe fallback using Bootstrap modal if SweetAlert2 is not loaded
                        try {
                            if (typeof bootstrap !== 'undefined') {
                                let modalObj = bootstrap.Modal.getOrCreateInstance(document.getElementById('resumeModal'));
                                modalObj.show();
                            } else {
                                $('#resumeModal').modal('show');
                            }
                        } catch (e) {
                            if (confirm("Would you like to resume your previous registration? / உங்கள் கடந்த காலப் பதிவைத் தொடர விரும்புகிறீர்களா?")) {
                                loadFormData();
                            } else {
                                clearFormData();
                            }
                        }
                    }
                }
            }, 500);
        });
    </script>
@endsection