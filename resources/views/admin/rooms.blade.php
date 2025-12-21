@extends('admin.app')

@section('title', 'Rooms')
@section('page-title', 'Rooms')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Rooms</h3>
    </div>
    <div class="add_button" style="text-align: end;">
        <button class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#addRoomModal">Add Room Category</button>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Room Name</th>
                    <th style="padding: 15px 20px;">Description</th>
                    <th style="padding: 15px 20px;">Base Price</th>

                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody id="roomsTable">
                @foreach ($room_types as $room)


                <tr id="roomRow{{$room->id}}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{$loop->index+1}}</td>
                    <td style="padding: 15px 20px;">{{$room->name}}</td>
                    <td style="padding: 15px 20px;">{{$room->description}}</td>
                    <td style="padding: 15px 20px;">
                        <span style="padding: 5px 10px;">{{$room->base_price}}</span>
                    </td>

                    <td style="padding: 15px 20px;">
                        <a href="#" class="btn btn-primary editRoomBtn"
                            data-id="{{$room->id}}"
                            data-name="{{$room->name}}"
                            data-price="{{$room->base_price}}"
                            data-description="{{$room->description}}"
                            data-bs-toggle="modal"
                            data-bs-target="#EditRoom{{$room->id}}">
                            Edit
                        </a>
                        <a href="#" class="btn btn-danger deleteRoomBtn" data-id="{{$room->id}}">Delete</a>

                        <!-- edit modal -->
                        <div class="modal fade" id="EditRoom{{$room->id}}" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content"
                                    style="border-radius:18px; border:0; box-shadow:0 10px 40px rgba(0,0,0,0.15);">

                                    <!-- Header -->
                                    <div class="modal-header text-white"
                                        style="background-color:darkgray; 
                                       border-top-left-radius:18px; border-top-right-radius:18px;">
                                        <h5 class="modal-title fw-bold" id="addRoomModalLabel">🛏️ Edit Room Type</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body p-4" style="background:#f8f9fc;">
                                        <form id="editRoomForm{{$room->id}}" class="editRoomForm" action="{{ route('rooms.update', $room->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Room Name -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Room Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    style="border-radius:10px;"
                                                    id="editName{{$room->id}}" name="roomName"
                                                    placeholder="Enter the room type" maxlength="100" value="{{$room->name}}">
                                            </div>
                                            <!-- Base Price -->
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Base Price (Per Night) <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" style="border-radius:10px 0 0 10px;">$</span>
                                                    <input type="number" class="form-control"
                                                        style="border-radius:0 10px 10px 0;"
                                                        id="editPrice{{$room->id}}" name="basePrice" value="{{$room->base_price}}"
                                                        placeholder="120.00" step="0.01" min="0.01">
                                                </div>
                                                <small class="text-muted">Enter the minimum price before taxes and promotions.</small>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-0">
                                                <label class="form-label fw-semibold">Description</label>
                                                <textarea class="form-control"
                                                    style="border-radius:10px;"
                                                    id="editDescription{{$room->id}}" name="description"
                                                    rows="3"
                                                    placeholder="A brief summary of the room's features and amenities..."
                                                    maxlength="500">{{$room->description}}</textarea>
                                                <small class="text-muted">Highlight key features (e.g., 'Ocean view', 'King bed').</small>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer" style="background:#f1f3f6; border-bottom-left-radius:18px; border-bottom-right-radius:18px;">
                                        <button type="button" class="btn btn-light px-4"
                                            style="border-radius:10px; border:1px solid #d0d0d0;"
                                            data-bs-dismiss="modal">Cancel</button>

                                        <button type="submit" form="editRoomForm{{$room->id}}"
                                            class="btn btn-success px-4" style="border-radius:10px;">
                                            Update Room
                                        </button>

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
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="addRoomForm" action="{{ route('rooms.store') }}" method="POST">
                    @csrf

                    <!-- Room Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Room Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" 
                               id="roomName" name="roomName" 
                               placeholder="Enter the room name" maxlength="100" required>
                        <small class="text-muted">A unique, descriptive name for the room.</small>
                    </div>

                    <!-- Base Price -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Base Price (Per Night) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" 
                                   id="basePrice" name="basePrice" 
                                   placeholder="120.00" step="0.01" min="0.01" required>
                        </div>
                        <small class="text-muted">Enter the minimum price before taxes and promotions.</small>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" 
                                  id="description" name="description" 
                                  rows="3" placeholder="A brief summary of the room's features..." maxlength="500"></textarea>
                        <small class="text-muted">Highlight key features (e.g., 'Ocean view', 'King bed').</small>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="modal-footer" style="background:#f1f3f6; border-bottom-left-radius:18px; border-bottom-right-radius:18px;">
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
                url: "{{ route('rooms.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                success: function(response) {
                    let room = response.room;
                    let editRoute = "{{ route('rooms.update', ':id') }}".replace(':id', room.id);

                    let row = `
                    <tr id="roomRow${room.id}" style="border-bottom: 1px solid #dddddd;">
                        <td style="padding: 15px 20px;">#</td>
                        <td style="padding: 15px 20px;">${room.name}</td>
                        <td style="padding: 15px 20px;">${room.description ? room.description : ''}</td>
                        <td style="padding: 15px 20px;">
                            <span style="padding: 5px 10px;">${room.base_price}</span>
                        </td>
                        <td style="padding: 15px 20px;">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditRoom${room.id}">Edit</a>
                            <a href="#" class="btn btn-danger deleteRoomBtn" data-id="${room.id}">Delete</a>

                            <!-- edit modal -->
                            <div class="modal fade" id="EditRoom${room.id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius:18px;">
                                        <div class="modal-header text-white" style="background-color:darkgray;">
                                            <h5 class="modal-title fw-bold">🛏️ Edit Room Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <form id="editRoomForm${room.id}" class="editRoomForm" action="${editRoute}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Room Name</label>
                                                    <input type="text" class="form-control" name="roomName" value="${room.name}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Base Price</label>
                                                    <input type="number" class="form-control" name="basePrice" value="${room.base_price}" step="0.01" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea class="form-control" name="description" rows="3">${room.description || ''}</textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" form="editRoomForm${room.id}" class="btn btn-success">Update Room</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            method: "POST",
            data: formData,
            success: function(response) {

                // UPDATE TABLE ROW WITHOUT RELOAD
                $("#roomRow" + roomId + " td:nth-child(2)").text(response.name);
                $("#roomRow" + roomId + " td:nth-child(3)").text(response.description);
                $("#roomRow" + roomId + " td:nth-child(4) span").text(response.base_price);

                // CLOSE MODAL
                $("#EditRoom" + roomId).modal('hide');

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
                    url: '/rooms/' + roomId,
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