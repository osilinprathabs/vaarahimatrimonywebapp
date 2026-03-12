@extends('layouts.frontend')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            @include('partials.member_sidebar')
            <div class="col-md-9">
                <div class="card p-4 shadow-sm">
                    <h3 class="mb-4" style="color: #ac0772; font-weight: 700;">ID Search</h3>
                    <p class="text-muted">Search for a profile by entering their Member ID (e.g., SSM1001).</p>
                    <form method="post" action="{{ route('search.id') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Enter MID / வரன் ஐடி</label>
                            <input class="form-control" name="mid" id="mid" placeholder="Enter MID" required>
                        </div>
                        <button class="btn btn-primary w-100" style="background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%); border: none;" type="submit">SEARCH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
