@extends('layouts.frontend')

@section('styles')
<style>
    .match-card { border-radius: 15px; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; }
    .match-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .match-thumb { position: relative; height: 250px; overflow: hidden; }
    .match-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .match-card:hover .match-thumb img { transform: scale(1.1); }
    .gender-badge { position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.9); padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 11px; }
    .section-title { font-weight: 800; color: #333; position: relative; padding-bottom: 15px; margin-bottom: 30px; }
    .section-title::after { content: ''; position: absolute; left: 0; bottom: 0; width: 50px; height: 4px; background: #ab0772; border-radius: 2px; }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            @include('partials.member_sidebar')

            <div class="col-lg-9">
                <!-- Welcome Banner -->
                <div class="card border-0 shadow-sm mb-5 text-white overflow-hidden" style="border-radius: 15px; background: linear-gradient(135deg, #ab0772 0%, #764ba2 100%);">
                    <div class="card-body p-4 p-md-5 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h2 class="fw-bold mb-2">Find Your Perfect Match, {{ explode(' ', $user->name)[0] }}!</h2>
                            <p class="fs-16 opacity-75 mb-0">We have analyzed thousands of profiles to find the best recommendations for you.</p>
                        </div>
                        <div class="d-none d-md-block">
                            <i class="fa fa-heart-circle-check fs-1 opacity-25"></i>
                        </div>
                    </div>
                </div>

                <!-- Membership & Plan Tracker Widget -->
                @php
                    $planAssign = $user->getPlanDetails();
                    $usedInt = $planAssign->used_interests;
                    $totalInt = $planAssign->total_interests;
                    $remInt = max(0, $totalInt - $usedInt);
                    $percent = $totalInt > 0 ? min(100, round(($usedInt / $totalInt) * 100)) : 0;
                    $planName = \App\Models\Plan::find($planAssign->plan_id)->name ?? 'Free';
                @endphp
                <div class="card border-0 shadow-sm mb-5 p-4" style="border-radius: 15px; background: #fff;">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4 border-end">
                            <span class="text-muted small text-uppercase fw-bold d-block mb-1">Active Plan</span>
                            <h4 class="fw-bold mb-1" style="color: #ab0772;">{{ strtoupper($planName) }}</h4>
                            <span class="text-muted small">Expires: {{ \Carbon\Carbon::parse($planAssign->plan_end_date)->format('d-m-Y') }}</span>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold text-dark">Interest Credits</span>
                                <span class="text-primary fw-bold">{{ $usedInt }} / {{ $totalInt }} Used ({{ $remInt }} Remaining)</span>
                            </div>
                            <div class="progress mb-2 shadow-sm" style="height: 12px; border-radius: 6px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percent }}%; background: linear-gradient(90deg, #ab0772 0%, #e00c84 100%);" aria-valuenow="{{ $usedInt }}" aria-valuemin="0" aria-valuemax="{{ $totalInt }}"></div>
                            </div>
                            <span class="text-muted small"><i class="fa fa-info-circle me-1"></i> Send interest requests to potential matches to unlock full contact details!</span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-5 p-4" style="border-radius: 15px; background: #fff;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0" style="color: #ab0772; font-size: 18px;">
                            <i class="fa fa-user me-2"></i> About Me / என்னைப் பற்றி
                        </h5>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 12px; border-color: #ab0772; color: #ab0772;">
                            <i class="fa fa-edit me-1"></i> Edit / திருத்து
                        </a>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 15px;">
                        {{ $user->about_me ?? 'No details provided yet. Click Edit to add something about yourself.' }}
                    </p>
                </div>

                @php
                    $isPremium = ($planAssign && !in_array($planAssign->plan_id, [1, 14]) && strtolower($planName) !== 'free' && strtolower($planName) !== 'free plan');
                @endphp

                @if($isPremium)
                <!-- Premium Recommendations -->
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="section-title">Premium Recommendations</h4>
                    <a href="#" class="text-primary fw-bold small">See All <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
                <div class="row g-4 mb-5">
                    @forelse($premium_matches as $match)
                        <div class="col-md-4">
                            <div class="card match-card shadow-sm h-100">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ storage_url($match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/' . ($match->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="image">
                                    @endif
                                    <div class="gender-badge shadow-sm">
                                        <i class="fa fa-star text-warning me-1"></i> PREMIUM
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small fw-bold">{{ $match->userid }}</span>
                                        <span class="text-primary small fw-bold"><i class="fa fa-circle fs-8 me-1"></i> Online</span>
                                    </div>
                                    <h5 class="fw-bold mb-3"><a href="{{ route('profile.view', $match->id) }}" class="text-dark text-decoration-none">{{ $match->name }}</a></h5>
                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        <span class="badge bg-light text-dark border px-2 py-1">{{ $match->age }} Yrs</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">{{ $match->maritalstatus }}</span>
                                        <span class="badge bg-light text-dark border px-2 py-1">{{ $match->religion }}</span>
                                    </div>
                                    <div class="d-grid">
                                        <a href="{{ route('profile.view', $match->id) }}" class="btn btn-outline-primary rounded-pill fw-bold">View Full Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-white">
                                <i class="fa fa-search text-muted mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-muted">No premium profiles found matching your preferences.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
                @endif

                <!-- New Matches -->
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h4 class="section-title">Newest Members</h4>
                    <a href="#" class="text-primary fw-bold small">View More <i class="fa fa-arrow-right ms-1"></i></a>
                </div>
                <div class="row g-4">
                    @forelse($new_matches as $match)
                        <div class="col-md-4">
                            <div class="card match-card shadow-sm h-100">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ storage_url($match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/' . ($match->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="image">
                                    @endif
                                    <div class="gender-badge shadow-sm" style="background: rgba(0,0,0,0.5); color: #fff;">
                                        NEW JOINER
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small fw-bold">{{ $match->userid }}</span>
                                    </div>
                                    <h5 class="fw-bold mb-3"><a href="{{ route('profile.view', $match->id) }}" class="text-dark text-decoration-none">{{ $match->name }}</a></h5>
                                    <div class="d-flex flex-wrap gap-2 mb-4">
                                        <span class="badge bg-light text-dark border px-2 py-1">{{ $match->age }} Yrs</span>
                                        <span class="badge bg-light text-dark border px-2 py-1 text-truncate" style="max-width: 80px;">{{ $match->maritalstatus }}</span>
                                    </div>
                                    <div class="d-grid">
                                        <a href="{{ route('profile.view', $match->id) }}" class="btn btn-outline-dark rounded-pill fw-bold">View Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-4 text-center py-5 bg-white">
                                <h5 class="text-muted">No new members found recently.</h5>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@if(session('registration_success'))
{{-- Registration Success Modal --}}
<div class="modal fade" id="regSuccessModal" tabindex="-1" aria-labelledby="regSuccessModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">

            {{-- Header gradient --}}
            <div class="modal-header border-0 text-white text-center d-block py-4"
                 style="background: linear-gradient(135deg, #ab0772 0%, #e00c84 50%, #764ba2 100%);">
                <div class="mb-2">
                    <span style="font-size: 3rem;">🎉</span>
                </div>
                <h4 class="modal-title fw-bold mb-1" id="regSuccessModalLabel">Registration Successful!</h4>
                <p class="mb-0 opacity-75 small">Welcome to Sri Vaarahi Matrimony</p>
            </div>

            {{-- Body --}}
            <div class="modal-body px-4 py-4">
                <p class="text-center text-muted mb-4 small">Your profile has been created. Please save the details below for your records.</p>

                <div class="d-flex flex-column gap-3">

                    {{-- Matrimony ID (highlighted) --}}
                    <div class="d-flex align-items-center p-3 rounded-3" style="background: linear-gradient(135deg, rgba(171,7,114,0.08), rgba(118,75,162,0.08)); border: 1px solid rgba(171,7,114,0.2);">
                        <div class="me-3 text-center" style="min-width: 36px;">
                            <i class="fa fa-id-badge" style="color: #ab0772; font-size: 1.4rem;"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Matrimony ID</div>
                            <div class="fw-bold fs-5" style="color: #ab0772; letter-spacing: 1px;">{{ session('reg_matrimony_id') }}</div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                        <div class="me-3 text-center" style="min-width: 36px;">
                            <i class="fa fa-user text-secondary" style="font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Name</div>
                            <div class="fw-semibold text-dark">{{ session('reg_name') }}</div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                        <div class="me-3 text-center" style="min-width: 36px;">
                            <i class="fa fa-envelope text-secondary" style="font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Email ID</div>
                            <div class="fw-semibold text-dark">{{ session('reg_email') }}</div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="d-flex align-items-center p-3 rounded-3 bg-light">
                        <div class="me-3 text-center" style="min-width: 36px;">
                            <i class="fa fa-key text-secondary" style="font-size: 1.1rem;"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px;">Password</div>
                            <div class="fw-semibold text-dark font-monospace">{{ session('reg_password') }}</div>
                        </div>
                    </div>

                </div>

                <div class="alert alert-warning border-0 mt-4 py-2 px-3 rounded-3 small">
                    <i class="fa fa-triangle-exclamation me-1"></i>
                    Please save your Matrimony ID and password. Your profile is <strong>under review</strong> and will be activated soon.
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 px-4 pb-4 d-flex gap-2 justify-content-center">
                <a href="{{ route('login') }}" class="btn px-4 py-2 fw-bold text-white rounded-pill"
                   style="background: linear-gradient(135deg, #ab0772, #e00c84); min-width: 130px;">
                    <i class="fa fa-sign-in-alt me-2"></i> Login
                </a>
                <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-bold rounded-pill" data-bs-dismiss="modal" style="min-width: 130px;">
                    <i class="fa fa-times me-2"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>
@endif

@if(auth()->check() && auth()->user()->status == 0)
{{-- Pending Approval Modal (always rendered when status=0, independent of registration session) --}}
<div class="modal fade" id="pendingApprovalModal" tabindex="-1" aria-labelledby="pendingApprovalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            {{-- Header gradient --}}
            <div class="modal-header border-0 text-white text-center d-block py-4"
                 style="background: linear-gradient(135deg, #e65c00 0%, #f9d423 100%);">
                <div class="mb-2">
                    <span style="font-size: 3rem;">⏳</span>
                </div>
                <h4 class="modal-title fw-bold mb-1" id="pendingApprovalModalLabel">Profile Under Review</h4>
                <p class="mb-0 opacity-75 small">Waiting for Admin Approval</p>
            </div>

            {{-- Body --}}
            <div class="modal-body px-4 py-4 text-center">
                <div class="mb-3 text-warning">
                    <i class="fa fa-clock fs-1" style="animation: pulse 2s infinite;"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hello, {{ auth()->user()->name }}</h5>
                <p class="text-muted small px-2">Your profile is currently under review by our admin team. Once approved, you will have full access to view matches, express interests, and connect with prospective partners.</p>
                <div class="alert alert-info border-0 py-2 px-3 rounded-3 small text-start">
                    <i class="fa fa-info-circle me-1"></i>
                    <strong>Matrimony ID:</strong> {{ auth()->user()->mid }}<br>
                    <strong>Status:</strong> Registration completed. Verification in progress.
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer border-0 px-4 pb-4 d-flex justify-content-center">
                <form method="POST" action="{{ route('logout') }}" class="w-100 text-center">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger px-4 py-2 fw-bold rounded-pill" style="min-width: 150px;">
                        <i class="fa fa-sign-out-alt me-2"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }
</style>
@endif

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('registration_success'))
            // Show registration success modal first
            var regModalEl = document.getElementById('regSuccessModal');
            if (regModalEl) {
                var regModal = new bootstrap.Modal(regModalEl, {
                    backdrop: 'static',
                    keyboard: false
                });
                regModal.show();

                @if(auth()->check() && auth()->user()->status == 0)
                    // When registration success modal is closed, immediately show pending approval modal
                    regModalEl.addEventListener('hidden.bs.modal', function () {
                        var pendingEl = document.getElementById('pendingApprovalModal');
                        if (pendingEl) {
                            var pendingModal = new bootstrap.Modal(pendingEl, {
                                backdrop: 'static',
                                keyboard: false
                            });
                            pendingModal.show();
                        }
                    });
                @endif
            }
        @elseif(auth()->check() && auth()->user()->status == 0)
            // Normal login — status is still pending, lock the dashboard
            var pendingEl = document.getElementById('pendingApprovalModal');
            if (pendingEl) {
                var pendingModal = new bootstrap.Modal(pendingEl, {
                    backdrop: 'static',
                    keyboard: false
                });
                pendingModal.show();
            }
        @endif
    });
</script>
@endsection

