@extends('admin.app')

@section('title', 'Guest Management')
@section('page-title', 'Guest Management')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Guest Management</h3>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Guest Name</th>
                    <th style="padding: 15px 20px;">Email</th>
                    <th style="padding: 15px 20px;">Phone</th>
                    <th style="padding: 15px 20px;">Address</th>
                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guests as $guest)
                <tr id="guestRow{{ $guest->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px 20px;">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ $guest->image ? asset($guest->image) : 'https://via.placeholder.com/35' }}" 
                                 style="width: 35px; height: 35px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                            <span class="guest-name">{{ $guest->name }}</span>
                        </div>
                    </td>
                    <td style="padding: 15px 20px;" class="guest-email">{{ $guest->email }}</td>
                    <td style="padding: 15px 20px;" class="guest-phone">{{ $guest->phone ?? 'N/A' }}</td>
                    <td style="padding: 15px 20px;" class="guest-address">{{ Str::limit($guest->address, 30) ?? 'N/A' }}</td>
                    <td style="padding: 15px 20px;">
                        <button class="btn btn-primary btn-sm editGuestBtn" 
                                data-id="{{ $guest->id }}" 
                                data-name="{{ $guest->name }}" 
                                data-email="{{ $guest->email }}"
                                data-phone="{{ $guest->phone }}"
                                data-address="{{ $guest->address }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editGuestModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm deleteGuestBtn" 
                                data-id="{{ $guest->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center;">No guests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editGuestModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Guest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editGuestForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_guest_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" id="edit_guest_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="edit_guest_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" id="edit_guest_phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" id="edit_guest_address" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Guest</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Edit Button Click
        $(document).on('click', '.editGuestBtn', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = $(this).data('address');

            $('#edit_guest_id').val(id);
            $('#edit_guest_name').val(name);
            $('#edit_guest_email').val(email);
            $('#edit_guest_phone').val(phone);
            $('#edit_guest_address').val(address);
        });

        // Submit Edit Form
        $('#editGuestForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_guest_id').val();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ url('admin/guests') }}/" + id,
                type: "PUT",
                data: formData,
                success: function(response) {
                    $('#editGuestModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Dynamic UI Update
                    let row = $('#guestRow' + id);
                    row.find('.guest-name').text($('#edit_guest_name').val());
                    row.find('.guest-email').text($('#edit_guest_email').val());
                    row.find('.guest-phone').text($('#edit_guest_phone').val() || 'N/A');
                    let addr = $('#edit_guest_address').val();
                    row.find('.guest-address').text(addr.length > 30 ? addr.substring(0, 30) + '...' : (addr || 'N/A'));

                    // Update data attributes
                    let editBtn = row.find('.editGuestBtn');
                    editBtn.data('name', $('#edit_guest_name').val());
                    editBtn.data('email', $('#edit_guest_email').val());
                    editBtn.data('phone', $('#edit_guest_phone').val());
                    editBtn.data('address', $('#edit_guest_address').val());
                },
                error: function(xhr) {
                    let errorMessage = 'Something went wrong!';
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            });
        });

        // Delete Button Click
        $(document).on('click', '.deleteGuestBtn', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('admin/guests') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#guestRow' + id).fadeOut();
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
