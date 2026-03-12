@extends('layouts.frontend')

@section('styles')
<style>
    #grad1 { background-color: #f8f9fa; }
    .select2-container--default .select2-selection--single { height: 52px !important; border: 1px solid #585757; }
    #msform { text-align: center; position: relative; margin-top: 0px }
    #msform fieldset { background: white; border: 0 none; border-radius: 0.5rem; box-sizing: border-box; width: 100%; margin: 0; padding-bottom: 20px; position: relative }
    #msform fieldset:not(:first-of-type) { display: none }
    #msform fieldset .form-card { text-align: left; padding: 0px 30px 30px; }
    .reg-head { font-size: 28px; text-transform: uppercase; font-weight: 800; color: #a90771; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; margin-bottom: 35px; }
    .action-button { width: 100px; background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%) !important; font-weight: bold; color: white; border: 0 none; border-radius: 0px; cursor: pointer; padding: 10px 5px; margin: 10px 5px }
    .action-button-previous { width: 100px; background: #616161; font-weight: bold; color: white; border: 0 none; border-radius: 0px; cursor: pointer; padding: 10px 5px; margin: 10px 5px }
    .table-bordered td, .table-bordered th { border: 1px solid #000; width: 25%; height: 100px !important; }
    input[type="text"], input[type="password"], input[type="date"], input[type="time"], input[type="number"], input[type="email"], select, textarea {
        width: 100%; padding: 12px 15px; border: 1px solid #212121; margin-bottom: 10px; border-radius: 3px;
    }
</style>
@endsection

@section('content')
<section style="background-image: url('{{ asset('assets/images/logo/premium-services-bg.jpg') }}');padding-top: 20px;padding-bottom: 20px;">
    <div class="container" id="grad1">
        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-10 text-center p-0 mt-3 mb-2">
                <div class="card">
                    <h2><strong>REGISTER NOW</strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform" method="post" action="{{ route('register.details.store') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Fieldset 1: Basic Details -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-md-12"><h3 class="reg-head">Basic Details / அடிப்படை விவரங்கள்</h3></div>
                                            <div class="col-lg-6">
                                                <label>Name / வரன் பெயர் <span style="color:red;">*</span></label>
                                                <input name="name" type="text" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Gender / பாலினம் <span style="color:red;">*</span></label>
                                                <select name="gender" required>
                                                    <option value="">Gender</option>
                                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male / ஆண்</option>
                                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female / பெண்</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Email / மின்னஞ்சல் <span style="color:red;">*</span></label>
                                                <input name="emailid" type="email" value="{{ $user->emailid }}" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Phone Number / தொலைப்பேசி எண் <span style="color:red;">*</span></label>
                                                <input name="mobileno" type="text" value="{{ $user->mobileno }}" readonly required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Date of Birth / பிறந்த தேதி <span style="color:red;">*</span> </label>
                                                <input name="dob" type="date" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Time of Birth / பிறந்த நேரம் <span style="color:red;">*</span> </label>
                                                <input name="birth_time" type="time" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Birth Place / பிறந்த இடம் <span style="color:red;">*</span></label>
                                                <input name="birth_city" type="text" placeholder="Enter Birth Place" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Profile Created For / உருவாக்கிய சுயவிவரம் <span style="color:red;">*</span></label>
                                                <select name="onbehalf" required>
                                                    <option value="">Select</option>
                                                    @foreach($onbehalfs as $onbe)
                                                        <option value="{{ $onbe->id }}" {{ $user->onbehalf == $onbe->id ? 'selected' : '' }}>{{ $onbe->onbehalf }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Maritial Status / திருமண நிலை <span style="color:red;">*</span></label>
                                                <select name="maritalstatus" required>
                                                    <option value="">Select</option>
                                                    @foreach($marital_statuses as $mar)
                                                        <option value="{{ $mar->marital_status }}">{{ $mar->marital_status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Mother Tongue / பேசும் மொழி <span style="color:red;">*</span></label>
                                                <select name="language" required>
                                                    <option value="">Select </option>
                                                    <option value="Kannadam / கன்னடம்">Kannadam / கன்னடம் </option>
                                                    <option value="Telugu / தெலுங்கு">Telugu / தெலுங்கு</option>
                                                    <option value="Tamil / தமிழ்">Tamil / தமிழ்</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                <!-- Fieldset 2: Education & Professional -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-md-12"><h3 class="reg-head">Education & Professional / கல்வி மற்றும் தொழில்</h3></div>
                                            <div class="col-lg-6">
                                                <label> Education / கல்வி தகுதி <span style="color:red;">*</span></label>
                                                <select name="education" required>
                                                    <option value="">Select</option>
                                                    @foreach($educations as $edu)
                                                        <option value="{{ $edu->education }}">{{ $edu->education }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Employed In / வேலை <span style="color:red;">*</span></label>
                                                <select name="employment" required>
                                                    <option value="">Select</option>
                                                    @foreach($employments as $emp)
                                                        <option value="{{ $emp->employment }}">{{ $emp->employment }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Occupation / தொழில் <span style="color:red;">*</span> </label>
                                                <select name="occupation" required>
                                                    <option value="">Select</option>
                                                    @foreach($occupations as $occ)
                                                        <option value="{{ $occ->occupation }}">{{ $occ->occupation }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Monthly Income / மாத வருமானம் <span style="color:red;">*</span></label>
                                                <select name="indian_currency_value" required>
                                                    <option value="">Select</option>
                                                    @foreach($currency_values as $cv)
                                                        <option value="{{ $cv->currency_value }}">{{ $cv->currency_value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                <!-- Fieldset 3: Personal Details & Photo -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-md-12"><h3 class="reg-head">Personal Details / தனிப்பட்ட விவரங்கள்</h3></div>
                                            <div class="col-lg-6">
                                                <label> Height / உயரம் <span style="color:red;">*</span> </label>
                                                <select name="height" required>
                                                    <option value="">Feet/Inches</option>
                                                    @foreach($heights as $h)
                                                        <option value="{{ $h->height }}">{{ $h->height }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Weight / எடை <span style="color:red;">*</span></label>
                                                <select name="weight" required>
                                                    <option value="">Select</option>
                                                    @for($i=35; $i<=150; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Kgs</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Upload Your Photo </label>
                                                <input name="profile_img" type="file">
                                            </div>
                                            <div class="col-lg-6">
                                                <label> Upload Your Aadhaar Card <span style="color:red;">*</span></label>
                                                <input name="aadhaar" type="file" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                            <div class="col-lg-6">
                                                <label> Subcaste / வங்குசம்,குலம் <span style="color:red;">*</span></label>
                                                <select name="subcaste" id="subcaste" required>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Father Occupation / தந்தை தொழில்</label>
                                                <input name="father_occupation" type="text">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Mother Occupation / தாய் தொழில்</label>
                                                <input name="mother_occupation" type="text">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>No of Siblings / உடன்பிறப்புகளின் எண்ணிக்கை <span style="color:red;">*</span></label>
                                                <input name="no_of_siblings" type="text" placeholder="அண்ணன்-1, தங்கை-1" required>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Siblings Marriage Status / உடன்பிறப்புகளின் திருமண நிலை <span style="color:red;">*</span></label>
                                                <input name="no_of_siblings_married" type="text" placeholder="அண்ணன் திருமணம் ஆனவர்" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                <!-- Fieldset 5: Additional Details -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-md-12"><h3 class="reg-head">Additional Details / கூடுதல் விவரங்கள்</h3></div>
                                            <div class="col-lg-6">
                                                <label>Property Details / சொத்து விவரங்கள்</label>
                                                <select name="assets[]" multiple>
                                                    <option value="OWN HOUSE/ சொந்தவீடு">OWN HOUSE/ சொந்தவீடு</option>
                                                    <option value="RENTAL HOUSE/ வாடகைவீடு">RENTAL HOUSE/ வாடகைவீடு</option>
                                                    <option value="EMPTY LAND/ காலி மனை">EMPTY LAND/ காலி மனை</option>
                                                    <option value="AGRI LAND/ விவசாய நிலம்">AGRI LAND/ விவசாய நிலம்</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Gold Details / பவுன் விவரங்கள்</label>
                                                <input name="gold_details" type="text">
                                            </div>
                                            <div class="col-lg-12">
                                                <label>Address / முகவரி <span style="color:red;">*</span></label>
                                                <textarea name="address" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>

                                <!-- Fieldset 6: Horoscope Grid -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-md-12"><h3 class="reg-head">Horoscope Grid / ஜாதக கட்டம்</h3></div>
                                            
                                            <div class="col-lg-6">
                                                <label>Raasi / ராசி <span style="color:red;">*</span></label>
                                                <select name="raasi" id="raasi" required>
                                                    <option value="">Select</option>
                                                    @foreach($raasis as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Star / நட்சத்திரம் <span style="color:red;">*</span> </label>
                                                <select name="star" id="star" required>
                                                    <option value="">Select</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <h4>Raasi Chart / ராசி கட்டம்</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center">
                                                        <tr>
                                                            <td><select name="raasi_12[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_1[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_2[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_3[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="raasi_11[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td colspan="2" rowspan="2" class="align-middle"><h4>ராசி</h4></td>
                                                            <td><select name="raasi_4[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="raasi_10[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_5[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="raasi_9[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_8[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_7[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="raasi_6[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <h4>Amsam Chart / அம்சம் கட்டம்</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered text-center">
                                                        <tr>
                                                            <td><select name="amsam_12[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_1[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_2[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_3[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="amsam_11[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td colspan="2" rowspan="2" class="align-middle"><h4>அம்சம்</h4></td>
                                                            <td><select name="amsam_4[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="amsam_10[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_5[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="amsam_9[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_8[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_7[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                            <td><select name="amsam_6[]" class="form-control" multiple><option value="Lagnam">Lagnam</option><option value="Sun">Sun</option><option value="Moon">Moon</option><option value="Mars">Mars</option><option value="Mercury">Mercury</option><option value="Jupiter">Jupiter</option><option value="Venus">Venus</option><option value="Saturn">Saturn</option><option value="Rahu">Rahu</option><option value="Kethu">Kethu</option></select></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <label> Upload Horoscope / ஜாதகம் பதிவேற்றவும் </label>
                                                <input name="jathagam" type="file" required>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    <input type="submit" class="action-button" value="Submit" />
                                </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    var current_fs, next_fs, previous_fs;
    
    $(".next").click(function(){
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        next_fs.show();
        current_fs.hide();
    });

    $(".previous").click(function(){
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        previous_fs.show();
        current_fs.hide();
    });

    // AJAX for Subcaste
    $('#caste').change(function(){
        var caste_id = $(this).val();
        if(caste_id){
            $.ajax({
                url: '/api/subcastes/' + caste_id,
                type: 'GET',
                success: function(data){
                    $('#subcaste').empty().append('<option value="">Select</option>');
                    $.each(data, function(index, sub){
                        $('#subcaste').append('<option value="'+sub.subcaste+'">'+sub.subcaste+'</option>');
                    });
                }
            });
        }
    });

    // AJAX for Stars
    $('#raasi').change(function(){
        var raasi_id = $(this).val();
        if(raasi_id){
            $.ajax({
                url: '/api/stars/' + raasi_id,
                type: 'GET',
                success: function(data){
                    $('#star').empty().append('<option value="">Select</option>');
                    $.each(data, function(index, star){
                        $('#star').append('<option value="'+star.star+'">'+star.star+'</option>');
                    });
                }
            });
        }
    });
});
</script>
@endsection
