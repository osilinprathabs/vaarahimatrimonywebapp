@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div class="page-title-box">
            <h4 class="page-title">Contact Form Messages</h4>
        </div>
        <div>
            <!-- Premium Export Actions Dropdown -->
            <div class="btn-group shadow-sm">
                <button type="button" class="btn btn-success dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-download me-1"></i> Export Messages
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 8px;">
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.contact_messages.export', ['format' => 'csv']) }}">
                            <i class="ti ti-file-type-csv text-primary me-2"></i> Export to CSV
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.contact_messages.export', ['format' => 'excel']) }}">
                            <i class="ti ti-file-spreadsheet text-success me-2"></i> Export to Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" target="_blank" href="{{ route('admin.contact_messages.export', ['format' => 'pdf']) }}">
                            <i class="ti ti-file-type-pdf text-danger me-2"></i> Print / Save PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-3" style="border-radius: 12px;">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-centered align-middle table-nowrap mb-0" id="messagesTable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date Received</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $i => $msg)
                    <tr class="{{ $msg->status === 'Pending' ? 'table-warning-subtle fw-semibold' : '' }}" id="msg-row-{{ $msg->id }}">
                        <td class="ps-3">{{ $i + 1 }}</td>
                        <td class="fw-bold">{{ $msg->name }}</td>
                        <td><a href="mailto:{{ $msg->email }}" class="text-decoration-none">{{ $msg->email }}</a></td>
                        <td>{{ $msg->phone ?? 'N/A' }}</td>
                        <td><span class="badge bg-info-subtle text-info fw-semibold">{{ $msg->subject ?? 'Inquiry' }}</span></td>
                        <td>
                            <button type="button" class="btn btn-xs {{ $msg->status === 'Pending' ? 'btn-outline-primary fw-bold' : 'btn-outline-secondary' }} btn-read-msg" 
                                    data-id="{{ $msg->id }}" 
                                    data-pending="{{ $msg->status === 'Pending' ? '1' : '0' }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#msgModal{{ $msg->id }}">
                                <i class="ti {{ $msg->status === 'Pending' ? 'ti-mail' : 'ti-mail-opened' }} me-1"></i> Read Message
                            </button>

                            <!-- Read Message Modal -->
                            <div class="modal fade" id="msgModal{{ $msg->id }}" tabindex="-1" aria-labelledby="msgModalLabel{{ $msg->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 14px;">
                                        <div class="modal-header border-0 pb-0">
                                            <h5 class="modal-title fw-bold" id="msgModalLabel{{ $msg->id }}">Message Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="text-muted small uppercase fw-bold mb-1 d-block">From</label>
                                                <div class="fw-semibold fs-15">{{ $msg->name }} ({{ $msg->email }})</div>
                                                <div class="text-muted small">Phone: {{ $msg->phone ?? 'N/A' }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-muted small uppercase fw-bold mb-1 d-block">Subject</label>
                                                <div class="fw-bold text-primary">{{ $msg->subject ?? 'Inquiry' }}</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-muted small uppercase fw-bold mb-1 d-block">Message</label>
                                                <div class="p-3 bg-light rounded text-dark" style="white-space: pre-wrap; font-size: 14px; line-height: 1.5;">{{ $msg->message }}</div>
                                            </div>
                                            <div class="text-muted small text-end">
                                                Received at: {{ $msg->created_at->format('d M Y, h:i A') }}
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 pt-0">
                                            <a href="mailto:{{ $msg->email }}?subject=RE: {{ rawurlencode($msg->subject ?? 'Inquiry') }}" class="btn btn-primary btn-sm rounded-pill px-3"><i class="ti ti-arrow-back me-1"></i> Reply via Email</a>
                                            <button type="button" class="btn btn-light btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.contact_messages.delete', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger-subtle text-danger" title="Delete Inquiry"><i class="ti ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="ti ti-mail-forward text-muted mb-3" style="font-size: 3rem; display: block;"></i>
                            <h5 class="text-muted">No messages received yet.</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const readButtons = document.querySelectorAll('.btn-read-msg');
    readButtons.forEach(button => {
        button.addEventListener('click', function() {
            const msgId = this.getAttribute('data-id');
            const isPending = this.getAttribute('data-pending') === '1';
            
            if (isPending) {
                const btn = this;
                const row = document.getElementById('msg-row-' + msgId);
                
                fetch(`/admin/contact-messages/read/${msgId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mark row as read
                        if (row) {
                            row.classList.remove('table-warning-subtle', 'fw-semibold');
                        }
                        
                        // Update button style and icon
                        btn.setAttribute('data-pending', '0');
                        btn.className = 'btn btn-xs btn-outline-secondary btn-read-msg';
                        btn.innerHTML = '<i class="ti ti-mail-opened me-1"></i> Read Message';
                        
                        // Decrement the sidebar badge counter dynamically
                        const badge = document.querySelector('.side-nav-item a[href*="contact-messages"] .badge');
                        if (badge) {
                            let count = parseInt(badge.textContent);
                            if (count > 1) {
                                badge.textContent = count - 1;
                            } else {
                                badge.remove();
                            }
                        }
                    }
                })
                .catch(error => console.error('Error marking message as read:', error));
            }
        });
    });
});
</script>
@endsection
