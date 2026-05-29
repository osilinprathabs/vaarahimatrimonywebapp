<div class="col-lg-3">
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
        <div class="bg-primary p-4 text-center">
            <div class="position-relative d-inline-block">
                @if($user->latestProfileImage)
                    <img src="{{ storage_url($user->latestProfileImage->image_name) }}"
                         class="rounded-circle border border-4 border-white shadow"
                         style="width: 100px; height: 100px; object-fit: cover;"
                         id="sidebar-profile-preview">
                @else
                    <img src="{{ asset('assets/images/' . ($user->gender == 'Female' ? 'female.png' : 'men.png')) }}"
                         class="rounded-circle border border-4 border-white shadow"
                         style="width: 100px; height: 100px; object-fit: cover;"
                         id="sidebar-profile-preview">
                @endif

                {{-- Camera button → opens modal --}}
                <button type="button"
                        class="position-absolute bottom-0 end-0 bg-white rounded-circle p-1 shadow-sm text-primary border-0"
                        style="width: 30px; height: 30px; cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#photoUploadModal"
                        title="Change Photo">
                    <i class="fa fa-camera" style="font-size: 12px;"></i>
                </button>
            </div>

            {{-- Success/error flash for photo upload --}}
            @if(session('photo_status'))
                <div class="alert alert-success alert-dismissible mt-3 py-2 px-3 text-start" style="font-size: 12px; border-radius: 8px;">
                    <i class="fa fa-check-circle me-1"></i> {{ session('photo_status') }}
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->has('profile_img'))
                <div class="alert alert-danger alert-dismissible mt-3 py-2 px-3 text-start" style="font-size: 12px; border-radius: 8px;">
                    <i class="fa fa-exclamation-circle me-1"></i> {{ $errors->first('profile_img') }}
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                </div>
            @endif

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

{{-- ========== Photo Upload Modal ========== --}}
<div class="modal fade" id="photoUploadModal" tabindex="-1" aria-labelledby="photoUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">

            <div class="modal-header bg-primary text-white border-0 px-4">
                <h5 class="modal-title fw-bold" id="photoUploadModalLabel">
                    <i class="fa fa-camera me-2"></i> Update Profile Photo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                {{-- Current photo preview --}}
                <div class="text-center mb-4">
                    @if($user->latestProfileImage)
                        <img src="{{ storage_url($user->latestProfileImage->image_name) }}"
                             id="modal-current-photo"
                             class="rounded-circle border border-4 shadow"
                             style="width: 120px; height: 120px; object-fit: cover; border-color: #ab0772 !important;">
                        <div class="mt-2">
                            @if($user->latestProfileImage->status == 0)
                                <span class="badge bg-warning text-dark"><i class="fa fa-clock me-1"></i>Pending Approval</span>
                            @else
                                <span class="badge bg-success"><i class="fa fa-check me-1"></i>Approved</span>
                            @endif
                        </div>
                    @else
                        <img src="{{ asset('assets/images/' . ($user->gender == 'Female' ? 'female.png' : 'men.png')) }}"
                             id="modal-current-photo"
                             class="rounded-circle border border-4 shadow"
                             style="width: 120px; height: 120px; object-fit: cover; border-color: #dee2e6;">
                        <div class="mt-2 text-muted small">No photo uploaded yet</div>
                    @endif
                </div>

                {{-- Upload form --}}
                <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data" id="photoUploadForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Select New Photo</label>
                        <input type="file"
                               name="profile_img"
                               id="photoFileInput"
                               class="form-control"
                               accept="image/jpeg,image/png,image/webp"
                               required>
                        <div class="form-text">JPG, PNG or WebP · Max 4 MB · Will be reviewed by admin before going live.</div>
                    </div>

                    {{-- Live preview of selected file --}}
                    <div class="text-center mb-3" id="new-photo-preview-wrap" style="display:none;">
                        <p class="text-muted small mb-1">Preview</p>
                        <img id="new-photo-preview"
                             class="rounded-circle border border-3"
                             style="width: 90px; height: 90px; object-fit: cover; border-color: #ab0772 !important;">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold rounded-pill">
                            <i class="fa fa-upload me-2"></i> Upload Photo
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
// Live image preview before upload
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('photoFileInput');
    if (!input) return;
    input.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('new-photo-preview').src = e.target.result;
            document.getElementById('new-photo-preview-wrap').style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
});
</script>
