@extends('admin.app')

@section('title', 'Rooms')
@section('page-title', 'Rooms')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Rooms List</h3>
    </div>
    <div class="add_button" style="text-align: end;">
        <button class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#addRoomModal">Add Room</button>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Room Type</th>
                    <th style="padding: 15px 20px;">Room No</th>
                    <th style="padding: 15px 20px;">Amenities</th>
                    <th style="padding: 15px 20px;">Status</th>
                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody id="roomsTable">
                @foreach($rooms as $index => $room)
                <tr id="roomRow{{ $room->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $loop->index + 1 }}</td>
                    <td style="padding: 15px 20px;">{{ $room->roomType->name ?? 'N/A' }}</td>
                    <td style="padding: 15px 20px;">{{ $room->room_number }}</td>
                    <td style="padding: 15px 20px;" class="amenities-cell">
                        @foreach($room->amenities as $amenity)
                            <img src="{{ asset('storage/' . $amenity->icon) }}" alt="{{ $amenity->name }}" title="{{ $amenity->name }}" style="width: 25px; height: 25px; object-fit: cover; border-radius: 4px; margin-right: 2px;">
                        @endforeach
                    </td>
                    <td style="padding: 15px 20px;">
                        <span style="padding: 5px 10px; border-radius: 4px; background-color: {{ $room->status == 'available' ? '#d4edda' : ($room->status == 'occupied' ? '#f8d7da' : '#fff3cd') }}; color: {{ $room->status == 'available' ? '#155724' : ($room->status == 'occupied' ? '#721c24' : '#856404') }};">
                            {{ ucfirst($room->status) }}
                        </span>
                    </td>
                    <td style="padding: 15px 20px;">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editRoomModal{{ $room->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteRoomBtn" data-id="{{ $room->id }}">Delete</button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editRoomModal{{ $room->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title">Edit Room</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="editRoomForm" id="editRoomForm{{ $room->id }}" action="{{ route('rooms.listupdate', $room->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Room No</label>
                                                <input type="text" name="roomno" class="form-control" value="{{ $room->room_number }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Room Type</label>
                                                <select name="roomtype" class="form-control" required>
                                                    @foreach($roomTypes as $type)
                                                    <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                                    <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Select Amenites</label>
                                                <div class="row">
                                                    @foreach($amenities as $amenity)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                type="checkbox"
                                                                name="amenities[]"
                                                                value="{{ $amenity->id }}"
                                                                id="edit_amenity{{ $room->id }}{{ $amenity->id }}"
                                                                {{ $room->amenities->contains($amenity->id) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="edit_amenity{{ $room->id }}{{ $amenity->id }}">
                                                                {{ $amenity->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Update Room</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- pop-up for adding rooms -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Add New Room</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <form id="addRoomForm" action="{{route('rooms.liststore')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Room No<span class="text-danger">*</span></label>
                            <input type="number" name="roomno" class="form-control">
                        </div>
                        <!-- Room Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Room Types<span class="text-danger">*</span></label>
                            <select name="roomtype" id="" class="form-control" required>
                                <option value="" selected disabled>Select Room Type</option>
                                @foreach($roomTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- amentites -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Amenites<span class="text-danger">*</span></label>
                            @foreach($amenities as $amenity)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="amenities[]"
                                        value="{{ $amenity->id }}"
                                        id="amenity{{ $amenity->id }}">

                                    <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                        <i class="{{ $amenity->icon }}"></i>
                                        {{ $amenity->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <!-- status -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status<span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control" required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>


                        </div>

                        <!-- Footer Buttons -->
                        <div class="modal-footer" style="border-bottom-left-radius:18px; border-bottom-right-radius:18px;">
                            <button type="button" class="btn btn-light px-4" style="border-radius:10px; border:1px solid #d0d0d0;" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success px-4" style="border-radius:10px;">Save Room</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- pop-up for edit the rooms -->

</div>

<!-- jQuery must be loaded first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- add room -->
<script>
    $(document).ready(function() {
        $('#addRoomForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('rooms.liststore') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function(response) {
                    let room = response.room;
                    let typeName = room.room_type ? room.room_type.name : 'N/A';
                    let statusColor = room.status === 'available' ? '#d4edda' : (room.status === 'occupied' ? '#f8d7da' : '#fff3cd');
                    let statusTextColor = room.status === 'available' ? '#155724' : (room.status === 'occupied' ? '#721c24' : '#856404');
                    let statusText = room.status.charAt(0).toUpperCase() + room.status.slice(1);

                    let amenitiesHtml = '';
                    if (room.amenities && room.amenities.length > 0) {
                        room.amenities.forEach(amenity => {
                            amenitiesHtml += `<img src="{{ asset('storage') }}/${amenity.icon}" alt="${amenity.name}" title="${amenity.name}" style="width: 25px; height: 25px; object-fit: cover; border-radius: 4px; margin-right: 2px;">`;
                        });
                    }

                    let row = `
                    <tr id="roomRow${room.id}" style="border-bottom: 1px solid #dddddd;">
                        <td style="padding: 15px 20px;">#</td>
                        <td style="padding: 15px 20px;">${typeName}</td>
                        <td style="padding: 15px 20px;">${room.room_number}</td>
                        <td style="padding: 15px 20px;" class="amenities-cell">${amenitiesHtml}</td>
                        <td style="padding: 15px 20px;">
                            <span style="padding: 5px 10px; border-radius: 4px; background-color: ${statusColor}; color: ${statusTextColor};">
                                ${statusText}
                            </span>
                        </td>
                        <td style="padding: 15px 20px;">
                            <button class="btn btn-sm btn-primary editRoomBtn" data-id="${room.id}" data-bs-toggle="modal" data-bs-target="#editRoomModal${room.id}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteRoomBtn" data-id="${room.id}">Delete</button>
                        </td>
                    </tr>
                `;

                    $('#roomsTable').prepend(row);

                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        confirmButtonColor: "#198754"
                    });

                    $('#addRoomForm')[0].reset();
                    $('#addRoomModal').modal('hide');
                },


                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = "";
                        $.each(errors, function(key, value) {
                            errorMessage += value + "\n";
                        });

                        Swal.fire({
                            title: "Error!",
                            text: errorMessage,
                            icon: "error",
                            confirmButtonColor: "#d33"
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error",
                            confirmButtonColor: "#d33"
                        });
                    }
                }
            });
        });
    });
</script>


<!-- edit room -->
<script>
    $(document).on("submit", ".editRoomForm", function(e) {
        e.preventDefault();

        let form = $(this);
        let roomId = form.attr("id").replace("editRoomForm", "");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            url: url,
            method: "POST", // Method spoofing will handle PUT
            data: formData,
            success: function(response) {
                let room = response.room;
                let typeName = room.room_type ? room.room_type.name : 'N/A';
                let statusColor = room.status === 'available' ? '#d4edda' : (room.status === 'occupied' ? '#f8d7da' : '#fff3cd');
                let statusTextColor = room.status === 'available' ? '#155724' : (room.status === 'occupied' ? '#721c24' : '#856404');
                let statusText = room.status.charAt(0).toUpperCase() + room.status.slice(1);

                let amenitiesHtml = '';
                if (room.amenities && room.amenities.length > 0) {
                    room.amenities.forEach(amenity => {
                        amenitiesHtml += `<img src="{{ asset('storage') }}/${amenity.icon}" alt="${amenity.name}" title="${amenity.name}" style="width: 25px; height: 25px; object-fit: cover; border-radius: 4px; margin-right: 2px;">`;
                    });
                }

                // UPDATE TABLE ROW WITHOUT RELOAD
                $("#roomRow" + roomId + " td:nth-child(2)").text(typeName);
                $("#roomRow" + roomId + " td:nth-child(3)").text(room.room_number);
                $("#roomRow" + roomId + " .amenities-cell").html(amenitiesHtml);
                $("#roomRow" + roomId + " td:nth-child(5) span").text(statusText).css({
                    'background-color': statusColor,
                    'color': statusTextColor
                });

                // CLOSE MODAL
                $("#editRoomModal" + roomId).modal('hide');

                // SWEETALERT TOAST
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Room Updated Successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });

            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!'
                });
            }
        });
    });
</script>
<!-- delete -->
<script>
    $(document).on("click", ".deleteRoomBtn", function(e) {
        e.preventDefault();

        let button = $(this);
        let roomId = button.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/roomslist/' + roomId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Remove row from table
                        $("#roomRow" + roomId).remove();

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
                            text: 'Something went wrong!'
                        });
                    }
                });
            }
        });
    });
</script>

@endsection