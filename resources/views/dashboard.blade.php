@extends('layouts.frontend')

@section('styles')
<style>
    .profile-box { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 20px; text-align: center; }
    .profile-box img { border-radius: 5px; margin-bottom: 15px; max-height: 200px; object-fit: cover; }
    .profile-box li { list-style: none; padding: 10px 0; border-bottom: 1px solid #eee; text-align: left; }
    .profile-box li:last-child { border-bottom: none; }
    .profile-box li i { margin-right: 10px; color: #ac0772; }
    .profile-box a { color: #333; text-decoration: none; }
    .profile-box a:hover { color: #ac0772; }
    .head-back { background: linear-gradient(135deg, #ab0772 0%,#a90771 50%,#5d0156 100%); padding: 15px; border-radius: 5px 5px 0 0; color: #fff; }
    .head-back h2 { margin: 0; font-size: 20px; }
    .match-card { background: #fff; border-radius: 5px; overflow: hidden; box-shadow: 0 0 5px rgba(0,0,0,0.1); margin-bottom: 20px; transition: transform 0.3s; }
    .match-card:hover { transform: translateY(-5px); }
    .match-thumb img { width: 100%; height: 200px; object-fit: cover; }
    .match-info { padding: 15px; }
    .match-info h5 { margin: 0 0 10px; font-size: 16px; color: #ac0772; }
    .match-info p { margin: 0 0 5px; font-size: 13px; color: #666; }
    .btn-freeplan { background: #499d0b; font-size: 12px; padding: 5px 10px; border-radius: 20px; }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            @include('partials.member_sidebar')

            <div class="col-md-9">
                <!-- Premium Profiles -->
                <div class="head-back mb-3">
                    <h2>Premium Profiles</h2>
                </div>
                <div class="row">
                    @forelse($premium_matches as $match)
                        <div class="col-md-4">
                            <div class="match-card">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ asset('storage/' . $match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/' . ($match->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="image">
                                    @endif
                                </div>
                                <div class="match-info">
                                    <p class="mb-1 text-muted">{{ $match->userid }}</p>
                                    <h5><a href="{{ route('profile.view', $match->id) }}">{{ $match->name }}</a></h5>
                                    <p>Age: {{ $match->age }}</p>
                                    <p>Marital Status: {{ $match->maritalstatus }}</p>
                                    <a href="{{ route('profile.view', $match->id) }}" class="btn btn-sm btn-outline-danger mt-2">View Profile <i class="fa fa-user"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center p-5 bg-white rounded shadow-sm">No premium profiles found.</p></div>
                    @endforelse
                </div>

                <!-- New Matches -->
                <div class="head-back mt-4 mb-3">
                    <h2>New Matches</h2>
                </div>
                <div class="row">
                    @forelse($new_matches as $match)
                        <div class="col-md-4">
                            <div class="match-card">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ asset('storage/' . $match->latestProfileImage->image_name) }}" alt="{{ $match->name }}">
                                    @else
                                        <img src="{{ asset('assets/images/' . ($match->gender == 'Female' ? 'female.png' : 'men.png')) }}" alt="image">
                                    @endif
                                </div>
                                <div class="match-info">
                                    <p class="mb-1 text-muted">{{ $match->userid }}</p>
                                    <h5><a href="{{ route('profile.view', $match->id) }}">{{ $match->name }}</a></h5>
                                    <p>Age: {{ $match->age }}</p>
                                    <p>Marital Status: {{ $match->maritalstatus }}</p>
                                    <a href="{{ route('profile.view', $match->id) }}" class="btn btn-sm btn-outline-danger mt-2">View Profile <i class="fa fa-user"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12"><p class="text-center p-5 bg-white rounded shadow-sm">No new matches found.</p></div>
                    @endforelse
                </div>
                
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-outline-primary">View All Matches <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
