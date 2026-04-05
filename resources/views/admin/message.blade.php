@extends('admin.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Contact Messages</h3>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Name</th>
                    <th style="padding: 15px 20px;">Email</th>
                    <th style="padding: 15px 20px;">Subject</th>
                    <th style="padding: 15px 20px;">Message</th>
                    <th style="padding: 15px 20px;">Date</th>
                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody id="messagesTable">
                @foreach ($messages as $message)
                <tr id="messageRow{{ $message->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px 20px;">{{ $message->name }}</td>
                    <td style="padding: 15px 20px;">{{ $message->email }}</td>
                    <td style="padding: 15px 20px;">{{ $message->subject }}</td>
                    <td style="padding: 15px 20px;">
                        <div style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $message->message }}">
                            {{ $message->message }}
                        </div>
                    </td>
                    <td style="padding: 15px 20px;">{{ $message->created_at->format('M d, Y') }}</td>
                    <td style="padding: 15px 20px;">
                        <button class="btn btn-info btn-sm aiReplyBtn" 
                                data-id="{{ $message->id }}" 
                                data-name="{{ $message->name }}" 
                                data-message="{{ $message->message }}"
                                style="margin-bottom:5px; color: white;">
                            <i class="bi bi-robot"></i> AI Reply
                        </button>
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary btn-sm" style="margin-bottom:5px;">
                            Reply
                        </a>
                        <button class="btn btn-danger btn-sm deleteMessageBtn" data-id="{{ $message->id }}" style="margin-bottom:5px;">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                @if($messages->isEmpty())
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center;">No messages found.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- AI Reply Modal -->
<div class="modal fade" id="aiReplyModal" tabindex="-1" aria-labelledby="aiReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009879; color: white;">
                <h5 class="modal-title" id="aiReplyModalLabel"><i class="bi bi-robot"></i> AI Assisted Reply</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Original Message from <span id="modalGuestName"></span>:</label>
                    <div id="modalGuestMessage" class="p-3 bg-light border rounded" style="max-height: 150px; overflow-y: auto;"></div>
                </div>

                <div class="row mb-3 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Select Tone:</label>
                        <select class="form-select" id="replyTone">
                            <option value="professional and helpful">Professional & Helpful (Default)</option>
                            <option value="apologetic and formal">Apologetic (for complaints)</option>
                            <option value="enthusiastic and welcoming">Welcoming (for general inquiries)</option>
                            <option value="concise and direct">Brief & Direct</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-dark w-100" id="generateAiBtn">
                            <span class="spinner-border spinner-border-sm d-none" id="generateSpinner"></span>
                            Generate Suggestion
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Suggested AI Reply (You can edit):</label>
                    <textarea class="form-control" id="aiReplyTextarea" rows="8" placeholder="AI suggestion will appear here..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="sendAiBtn" style="background-color: #009879; border-color: #009879;">
                    <span class="spinner-border spinner-border-sm d-none" id="sendSpinner"></span>
                    Send Email
                </button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let currentMsgId = null;

    // Open Modal
    $(document).on("click", ".aiReplyBtn", function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const message = $(this).data('message');

        currentMsgId = id;
        $("#modalGuestName").text(name);
        $("#modalGuestMessage").text(message);
        $("#aiReplyTextarea").val(""); // Clear previous text
        
        const modal = new bootstrap.Modal(document.getElementById('aiReplyModal'));
        modal.show();
    });

    // Generate AI Reply
    $("#generateAiBtn").click(function() {
        const tone = $("#replyTone").val();
        
        $("#generateSpinner").removeClass('d-none');
        $("#generateAiBtn").attr('disabled', true);

        $.ajax({
            url: "{{ route('admin.messages.generate-reply') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                message_id: currentMsgId,
                tone: tone
            },
            success: function(response) {
                $("#aiReplyTextarea").val(response.suggestion);
                $("#generateSpinner").addClass('d-none');
                $("#generateAiBtn").attr('disabled', false);
            },
            error: function(xhr) {
                const msg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Failed to generate AI suggestion.';
                Swal.fire('Error', msg, 'error');
                $("#generateSpinner").addClass('d-none');
                $("#generateAiBtn").attr('disabled', false);
            }
        });
    });

    // Send AI Reply
    $("#sendAiBtn").click(function() {
        const replyContent = $("#aiReplyTextarea").val();

        if (!replyContent) {
            Swal.fire('Wait!', 'Please generate or write a reply first.', 'warning');
            return;
        }

        $("#sendSpinner").removeClass('d-none');
        $("#sendAiBtn").attr('disabled', true);

        $.ajax({
            url: "{{ route('admin.messages.send-reply') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                message_id: currentMsgId,
                reply_content: replyContent
            },
            success: function(response) {
                $("#sendSpinner").addClass('d-none');
                $("#sendAiBtn").attr('disabled', false);
                
                bootstrap.Modal.getInstance(document.getElementById('aiReplyModal')).hide();

                Swal.fire({
                    icon: 'success',
                    title: 'Sent!',
                    text: response.message
                });
            },
            error: function(xhr) {
                Swal.fire('Error', 'Failed to send email. Check your mail configuration.', 'error');
                $("#sendSpinner").addClass('d-none');
                $("#sendAiBtn").attr('disabled', false);
            }
        });
    });

    // Delete Logic (Keep existing)
    $(document).on("click", ".deleteMessageBtn", function(e) {
        // ... (existing logic)
        e.preventDefault();

        let button = $(this);
        let messageId = button.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this message?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/messages/' + messageId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#messageRow" + messageId).fadeOut(400, function() {
                            $(this).remove();
                        });

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete the message.'
                        });
                    }
                });
            }
        });
    });
</script>

@endsection
