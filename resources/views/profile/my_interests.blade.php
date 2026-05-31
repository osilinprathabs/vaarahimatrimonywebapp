@extends('layouts.frontend')

@section('styles')
<style>
    .interest-card {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        background: #fff;
    }
    .interest-tab-btn {
        padding: 12px 20px;
        font-weight: 700;
        color: #64748b;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }
    .interest-tab-btn:hover {
        color: #ab0772;
    }
    .interest-tab-btn.active {
        color: #ab0772;
        border-bottom-color: #ab0772;
    }
    .table th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
    }
    .table td {
        vertical-align: middle;
        font-size: 14px;
        color: #1e293b;
    }
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 20px;
    }
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-accepted { background: #dcfce7; color: #15803d; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .status-withdrawn { background: #f1f5f9; color: #64748b; }
</style>
@endsection

@section('content')
<section class="py-5" style="background-color: #f0f2f5; min-height: 100vh;">
    <div class="container">
        <div class="row g-4">
            {{-- Member Sidebar Left --}}
            @include('partials.member_sidebar')

            {{-- Interests Dashboard Right --}}
            <div class="col-lg-9">
                <div class="card interest-card shadow-sm mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bold mb-1" style="color: #ab0772;">My Interests</h3>
                                <p class="text-muted small mb-0">Manage interest requests sent and received.</p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mx-4 mt-3 py-3 px-4 d-flex align-items-center" style="border-radius: 12px;">
                            <i class="fa fa-check-circle fs-4 me-3 text-success"></i>
                            <div>
                                <span class="fw-bold text-success">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mx-4 mt-3 py-3 px-4 d-flex align-items-center" style="border-radius: 12px;">
                            <i class="fa fa-exclamation-circle fs-4 me-3 text-danger"></i>
                            <div>
                                <span class="fw-bold text-danger">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="card-body p-4">
                        {{-- Tabs Navigation --}}
                        <ul class="nav nav-tabs border-bottom mb-4" id="interestTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link interest-tab-btn active" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab">
                                    <i class="fa fa-paper-plane me-2"></i>Sent Interests
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link interest-tab-btn" id="received-tab" data-bs-toggle="tab" data-bs-target="#received" type="button" role="tab">
                                    <i class="fa fa-envelope-open me-2"></i>Received Interests
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link interest-tab-btn" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted" type="button" role="tab">
                                    <i class="fa fa-check-double me-2"></i>Accepted Mutual
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link interest-tab-btn" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
                                    <i class="fa fa-ban me-2"></i>Rejected
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="interestTabsContent">
                            {{-- Tab 1: Sent Interests --}}
                            <div class="tab-pane fade show active" id="sent" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Profile ID</th>
                                                <th>Name</th>
                                                <th>Date Sent</th>
                                                <th>Status</th>
                                                <th>Contact Access</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($sent as $item)
                                                <tr>
                                                    <td class="fw-bold text-primary">{{ $item->receiver->userid }}</td>
                                                    <td>{{ $item->receiver->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <span class="status-badge status-{{ strtolower($item->status) }}">{{ $item->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if($item->status == 'Accepted')
                                                            <button class="btn btn-sm btn-success rounded-pill px-3 view-contact-btn" 
                                                                    data-profile-id="{{ $item->receiver->id }}" 
                                                                    data-interest-id="{{ $item->id }}" 
                                                                    data-name="{{ $item->receiver->name }}"
                                                                    data-mobile="{{ $item->receiver->mobileno }}"
                                                                    data-email="{{ $item->receiver->emailid }}"
                                                                    data-whatsapp="{{ $item->receiver->whatsapp_no ?? 'Not Provided' }}">
                                                                <i class="fa fa-eye me-1"></i> View Contact
                                                            </button>
                                                        @else
                                                            <span class="text-muted small"><i class="fa fa-lock me-1"></i> Hidden</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->status == 'Pending')
                                                            <form action="{{ route('interest.withdraw', $item->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Withdraw this interest request?')">Withdraw</button>
                                                            </form>
                                                        @else
                                                            <span class="text-muted small">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted">No interest requests sent yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Tab 2: Received Interests --}}
                            <div class="tab-pane fade" id="received" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Profile ID</th>
                                                <th>Name</th>
                                                <th>Date Received</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($received as $item)
                                                <tr>
                                                    <td class="fw-bold text-primary">{{ $item->sender->userid }}</td>
                                                    <td>{{ $item->sender->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <span class="status-badge status-{{ strtolower($item->status) }}">{{ $item->status }}</span>
                                                    </td>
                                                    <td>
                                                        @if($item->status == 'Pending')
                                                            <form action="{{ route('interest.accept', $item->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 me-1">Accept</button>
                                                            </form>
                                                            <form action="{{ route('interest.reject', $item->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Reject</button>
                                                            </form>
                                                        @elseif($item->status == 'Accepted')
                                                            <button class="btn btn-sm btn-success rounded-pill px-3 view-contact-btn" 
                                                                    data-profile-id="{{ $item->sender->id }}" 
                                                                    data-interest-id="{{ $item->id }}" 
                                                                    data-name="{{ $item->sender->name }}"
                                                                    data-mobile="{{ $item->sender->mobileno }}"
                                                                    data-email="{{ $item->sender->emailid }}"
                                                                    data-whatsapp="{{ $item->sender->whatsapp_no ?? 'Not Provided' }}">
                                                                <i class="fa fa-eye me-1"></i> View Contact
                                                            </button>
                                                        @else
                                                            <span class="text-muted small">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No interest requests received yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Tab 3: Accepted Mutual --}}
                            <div class="tab-pane fade" id="accepted" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Profile ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Date Accepted</th>
                                                <th>Contact Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($accepted as $item)
                                                @php
                                                    $isSent = $item->from_member_id == $user->id;
                                                    $target = $isSent ? $item->receiver : $item->sender;
                                                @endphp
                                                <tr>
                                                    <td class="fw-bold text-primary">{{ $target->userid }}</td>
                                                    <td>{{ $target->name }}</td>
                                                    <td>
                                                        <span class="badge bg-{{ $isSent ? 'primary' : 'info' }} rounded-pill px-3">{{ $isSent ? 'Sent' : 'Received' }}</span>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success rounded-pill px-3 view-contact-btn" 
                                                                data-profile-id="{{ $target->id }}" 
                                                                data-interest-id="{{ $item->id }}" 
                                                                data-name="{{ $target->name }}"
                                                                data-mobile="{{ $target->mobileno }}"
                                                                data-email="{{ $target->emailid }}"
                                                                data-whatsapp="{{ $target->whatsapp_no ?? 'Not Provided' }}">
                                                            <i class="fa fa-eye me-1"></i> View Contact
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No accepted mutual interests yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Tab 4: Rejected --}}
                            <div class="tab-pane fade" id="rejected" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Profile ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Date Actioned</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($rejected as $item)
                                                @php
                                                    $isSent = $item->from_member_id == $user->id;
                                                    $target = $isSent ? $item->receiver : $item->sender;
                                                @endphp
                                                <tr>
                                                    <td class="fw-bold text-primary">{{ $target->userid }}</td>
                                                    <td>{{ $target->name }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary rounded-pill px-3">{{ $isSent ? 'Sent' : 'Received' }}</span>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <span class="status-badge status-rejected">Rejected</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No rejected interests found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========== Contact Details View Modal ========== --}}
<div class="modal fade" id="contactViewModal" tabindex="-1" aria-labelledby="contactViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-primary text-white border-0 px-4">
                <h5 class="modal-title fw-bold" id="contactViewModalLabel">
                    <i class="fa fa-address-book me-2"></i> Contact Information
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="bg-light d-inline-block p-3 rounded-circle mb-2">
                        <i class="fa fa-user-circle text-primary" style="font-size: 3.5rem;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0" id="modal-member-name">Name</h5>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 mt-2">Interest Accepted</span>
                </div>

                <div class="list-group list-group-flush mb-4">
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 bg-light rounded-3 mb-2">
                        <div>
                            <span class="d-block text-muted small text-uppercase fw-bold">Mobile Number</span>
                            <h6 class="fw-bold mb-0 text-dark" id="modal-member-mobile">Mobile</h6>
                        </div>
                        <a href="" id="modal-call-link" class="btn btn-sm btn-primary rounded-circle p-2" style="width: 36px; height: 36px;"><i class="fa fa-phone"></i></a>
                    </div>
                    
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 bg-light rounded-3 mb-2">
                        <div>
                            <span class="d-block text-muted small text-uppercase fw-bold">Email Address</span>
                            <h6 class="fw-bold mb-0 text-dark" id="modal-member-email">Email</h6>
                        </div>
                        <a href="" id="modal-email-link" class="btn btn-sm btn-primary rounded-circle p-2" style="width: 36px; height: 36px;"><i class="fa fa-envelope"></i></a>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 bg-light rounded-3">
                        <div>
                            <span class="d-block text-muted small text-uppercase fw-bold">WhatsApp Number</span>
                            <h6 class="fw-bold mb-0 text-dark" id="modal-member-whatsapp">WhatsApp</h6>
                        </div>
                        <a href="" id="modal-whatsapp-link" target="_blank" class="btn btn-sm btn-success rounded-circle p-2" style="width: 36px; height: 36px;"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="button" class="btn btn-outline-secondary rounded-pill fw-bold" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.view-contact-btn').click(function() {
        var profileId = $(this).data('profile-id');
        var interestId = $(this).data('interest-id');
        var name = $(this).data('name');
        var mobile = $(this).data('mobile');
        var email = $(this).data('email');
        var whatsapp = $(this).data('whatsapp');

        // Populate Modal Details
        $('#modal-member-name').text(name);
        $('#modal-member-mobile').text(mobile);
        $('#modal-member-email').text(email);
        $('#modal-member-whatsapp').text(whatsapp);

        // Update action links
        $('#modal-call-link').attr('href', 'tel:' + mobile);
        $('#modal-email-link').attr('href', 'mailto:' + email);
        $('#modal-whatsapp-link').attr('href', 'https://wa.me/' + whatsapp.replace(/[^0-9]/g, ''));

        // AJAX Request to log the contact view action
        $.ajax({
            url: "{{ route('contact.log') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                profile_id: profileId,
                interest_id: interestId
            },
            success: function(response) {
                console.log("Contact view logged successfully!");
            },
            error: function(xhr) {
                console.error("Failed to log contact view", xhr);
            }
        });

        // Show Modal
        var myModal = new bootstrap.Modal(document.getElementById('contactViewModal'));
        myModal.show();
    });
});
</script>
@endsection
