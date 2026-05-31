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
