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

                <!-- Premium Profiles -->
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
                                        <img src="{{ asset('storage/' . $match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
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
                                        <img src="{{ asset('storage/' . $match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
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
