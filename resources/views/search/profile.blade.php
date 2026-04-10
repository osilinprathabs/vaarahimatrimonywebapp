@extends('layouts.frontend')

@section('styles')
<style>
    .profile-box { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 20px; text-align: center; }
    .profile-box img { border-radius: 5px; margin-bottom: 15px; max-height: 300px; width: 100%; object-fit: cover; }
    .detail-card { background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); margin-bottom: 25px; }
    .detail-card h6 { color: #ac0772; font-weight: 800; text-transform: uppercase; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
    .table-details td { padding: 12px; border: 1px solid #f0f0f0; }
    .label-strong { font-weight: 700; background-color: #fcfcfc; width: 30%; }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-box">
                    @if($targetUser->latestProfileImage)
                        <img src="{{ asset('storage/' . $targetUser->latestProfileImage->image_name) }}" alt="{{ $targetUser->name }}">
                    @else
                        <img src="{{ asset('assets/images/' . ($targetUser->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="image">
                    @endif
                    <h4><b>{{ $targetUser->name }}</b></h4>
                    <p class="text-muted">{{ $targetUser->userid }}</p>
                    <button class="btn btn-success w-100 mt-3">Request Contact <i class="fa fa-phone"></i></button>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Basic Information -->
                <div class="detail-card">
                    <h6>BASIC INFORMATION / அடிப்படை விவரங்கள்</h6>
                    <table class="table table-details">
                        <tbody>
                            <tr>
                                <td class="label-strong">MID</td><td>{{ $targetUser->userid }}</td>
                                <td class="label-strong">Gender</td><td>{{ $targetUser->gender }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Age</td><td>{{ $targetUser->age }}</td>
                                <td class="label-strong">Marital Status</td><td>{{ $targetUser->maritalstatus }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Height</td><td>{{ $targetUser->height }}</td>
                                <td class="label-strong">Weight</td><td>{{ $targetUser->weight }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Date of Birth</td><td>{{ date('d-m-Y', strtotime($targetUser->date_of_birth)) }}</td>
                                <td class="label-strong">Birth Place</td><td>{{ $targetUser->birth_city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Religion Information -->
                <div class="detail-card">
                    <h6>RELIGION INFORMATION / மத விவரங்கள்</h6>
                    <table class="table table-details">
                        <tbody>
                            <tr>
                                <td class="label-strong">Caste</td><td>{{ $caste->caste ?? 'N/A' }}</td>
                                <td class="label-strong">Sub-Caste</td><td>{{ $targetUser->subcaste }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Raasi</td><td>{{ $raasi->name ?? 'N/A' }}</td>
                                <td class="label-strong">Star</td><td>{{ $targetUser->star }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Dosham</td><td>{{ $dosham->dosham ?? 'None' }}</td>
                                <td class="label-strong">Lagnam</td><td>{{ $targetUser->laknam }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Family Information -->
                <div class="detail-card">
                    <h6>FAMILY INFORMATION / குடும்ப விவரங்கள்</h6>
                    <table class="table table-details">
                        <tbody>
                            <tr>
                                <td class="label-strong">Father Name</td><td>{{ $targetUser->father_name }}</td>
                                <td class="label-strong">Mother Name</td><td>{{ $targetUser->mother_name }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Father Job</td><td>{{ $targetUser->father_occupation }}</td>
                                <td class="label-strong">Mother Job</td><td>{{ $targetUser->mother_occupation }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Professional Information -->
                <div class="detail-card">
                    <h6>PROFESSIONAL INFORMATION / கல்வி & தொழில்</h6>
                    <table class="table table-details">
                        <tbody>
                            <tr>
                                <td class="label-strong">Education</td><td>{{ $targetUser->education }}</td>
                                <td class="label-strong">Occupation</td><td>{{ $targetUser->occupation }}</td>
                            </tr>
                            <tr>
                                <td class="label-strong">Monthly Income</td><td>{{ $targetUser->currency_value }}</td>
                                <td class="label-strong">Work Location</td><td>{{ $targetUser->work_city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
