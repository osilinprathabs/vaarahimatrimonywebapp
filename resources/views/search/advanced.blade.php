@extends('layouts.frontend')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            @include('partials.member_sidebar')
            <div class="col-md-9">
                <div class="card p-4 shadow-sm">
                    <h3 class="mb-4" style="color: #ac0772; font-weight: 700;">Advanced Search</h3>
                    <form method="post" action="{{ route('search.advanced') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Min Age / குறைந்தபட்ச வயது</label>
                                <input type="number" name="min_age" class="form-control" placeholder="18">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Max Age / அதிகபட்ச வயது</label>
                                <input type="number" name="max_age" class="form-control" placeholder="60">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Marital Status / திருமண நிலை</label>
                                <select name="marital_status" class="form-control">
                                    <option value="">Any / கவலை இல்லை</option>
                                    @foreach($marital_statuses as $ms)
                                        <option value="{{ $ms->marital_status }}">{{ $ms->marital_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" style="background: linear-gradient(135deg, #e00c84 0%, #a90771 50%, #5d0156 100%); border: none;" type="submit">SEARCH</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
