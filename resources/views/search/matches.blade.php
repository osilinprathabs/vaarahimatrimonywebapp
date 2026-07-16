@extends('layouts.frontend')

@section('styles')
<style>
    .head-back {
        background: linear-gradient(135deg, #ab0772 0%, #a90771 50%, #5d0156 100%);
        padding: 20px;
        border-radius: 12px;
        color: #fff;
        box-shadow: 0 4px 15px rgba(171, 7, 114, 0.2);
    }
    .head-back h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .match-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 24px;
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
    }
    .match-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(171, 7, 114, 0.1);
        border-color: rgba(171, 7, 114, 0.15);
    }
    .match-thumb {
        position: relative;
        overflow: hidden;
    }
    .match-thumb img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .match-card:hover .match-thumb img {
        transform: scale(1.05);
    }
    .match-info {
        padding: 20px;
    }
    .match-info h5 {
        margin: 0 0 8px;
        font-size: 17px;
        font-weight: 700;
    }
    .match-info h5 a {
        color: #1e293b;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .match-info h5 a:hover {
        color: #ac0772;
    }
    .match-info p {
        margin: 0 0 6px;
        font-size: 13.5px;
        color: #64748b;
    }
    .match-info p i {
        width: 18px;
        color: #ab0772;
    }
    .btn-view-profile {
        background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }
    .btn-view-profile:hover {
        box-shadow: 0 4px 12px rgba(169, 7, 113, 0.3);
        color: #fff;
        transform: translateY(-1px);
    }
    .preference-banner {
        background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
        border: 1px dashed #f472b6;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8fafc; min-height: 80vh;">
    <div class="container">
        <div class="row">
            @include('partials.member_sidebar')
            <div class="col-md-9">
                
                @if(!$hasPreferences)
                    <div class="preference-banner text-center shadow-sm">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background-color: #fbcfe8; color: #ac0772;">
                            <i class="fa fa-heart" style="font-size: 24px;"></i>
                        </div>
                        <h4 class="fw-bold mb-2" style="color: #831843;">Partner Preferences Not Configured</h4>
                        <p class="text-muted mx-auto mb-4" style="max-width: 550px; font-size: 14.5px; line-height: 1.6;">
                            Configure your partner preferences (age, marital status, caste, education, and monthly income) in your profile to find highly compatible matches automatically!
                        </p>
                        <a href="{{ route('profile.edit') }}#partner" class="btn btn-primary px-4 py-2 rounded-pill fw-bold" style="background: linear-gradient(135deg, #e00c84 0%, #a90771 50%); border: none;">
                            <i class="fa fa-cog me-2"></i> Set Partner Preferences
                        </a>
                    </div>
                @else
                    <div class="preference-banner d-flex flex-column flex-md-row align-items-center justify-content-between shadow-sm">
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            <h4 class="fw-bold mb-1" style="color: #831843;"><i class="fa fa-check-circle text-success me-2"></i>Auto Match Finder Active</h4>
                            <p class="text-muted mb-0 small" style="font-size: 13.5px;">
                                Showing profiles automatically matching your saved expectations.
                            </p>
                        </div>
                        <a href="{{ route('profile.edit') }}#partner" class="btn btn-outline-primary btn-sm rounded-pill px-3" style="border-color: #ac0772; color: #ac0772; font-weight: 600;">
                            <i class="fa fa-edit me-1"></i> Edit Preferences
                        </a>
                    </div>
                @endif

                <div class="head-back mb-4 d-flex justify-content-between align-items-center">
                    <h2>My Matching Profiles</h2>
                    <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-2 small">{{ $results->count() }} Matches Found</span>
                </div>

                <div class="row">
                    @forelse($results as $match)
                        <div class="col-md-4">
                            <div class="match-card">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ storage_url($match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/' . ($match->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="Profile Image">
                                    @endif
                                </div>
                                <div class="match-info">
                                    <span class="badge bg-light text-primary border rounded-pill px-2 py-1 mb-2 font-monospace" style="font-size: 11px;">{{ $match->userid }}</span>
                                    <h5><a href="{{ route('profile.view', $match->id) }}">{{ $match->name }}</a></h5>
                                    <p><i class="fa fa-birthday-cake"></i> Age: {{ $match->age }} Yrs</p>
                                    <p><i class="fa fa-heart"></i> {{ $match->maritalstatus }}</p>
                                    @if($match->education)
                                        <p class="text-truncate"><i class="fa fa-graduation-cap"></i> {{ $match->education }}</p>
                                    @endif
                                    
                                    <div class="d-grid mt-3">
                                        <a href="{{ route('profile.view', $match->id) }}" class="btn btn-view-profile text-center">
                                            View Profile <i class="fa fa-arrow-right ms-1" style="font-size: 11px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center p-5 bg-white rounded shadow-sm" style="border-radius: 12px;">
                                <div class="mb-3 text-muted">
                                    <i class="fa fa-search" style="font-size: 48px;"></i>
                                </div>
                                <h5 class="fw-bold mb-2">No Profiles Found</h5>
                                <p class="text-muted mb-0">No profiles currently match your saved partner preferences. Try adjusting your preferences to expand your search!</p>
                                <a href="{{ route('profile.edit') }}#partner" class="btn btn-sm btn-outline-primary mt-3 rounded-pill px-4" style="color:#ac0772; border-color:#ac0772;">Adjust Preferences</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
