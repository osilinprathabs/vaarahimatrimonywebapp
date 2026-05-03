<div class="col-lg-3">
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
        <div class="bg-primary p-4 text-center">
            <div class="position-relative d-inline-block">
                @if($user->latestProfileImage)
                    <img src="{{ asset('storage/' . $user->latestProfileImage->image_name) }}" class="rounded-circle border border-4 border-white shadow" style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <img src="{{ asset('assets/images/' . ($user->gender == 'Female' ? 'female.png' : 'men.png')) }}" class="rounded-circle border border-4 border-white shadow" style="width: 100px; height: 100px; object-fit: cover;">
                @endif
                <a href="{{ route('profile.edit') }}" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1 shadow-sm text-primary" style="width: 30px; height: 30px;">
                    <i class="fa fa-camera" style="font-size: 12px;"></i>
                </a>
            </div>
            <h5 class="text-white mt-3 mb-1 fw-bold">{{ $user->name }}</h5>
            <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3">{{ $user->userid }}</span>
        </div>
        
        <div class="card-body p-0">
            <div class="p-3 border-bottom text-center">
                <span class="d-block text-muted small text-uppercase fw-bold mb-2">Membership Status</span>
                <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm" style="font-size: 11px;">
                    <i class="fa fa-star me-1"></i> {{ $user->plan ?? 'FREE' }} PLAN
                </span>
            </div>

            <div class="list-group list-group-flush py-2">
                <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action border-0 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-light text-primary fw-bold' : 'text-muted' }}">
                    <i class="fa fa-th-large me-3"></i> Dashboard
                </a>
                <a href="{{ route('profile.view', $user->id) }}" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-eye me-3"></i> My Public Profile
                </a>
                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-user-edit me-3"></i> Edit My Details
                </a>
                <a href="{{ route('search.id') }}" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-search me-3"></i> ID Search
                </a>
                <a href="{{ route('search.advanced') }}" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-filter me-3"></i> Match Finder
                </a>
                <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-heart me-3"></i> Express Interests
                </a>
                <a href="#" class="list-group-item list-group-item-action border-0 px-4 py-3 text-muted">
                    <i class="fa fa-history me-3"></i> View History
                </a>
            </div>

            <div class="p-4 bg-light mx-3 mb-3 mt-2 rounded" style="border: 1px dashed #dee2e6;">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="small text-muted">Profile Credits</span>
                    <span class="small fw-bold text-primary">0 / 0</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: 0%"></div>
                </div>
                <a href="#" class="btn btn-sm btn-primary w-100 mt-3 rounded-pill fw-bold" style="font-size: 11px;">Upgrade Now</a>
            </div>
        </div>
    </div>
</div>
