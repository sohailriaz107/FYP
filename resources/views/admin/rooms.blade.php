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
                    <th style="padding: 15px 20px;">Beds</th>
                    <th style="padding: 15px 20px;">Room Size</th>
                    <th style="padding: 15px 20px;">Max Persons</th>
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
                    <td style="padding: 15px 20px;">{{$room->beds}}</td>
                    <td style="padding: 15px 20px;">{{$room->room_size}}</td>
                    <td style="padding: 15px 20px;">{{$room->max_persons}}</td>

                    <td style="padding: 15px 20px; ">
                        <a href="#" class="btn btn-primary editRoomBtn" style="margin-bottom:10px;"
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
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2); overflow: hidden;">

                                    <!-- Header -->
                                    <div class="modal-header text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 25px;">
                                        <h5 class="modal-title fw-bold" id="addRoomModalLabel">
                                            <i class="bi bi-pencil-square me-2"></i> Edit Room Category
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body p-5" style="background: #ffffff;">
                                        <form id="editRoomForm{{$room->id}}" class="editRoomForm" action="{{ route('rooms.update', $room->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="row">
                                                <!-- Room Name -->
                                                <div class="col-md-12 mb-4">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Category Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-tag-fill text-muted"></i></span>
                                                        <input type="text" class="form-control border-0 bg-light py-3" 
                                                            style="border-radius: 0 12px 12px 0; font-size: 1rem;"
                                                            id="editName{{$room->id}}" name="roomName" 
                                                            placeholder="e.g. Deluxe Ocean Suite" maxlength="100" value="{{$room->name}}" required>
                                                    </div>
                                                </div>

                                                <!-- Base Price -->
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Base Price (Per Night) <span class="text-danger">*</span></label>
                                                    <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                                        <span class="input-group-text bg-dark text-white border-0">$</span>
                                                        <input type="number" class="form-control border-0 bg-light py-3" 
                                                            id="editPrice{{$room->id}}" name="basePrice" value="{{$room->base_price}}"
                                                            placeholder="0.00" step="0.01" min="0.01" required>
                                                    </div>
                                                </div>

                                                <!-- Room Size -->
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Size <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-arrows-fullscreen text-muted"></i></span>
                                                        <input type="text" class="form-control border-0 bg-light py-3" 
                                                            style="border-radius: 0 12px 12px 0;"
                                                            name="room_size" placeholder="e.g. 450 sq ft" value="{{$room->room_size}}" required>
                                                    </div>
                                                </div>

                                                <!-- Beds -->
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Total Beds <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-door-open-fill text-muted"></i></span>
                                                        <input type="text" class="form-control border-0 bg-light py-3" 
                                                            style="border-radius: 0 12px 12px 0;"
                                                            name="beds" placeholder="e.g. 2 King Size" value="{{$room->beds}}" required>
                                                    </div>
                                                </div>

                                                <!-- Max Persons -->
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Max Guests <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-people-fill text-muted"></i></span>
                                                        <input type="number" class="form-control border-0 bg-light py-3" 
                                                            style="border-radius: 0 12px 12px 0;"
                                                            name="max_person" placeholder="e.g. 4" value="{{$room->max_persons}}" required>
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-md-12 mb-0">
                                                    <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Description</label>
                                                    <textarea class="form-control border-0 bg-light p-3" 
                                                        style="border-radius: 12px; font-size: 0.95rem;"
                                                        id="editDescription{{$room->id}}" name="description" 
                                                        rows="4" 
                                                        placeholder="Describe the unique features and luxury amenities of this room category..."
                                                        maxlength="500">{{$room->description}}</textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer p-4" style="background: #f8f9fa; border: none;">
                                        <button type="button" class="btn btn-link text-decoration-none text-muted fw-bold px-4" data-bs-dismiss="modal">Discard Changes</button>
                                        <button type="submit" form="editRoomForm{{$room->id}}" 
                                            class="btn btn-primary px-5 py-2 fw-bold" 
                                            style="border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);">
                                            Update Category
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
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2); overflow: hidden;">

                <!-- Header -->
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; padding: 25px;">
                    <h5 class="modal-title fw-bold" id="addRoomModalLabel">
                        <i class="bi bi-plus-circle-fill me-2"></i> Add New Room Category
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-5" style="background: #ffffff;">
                    <form id="addRoomForm" action="{{ route('rooms.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Room Name -->
                            <div class="col-md-12 mb-4">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Category Name <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-tag-fill text-muted"></i></span>
                                    <input type="text" class="form-control border-0 bg-light py-3" 
                                        id="roomName" name="roomName" 
                                        placeholder="e.g. Luxury Penthouse" maxlength="100" required>
                                </div>
                            </div>

                            <!-- Base Price -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Base Price (Per Night) <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <span class="input-group-text bg-dark text-white border-0">$</span>
                                    <input type="number" class="form-control border-0 bg-light py-3" 
                                        id="basePrice" name="basePrice" 
                                        placeholder="0.00" step="0.01" min="0.01" required>
                                </div>
                                <small class="text-muted mt-1 d-block">Starting price before additional services.</small>
                            </div>

                            <!-- Room Size -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Size <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-arrows-fullscreen text-muted"></i></span>
                                    <input type="text" class="form-control border-0 bg-light py-3" 
                                        id="addRoomSize" name="room_size" 
                                        placeholder="e.g. 350 sq ft" maxlength="100" required>
                                </div>
                            </div>

                            <!-- Beds -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Total Beds <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-door-open-fill text-muted"></i></span>
                                    <input type="text" class="form-control border-0 bg-light py-3" 
                                        id="beds" name="beds" 
                                        placeholder="e.g. 1 King, 1 Queen" required>
                                </div>
                            </div>

                            <!-- Max Persons -->
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Max Guests <span class="text-danger">*</span></label>
                                <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <span class="input-group-text bg-light border-0"><i class="bi bi-people-fill text-muted"></i></span>
                                    <input type="number" class="form-control border-0 bg-light py-3" 
                                        id="maxPerson" name="max_person" 
                                        placeholder="e.g. 2" required>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-0">
                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Category Description</label>
                                <textarea class="form-control border-0 bg-light p-3" 
                                    style="border-radius: 12px; font-size: 0.95rem;"
                                    id="description" name="description" 
                                    rows="4" 
                                    placeholder="Provide a compelling description of what makes this room category special..."></textarea>
                                <small class="text-muted mt-1 d-block">Max 500 characters. Visible to guests during booking.</small>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer p-4" style="background: #f8f9fa; border: none;">
                    <button type="button" class="btn btn-link text-decoration-none text-muted fw-bold px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addRoomForm" 
                        class="btn btn-success px-5 py-2 fw-bold" 
                        style="border-radius: 12px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none; box-shadow: 0 4px 15px rgba(56, 239, 125, 0.3);">
                        Create Category
                    </button>
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
                        <td style="padding: 15px 20px;">${room.beds}</td>
                        <td style="padding: 15px 20px;">${room.room_size}</td>
                        <td style="padding: 15px 20px;">${room.max_persons}</td>
                        <td style="padding: 15px 20px;">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditRoom${room.id}">Edit</a>
                            <a href="#" class="btn btn-danger deleteRoomBtn" data-id="${room.id}">Delete</a>

                            <!-- edit modal -->
                            <div class="modal fade" id="EditRoom${room.id}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 50px rgba(0,0,0,0.2); overflow: hidden;">
                                        <div class="modal-header text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 25px;">
                                            <h5 class="modal-title fw-bold">
                                                <i class="bi bi-pencil-square me-2"></i> Edit Room Category
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-5">
                                            <form id="editRoomForm${room.id}" class="editRoomForm" action="${editRoute}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Category Name</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-0"><i class="bi bi-tag-fill text-muted"></i></span>
                                                            <input type="text" class="form-control border-0 bg-light py-3" name="roomName" value="${room.name}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Base Price</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-dark text-white border-0">$</span>
                                                            <input type="number" class="form-control border-0 bg-light py-3" name="basePrice" value="${room.base_price}" step="0.01" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Room Size</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-0"><i class="bi bi-arrows-fullscreen text-muted"></i></span>
                                                            <input type="text" class="form-control border-0 bg-light py-3" name="room_size" value="${room.room_size}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Beds</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-0"><i class="bi bi-door-open-fill text-muted"></i></span>
                                                            <input type="text" class="form-control border-0 bg-light py-3" name="beds" value="${room.beds}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Max Persons</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-0"><i class="bi bi-people-fill text-muted"></i></span>
                                                            <input type="number" class="form-control border-0 bg-light py-3" name="max_person" value="${room.max_persons}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Description</label>
                                                        <textarea class="form-control border-0 bg-light p-3" name="description" rows="4">${room.description || ''}</textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer p-4" style="background: #f8f9fa; border: none;">
                                            <button type="button" class="btn btn-link text-decoration-none text-muted fw-bold" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" form="editRoomForm${room.id}" class="btn btn-primary px-5 py-2 fw-bold" style="border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">Update Category</button>
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
                $("#roomRow" + roomId + " td:nth-child(5)").text(response.beds);
                $("#roomRow" + roomId + " td:nth-child(6)").text(response.room_size);
                $("#roomRow" + roomId + " td:nth-child(7)").text(response.max_persons);

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