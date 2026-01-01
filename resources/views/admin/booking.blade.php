@extends('admin.app')

@section('title', 'Booking')
@section('page-title', 'Booking')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Booking</h3>
    </div>
 

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Guest Name</th>
                    <th style="padding: 15px 20px;">RoomType</th>
                    <th style="padding: 15px 20px;">Room NO</th>
                    <th style="padding: 15px 20px;">Check_IN</th>
                    <th style="padding: 15px 20px;">Check_Out</th>
                    <th style="padding: 15px 20px;">Nights</th>
                    <th style="padding: 15px 20px;">Total Price</th>
                     <th style="padding: 15px 20px;">Status</th>
                      <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody id="bookingTable">
                @foreach($bookings as $booking)
                <tr id="bookingRow{{ $booking->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->Guest }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->RoomType }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->RoomNo }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->Check_in }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->Check_out }}</td>
                    <td style="padding: 15px 20px;">{{ $booking->night }}</td>
                    <td style="padding: 15px 20px;">${{ $booking->total_price }}</td>
                    <td style="padding: 15px 20px;">
                        <select class="form-select statusSelect" data-id="{{ $booking->id }}" 
                            style="padding: 5px; border-radius: 5px; border: 1px solid #ccc; 
                            background-color: {{ $booking->status == 'booked' ? '#d1e7dd' : ($booking->status == 'cancelled' ? '#f8d7da' : '#fff3cd') }}">
                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="booked" {{ $booking->status == 'booked' ? 'selected' : '' }}>Booked</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td style="padding: 15px 20px;">
                        <button class="btn btn-danger deleteBookingBtn" data-id="{{ $booking->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery must be loaded first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Status Change logic
        $(document).on('change', '.statusSelect', function() {
            let status = $(this).val();
            let bookingId = $(this).data('id');
            let $select = $(this);

            $.ajax({
                url: "{{ url('/booking/status') }}/" + bookingId,
                type: "POST", // Using POST with _method spoofing
                data: {
                    _method: "PUT",
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (status === 'booked') {
                        $select.css('background-color', '#d1e7dd');
                    } else if (status === 'cancelled') {
                        $select.css('background-color', '#f8d7da');
                    } else {
                        $select.css('background-color', '#fff3cd');
                    }

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
                    console.log(xhr.responseText);
                    let msg = "Something went wrong!";
                    if (xhr.status === 405) msg = "Method not allowed. Check your routes.";
                    if (xhr.status === 419) msg = "CSRF token expired. Please refresh.";
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });
                }
            });
        });

        // Delete Booking logic
        $(document).on('click', '.deleteBookingBtn', function() {
            let bookingId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This booking will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/booking/delete') }}/" + bookingId,
                        type: "POST", // Using POST with _method spoofing
                        data: {
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $("#bookingRow" + bookingId).remove();
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
                            console.log(xhr.responseText);
                            let msg = "Something went wrong!";
                            if (xhr.status === 405) msg = "Method not allowed. Check your routes.";
                            if (xhr.status === 419) msg = "CSRF token expired. Please refresh.";
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg
                            });
                        }
                    });
                }
            });
        });
    });
</script>

@endsection