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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on("click", ".deleteMessageBtn", function(e) {
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
