@extends('layouts.admin')

@section('content')
<style>
    /* Premium Profile Design System */
    .profile-card {
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .profile-cover {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        background-image: radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.2) 0%, transparent 45%), 
                          radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.25) 0%, transparent 45%);
        height: 155px;
        position: relative;
        overflow: hidden;
    }
    .profile-cover::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-image: radial-gradient(circle at 50% 50%, rgba(244, 63, 94, 0.15) 0%, transparent 60%);
        opacity: 0.8;
    }
    .profile-cover::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .profile-avatar-wrapper {
        margin-top: -65px;
        position: relative;
        z-index: 2;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #ffffff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        object-fit: cover;
        background: #fff;
    }
    .detail-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .detail-val {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
    }
    .detail-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px 16px;
        border: 1px solid rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
    }
    .detail-card:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }
    .detail-icon {
        width: 32px;
        height: 32px;
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 16px;
    }
    .section-title-premium {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        position: relative;
        padding-left: 12px;
        display: flex;
        align-items: center;
    }
    .section-title-premium::before {
        content: '';
        position: absolute;
        left: 0;
        width: 4px;
        height: 18px;
        background: #3b82f6;
        border-radius: 4px;
    }
    
    /* Elegant Vedic Horoscope Styling */
    .horoscope-table {
        border-collapse: separate;
        border-spacing: 6px;
        width: 100%;
    }
    .horoscope-table td {
        background: #ffffff;
        border: 1.5px solid rgba(226, 135, 67, 0.2);
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
        color: #1e293b;
        transition: all 0.25s ease;
        padding: 10px;
        min-height: 70px;
        vertical-align: middle;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.01);
    }
    .horoscope-table td:hover:not(.horoscope-center) {
        border-color: #e28743;
        background: rgba(226, 135, 67, 0.04);
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(226, 135, 67, 0.12);
    }
    .horoscope-center {
        background: linear-gradient(135deg, rgba(226, 135, 67, 0.06) 0%, rgba(243, 156, 18, 0.06) 100%) !important;
        border: 1.5px dashed #e28743 !important;
        color: #e28743 !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        letter-spacing: 1px;
    }
    
    .nav-pills-premium .nav-link {
        color: #64748b;
        font-weight: 700;
        border-radius: 30px;
        padding: 10px 24px;
        transition: all 0.25s ease;
        border: 1px solid transparent;
    }
    .nav-pills-premium .nav-link.active {
        background: #3b82f6 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }
    .nav-pills-premium .nav-link:hover:not(.active) {
        background: #f1f5f9;
        color: #3b82f6;
    }
    .gallery-img-wrapper {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    .gallery-img-wrapper:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }
    .gallery-img-wrapper img {
        transition: transform 0.5s ease;
    }
    .gallery-img-wrapper:hover img {
        transform: scale(1.06);
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0">Member Profile Detail</h4>
            <a href="{{ route('admin.members.all') }}" class="btn btn-sm btn-light px-3 rounded-pill">
                <i class="ti ti-arrow-left me-1"></i> Back to Members
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Left Column: Member Card & Quick Status -->
    <div class="col-xl-4 col-lg-5">
        <div class="profile-card card border-0 mb-4">
            <div class="profile-cover"></div>
            <div class="card-body text-center pt-0">
                <div class="profile-avatar-wrapper">
                    @php
                        $profileImg = $images->where('type', 'Profile')->first();
                        $imgPath = $profileImg ? storage_url($profileImg->image_name) : asset('assets/images/profile/default.jpg');
                    @endphp
                    <img src="{{ $imgPath }}" class="profile-avatar" alt="{{ $member->name }}">
                </div>
                
                <h4 class="fw-extrabold text-dark mt-3 mb-1">{{ $member->name }}</h4>
                <div class="mb-3">
                    <span class="badge bg-light text-muted border px-2.5 py-1 fw-bold">{{ $member->userid }}</span>
                </div>

                <div class="d-flex justify-content-center gap-2 mb-4">
                    @if($member->status == 1)
                        <span class="badge bg-success-subtle text-success px-3 py-1.5 fw-semibold rounded-pill"><i class="ti ti-circle-check-filled me-1"></i>Active Account</span>
                    @elseif($member->status == 2)
                        <span class="badge bg-danger-subtle text-danger px-3 py-1.5 fw-semibold rounded-pill"><i class="ti ti-ban me-1"></i>Suspended</span>
                    @else
                        <span class="badge bg-warning-subtle text-warning px-3 py-1.5 fw-semibold rounded-pill"><i class="ti ti-clock me-1"></i>Pending Review</span>
                    @endif
                </div>

                <hr class="my-4 border-light">

                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2.5 border-light">
                        <span class="text-muted"><i class="ti ti-gender-intersex me-2 text-primary"></i>Gender</span>
                        <span class="fw-bold text-dark">{{ $member->gender }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2.5 border-light">
                        <span class="text-muted"><i class="ti ti-phone me-2 text-primary"></i>Mobile No</span>
                        <span class="fw-bold text-dark">{{ $member->mobileno }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2.5 border-light">
                        <span class="text-muted"><i class="ti ti-mail me-2 text-primary"></i>Email</span>
                        <span class="fw-bold text-dark fs-13">{{ $member->emailid }}</span>
                    </li>
                    @php
                        $planAssign = $member->planAssign;
                        $isPlanExpired = ($planAssign && $planAssign->plan_status === 'Expired') || $member->isExpired();
                        
                        $expiryDateStr = 'N/A';
                        if ($planAssign && $planAssign->plan_end_date) {
                            $expiryDateStr = \Carbon\Carbon::parse($planAssign->plan_end_date)->format('d M Y');
                        } else {
                            $settings = \Illuminate\Support\Facades\DB::table('profile_ex_status')->first();
                            if ($settings && $settings->expire_status && $settings->count && $member->date) {
                                $regDate = \Carbon\Carbon::parse($member->date);
                                switch ($settings->expire_status) {
                                    case 'date': $regDate->addDays($settings->count); break;
                                    case 'month': $regDate->addMonths($settings->count); break;
                                    case 'year': $regDate->addYears($settings->count); break;
                                }
                                $expiryDateStr = $regDate->format('d M Y');
                            }
                        }
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2.5 border-light">
                        <span class="text-muted"><i class="ti ti-certificate me-2 text-primary"></i>Plan Status</span>
                        @if($isPlanExpired)
                            <span class="badge bg-danger-subtle text-danger px-2 py-1 fw-bold">Plan Expired</span>
                        @else
                            <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">{{ $member->plan ?? 'Free' }}</span>
                        @endif
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2.5 border-0">
                        <span class="text-muted"><i class="ti ti-calendar-time me-2 text-primary"></i>Expiration Date</span>
                        <span class="fw-bold {{ $isPlanExpired ? 'text-danger' : 'text-dark' }}">{{ $expiryDateStr }}</span>
                    </li>
                </ul>

                <div class="mt-4 d-grid gap-2">
                    @if($member->status == 0)
                        <form method="post" action="{{ route('admin.members.approve', $member->id) }}" class="d-inline w-100 mb-2">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow-sm rounded-pill"><i class="ti ti-circle-check me-1"></i> Approve Member Account</button>
                        </form>
                    @endif
                    @if($member->status != 2)
                        <form method="post" action="{{ route('admin.members.suspend', $member->id) }}" class="d-inline w-100 mb-2">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-pill"><i class="ti ti-ban me-1"></i> Suspend Account</button>
                        </form>
                    @endif
                    <form method="post" action="{{ route('admin.members.delete', $member->id) }}" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 py-2 rounded-pill confirm-btn"
                            data-title="Delete Member?" data-text="Are you sure you want to permanently delete this member?" data-confirm-btn="Yes, Delete" data-btn-class="btn-danger">
                            <i class="ti ti-trash me-1"></i> Delete Member Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Navigation Tabs & Profile details -->
    <div class="col-xl-8 col-lg-7">
        <div class="profile-card card border-0">
            <div class="card-header bg-white border-0 py-3.5 d-flex justify-content-between align-items-center">
                <ul class="nav nav-pills nav-pills-premium bg-light p-1 rounded-pill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#overview" role="tab">
                            <i class="ti ti-user-circle me-1"></i> Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#photos" role="tab">
                            <i class="ti ti-photo me-1"></i> Photo Gallery
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="card-body">
                <div class="tab-content">
                    
                    <!-- Overview Tab -->
                    <div id="overview" class="tab-pane fade show active" role="tabpanel">
                        
                        <!-- Personal Details -->
                        <div class="mb-4">
                            <h5 class="section-title-premium mb-4">Personal Profile</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-user"></i></div>
                                        <div>
                                            <div class="detail-label">Full Name</div>
                                            <div class="detail-val">{{ $member->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-gender-intersex"></i></div>
                                        <div>
                                            <div class="detail-label">Gender</div>
                                            <div class="detail-val">{{ $member->gender }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-calendar-event"></i></div>
                                        <div>
                                            <div class="detail-label">Date of Birth</div>
                                            <div class="detail-val">{{ $member->date_of_birth ?? $member->dob ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-hourglass-low"></i></div>
                                        <div>
                                            <div class="detail-label">Age</div>
                                            <div class="detail-val">{{ $member->age ?? 'N/A' }} Years</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-rings-military"></i></div>
                                        <div>
                                            <div class="detail-label">Marital Status</div>
                                            <div class="detail-val">{{ $member->maritalstatus ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-language"></i></div>
                                        <div>
                                            <div class="detail-label">Mother Tongue</div>
                                            <div class="detail-val">{{ $member->language ?? $member->mother_tongue ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Religious Info -->
                        <div class="mb-4 mt-5">
                            <h5 class="section-title-premium mb-4">Religion &amp; Horoscope Info</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-bell-school"></i></div>
                                        <div>
                                            <div class="detail-label">Religion</div>
                                            <div class="detail-val">{{ $member->religion ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-hierarchy"></i></div>
                                        <div>
                                            <div class="detail-label">Caste / Subcaste</div>
                                            <div class="detail-val">{{ $member->caste ?? 'N/A' }} / {{ $member->subcaste ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-moon-stars"></i></div>
                                        <div>
                                            <div class="detail-label">Star &amp; Raasi</div>
                                            <div class="detail-val">{{ $member->star ?? 'N/A' }} / {{ $member->raasi ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-dna"></i></div>
                                        <div>
                                            <div class="detail-label">Gothram</div>
                                            <div class="detail-val">{{ $member->gothram ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-alert-triangle"></i></div>
                                        <div>
                                            <div class="detail-label">Dosham</div>
                                            <div class="detail-val">{{ $member->dhosam ?? 'No' }} ({{ $member->dhosam_type ?? 'None' }})</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Info -->
                        <div class="mb-4 mt-5">
                            <h5 class="section-title-premium mb-4">Education &amp; Career</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-school"></i></div>
                                        <div>
                                            <div class="detail-label">Education</div>
                                            <div class="detail-val">{{ $member->education ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-briefcase"></i></div>
                                        <div>
                                            <div class="detail-label">Occupation</div>
                                            <div class="detail-val">{{ $member->occupation ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-currency-rupee"></i></div>
                                        <div>
                                            <div class="detail-label">Annual Income</div>
                                            <div class="detail-val">{{ $member->indian_currency_value ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-building-skyscrapers"></i></div>
                                        <div>
                                            <div class="detail-label">Employment Type</div>
                                            <div class="detail-val">{{ $member->employment ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Family Info -->
                        <div class="mb-4 mt-5">
                            <h5 class="section-title-premium mb-4">Family Background</h5>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-user-check"></i></div>
                                        <div>
                                            <div class="detail-label">Father's Name / Job</div>
                                            <div class="detail-val fs-13">{{ $member->father_name ?? 'N/A' }} ({{ $member->father_occupation ?? 'N/A' }})</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-user-smile"></i></div>
                                        <div>
                                            <div class="detail-label">Mother's Name / Job</div>
                                            <div class="detail-val fs-13">{{ $member->mother_name ?? 'N/A' }} ({{ $member->mother_occupation ?? 'N/A' }})</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-users"></i></div>
                                        <div>
                                            <div class="detail-label">Siblings</div>
                                            <div class="detail-val">{{ $member->no_of_siblings ?? 0 }} ({{ $member->no_of_siblings_married ?? 0 }} Married)</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="detail-card d-flex align-items-center gap-3">
                                        <div class="detail-icon"><i class="ti ti-map-pin-filled"></i></div>
                                        <div>
                                            <div class="detail-label">Family Origin</div>
                                            <div class="detail-val">{{ $member->family_origin ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Horoscope Charts Section -->
                        <div class="mb-4 mt-5">
                            <h5 class="section-title-premium mb-4">Vedic Horoscope Grids</h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card border border-light shadow-none p-3 h-100 bg-light bg-opacity-50" style="border-radius: 16px;">
                                        <h6 class="fw-extrabold text-center mb-3 text-dark uppercase tracking-wider fs-13"><i class="ti ti-compass me-1 text-warning"></i> Raasi Chart</h6>
                                        <table class="horoscope-table text-center">
                                            <tr>
                                                <td style="width: 25%; height: 60px;">{{ $member->raasi_1 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->raasi_2 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->raasi_3 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->raasi_4 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->raasi_12 }}</td>
                                                <td colspan="2" rowspan="2" class="horoscope-center align-middle">RAASI</td>
                                                <td style="height: 60px;">{{ $member->raasi_5 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->raasi_11 }}</td>
                                                <td style="height: 60px;">{{ $member->raasi_6 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->raasi_10 }}</td>
                                                <td style="height: 60px;">{{ $member->raasi_9 }}</td>
                                                <td style="height: 60px;">{{ $member->raasi_8 }}</td>
                                                <td style="height: 60px;">{{ $member->raasi_7 }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border border-light shadow-none p-3 h-100 bg-light bg-opacity-50" style="border-radius: 16px;">
                                        <h6 class="fw-extrabold text-center mb-3 text-dark uppercase tracking-wider fs-13"><i class="ti ti-compass me-1 text-warning"></i> Amsam Chart</h6>
                                        <table class="horoscope-table text-center">
                                            <tr>
                                                <td style="width: 25%; height: 60px;">{{ $member->amsam_1 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->amsam_2 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->amsam_3 }}</td>
                                                <td style="width: 25%; height: 60px;">{{ $member->amsam_4 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->amsam_12 }}</td>
                                                <td colspan="2" rowspan="2" class="horoscope-center align-middle">AMSAM</td>
                                                <td style="height: 60px;">{{ $member->amsam_5 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->amsam_11 }}</td>
                                                <td style="height: 60px;">{{ $member->amsam_6 }}</td>
                                            </tr>
                                            <tr>
                                                <td style="height: 60px;">{{ $member->amsam_10 }}</td>
                                                <td style="height: 60px;">{{ $member->amsam_9 }}</td>
                                                <td style="height: 60px;">{{ $member->amsam_8 }}</td>
                                                <td style="height: 60px;">{{ $member->amsam_7 }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Photos Tab -->
                    <div id="photos" class="tab-pane fade" role="tabpanel">
                        <h5 class="section-title-premium mb-4">Member Photo Gallery</h5>
                        <div class="row g-3">
                            @forelse($images as $img)
                            <div class="col-md-6 col-xl-4">
                                <div class="gallery-img-wrapper h-100">
                                    <div class="position-absolute top-0 end-0 p-2" style="z-index: 3;">
                                        <span class="badge bg-dark bg-opacity-75 rounded-pill px-2.5 py-1">{{ $img->type }}</span>
                                    </div>
                                    <a href="{{ storage_url($img->image_name) }}" target="_blank">
                                        <img src="{{ storage_url($img->image_name) }}" class="img-fluid w-100" style="height: 220px; object-fit: cover;" alt="Member Image">
                                    </a>
                                </div>
                            </div>
                            @empty
                            <div class="col-12 text-center py-5">
                                <div class="mb-3">
                                    <i class="ti ti-photo-off text-muted" style="font-size: 48px;"></i>
                                </div>
                                <h5 class="text-muted fw-bold">No gallery photos uploaded</h5>
                                <p class="text-muted-50 small">There are currently no photos or horoscope images uploaded for this member.</p>
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
