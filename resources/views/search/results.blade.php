@extends('layouts.frontend')

@section('styles')
<style>
    .head-back { background: linear-gradient(135deg, #ab0772 0%,#a90771 50%,#5d0156 100%); padding: 15px; border-radius: 5px 5px 0 0; color: #fff; }
    .head-back h2 { margin: 0; font-size: 20px; }
    .match-card { background: #fff; border-radius: 5px; overflow: hidden; box-shadow: 0 0 5px rgba(0,0,0,0.1); margin-bottom: 20px; transition: transform 0.3s; }
    .match-card:hover { transform: translateY(-5px); }
    .match-thumb img { width: 100%; height: 200px; object-fit: cover; }
    .match-info { padding: 15px; }
    .match-info h5 { margin: 0 0 10px; font-size: 16px; color: #ac0772; }
    .match-info p { margin: 0 0 5px; font-size: 13px; color: #666; }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            @include('partials.member_sidebar')
            <div class="col-md-9">
                <div class="head-back mb-3">
                    <h2>Search Results</h2>
                </div>
                <div class="row">
                    @forelse($results as $match)
                        <div class="col-md-4">
                            <div class="match-card">
                                <div class="match-thumb">
                                    @if($match->latestProfileImage)
                                        <img src="{{ asset('storage/' . $match->latestProfileImage->image) }}" alt="{{ $match->name }}">
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
                        <div class="col-12"><p class="text-center p-5 bg-white rounded shadow-sm">No profiles found matching your search.</p></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
