@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Horoscope Approval Queue</h4>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Member ID</th>
                        <th>Member Name</th>
                        <th>Horoscope Preview</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Manage / Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($horoscopes as $i => $horoscope)
                    <tr>
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td><span class="badge bg-light text-dark fw-bold">{{ $horoscope->m_userid }}</span></td>
                        <td class="fw-bold">{{ $horoscope->name }}</td>
                        <td>
                            <button type="button" class="btn p-0 border-0" data-bs-toggle="modal" data-bs-target="#horoscopeModal{{ $horoscope->id }}" title="Click to view and approve/reject">
                                <img src="{{ asset('storage/' . $horoscope->image) }}" onerror="this.src='{{ asset('uploads/jathagam/' . $horoscope->image) }}'; this.onerror=function(){ this.src='{{ asset('uploads/horoscopes/' . $horoscope->image) }}'; this.onerror=function(){ this.src='/images/users/user-1.jpg'; }; };" width="55" height="55" class="rounded shadow-sm border border-light" style="object-fit: cover; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                            </button>
                        </td>
                        <td class="text-center">
                            @if($horoscope->status == 0)
                                <span class="badge bg-warning-subtle text-warning px-2.5 py-1 fw-semibold">Pending</span>
                            @elseif($horoscope->status == 1)
                                <span class="badge bg-success-subtle text-success px-2.5 py-1 fw-semibold">Approved</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-2.5 py-1 fw-semibold">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#horoscopeModal{{ $horoscope->id }}">
                                <i class="ti ti-zoom-in me-1"></i> View &amp; Decide
                            </button>

                            <!-- Modern Horoscope Approval Modal Popup -->
                            <div class="modal fade" id="horoscopeModal{{ $horoscope->id }}" tabindex="-1" aria-labelledby="horoscopeModalLabel{{ $horoscope->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                                        <div class="modal-header border-0 bg-light py-3">
                                            <h5 class="modal-title fw-bold" id="horoscopeModalLabel{{ $horoscope->id }}">
                                                Review Horoscope
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center p-4">
                                            <div class="mb-3">
                                                <h6 class="fw-bold text-dark mb-1">{{ $horoscope->name }}</h6>
                                                <span class="badge bg-secondary-subtle text-secondary fw-semibold">MID No: {{ $horoscope->m_userid }}</span>
                                            </div>
                                            
                                            <div class="position-relative d-inline-block rounded-3 shadow-sm border border-light p-2 bg-white mb-4">
                                                <img src="{{ asset('storage/' . $horoscope->image) }}" onerror="this.src='{{ asset('uploads/jathagam/' . $horoscope->image) }}'; this.onerror=function(){ this.src='{{ asset('uploads/horoscopes/' . $horoscope->image) }}'; this.onerror=function(){ this.src='/images/users/user-1.jpg'; }; };" class="img-fluid rounded" style="max-height: 380px; object-fit: contain; min-width: 250px;">
                                            </div>

                                            <div class="d-flex justify-content-center gap-3">
                                                <form action="{{ route('admin.members.horoscope_update', $horoscope->id) }}" method="POST" class="flex-grow-1 max-w-150">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                    <button type="submit" class="btn btn-success w-100 py-2.5 rounded-pill fw-bold shadow-sm">
                                                        <i class="ti ti-check me-1 fs-16"></i> Approve Horoscope
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.members.horoscope_update', $horoscope->id) }}" method="POST" class="flex-grow-1 max-w-150">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                    <button type="submit" class="btn btn-danger w-100 py-2.5 rounded-pill fw-bold shadow-sm">
                                                        <i class="ti ti-x me-1 fs-16"></i> Reject Horoscope
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="ti ti-file-off fs-32 d-block mb-2"></i>
                            No horoscopes in the approval queue.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $horoscopes->links() }}
        </div>
    </div>
</div>
@endsection
