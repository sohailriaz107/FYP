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
                    <th style="padding: 15px 20px;">Images</th>
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
                    <td style="padding: 15px 20px;" class="images-cell">
                        @foreach($room->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Room Image" style="width: 30px; height: 30px; object-fit: cover; border-radius: 4px; margin-right: 2px;">
                        @endforeach
                    </td>
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
                            <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                                <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); font-family: 'Inter', sans-serif;">

                                    <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 25px 30px;">
                                        <h5 class="modal-title" style="font-weight: 700; color: #2d3748; font-size: 1.4rem;">Edit Room</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body" style="padding: 30px;">
                                        <form class="editRoomForm" id="editRoomForm{{ $room->id }}" action="{{ route('rooms.listupdate', $room->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                                                <div style="flex: 1;">
                                                    <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Room No</label>
                                                    <input type="text" name="roomno" class="form-control" value="{{ $room->room_number }}" style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0;" required>
                                                </div>
                                                <div style="flex: 1;">
                                                    <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Room Type</label>
                                                    <select name="roomtype" class="form-select" required style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0; height: auto;">
                                                        @foreach($roomTypes as $type)
                                                        <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Status</label>
                                                <select name="status" class="form-select" required style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0; height: auto;">
                                                    <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                                    <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 12px; display: block;">Amenities</label>
                                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 12px;">
                                                    @foreach($amenities as $amenity)
                                                    @php $isChecked = $room->amenities->contains($amenity->id); @endphp
                                                    <div style="position: relative;">
                                                        <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                                            id="edit_amenity{{ $room->id }}{{ $amenity->id }}"
                                                            onchange="toggleAmenityStyle(this)"
                                                            {{ $isChecked ? 'checked' : '' }}
                                                            style="position: absolute; opacity: 0; width: 100%; height: 100%; cursor: pointer; z-index: 2;">

                                                        <label for="edit_amenity{{ $room->id }}{{ $amenity->id }}"
                                                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 15px 10px; border: 2px solid {{ $isChecked ? '#3f51b5' : '#e2e8f0' }}; border-radius: 12px; background: {{ $isChecked ? '#f0f4ff' : '#fff' }}; width: 100%; text-align: center; gap: 8px; transition: all 0.2s;">
                                                            <i class="{{ $amenity->icon }}" style="font-size: 1.5rem; color: {{ $isChecked ? '#3f51b5' : '#718096' }};"></i>
                                                            <span style="font-size: 0.85rem; font-weight: 500; color: {{ $isChecked ? '#3f51b5' : '#4a5568' }};">{{ $amenity->name }}</span>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Existing Images</label>
                                                <div id="existing-images-container-{{ $room->id }}" style="display: flex; flex-wrap: wrap; gap: 12px;">
                                                    @foreach($room->images as $image)
                                                    <div id="image-wrapper-{{ $image->id }}" style="position: relative; width: 80px; height: 80px;">
                                                        <img src="{{ asset('storage/' . $image->image_path) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; border: 1px solid #e2e8f0;">
                                                        <button type="button" onclick="markImageForDeletion('{{ $image->id }}', '{{ $room->id }}')"
                                                            style="position: absolute; top: -5px; right: -5px; background: #ff4d4d; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); z-index: 4;">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                        <input type="hidden" name="deleted_images[]" id="delete-input-{{ $image->id }}" value="" disabled>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Add More Images</label>
                                                <div style="border: 2px dashed #cbd5e0; border-radius: 15px; padding: 25px; text-align: center; background: #f7fafc; position: relative;">
                                                    <input type="file" name="images[]" onchange="previewEditImages(event, '{{ $room->id }}')" multiple style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 3;">
                                                    <i class="fa-solid fa-plus-circle" style="font-size: 1.5rem; color: #4299e1; margin-bottom: 5px;"></i>
                                                    <p style="margin: 0; font-size: 0.85rem; font-weight: 600; color: #4a5568;">Upload New Photos</p>
                                                </div>
                                                <div id="editImagePreview{{ $room->id }}" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px;"></div>
                                            </div>

                                            <div class="modal-footer" style="padding: 20px 0 0 0; border-top: none; display: flex; justify-content: flex-end; gap: 12px;">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 12px; padding: 12px 30px; font-weight: 600;">Cancel</button>
                                                <button type="submit" class="btn btn-primary" style="border-radius: 12px; background: #3f51b5; border: none; padding: 12px 30px; font-weight: 600;">Update Room</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            // 1. Handle Amenity Selection Colors
                            function toggleAmenityStyle(checkbox) {
                                const label = checkbox.nextElementSibling;
                                const icon = label.querySelector('i');
                                const text = label.querySelector('span');

                                if (checkbox.checked) {
                                    label.style.borderColor = '#3f51b5';
                                    label.style.backgroundColor = '#f0f4ff';
                                    icon.style.color = '#3f51b5';
                                    text.style.color = '#3f51b5';
                                    text.style.fontWeight = '700';
                                } else {
                                    label.style.borderColor = '#e2e8f0';
                                    label.style.backgroundColor = '#fff';
                                    icon.style.color = '#718096';
                                    text.style.color = '#4a5568';
                                    text.style.fontWeight = '500';
                                }
                            }

                            // 2. Mark Existing Image for Deletion
                            function markImageForDeletion(imageId, roomId) {
                                if (confirm('Are you sure you want to remove this image?')) {
                                    const wrapper = document.getElementById('image-wrapper-' + imageId);
                                    const input = document.getElementById('delete-input-' + imageId);

                                    wrapper.style.display = 'none'; // Hide from view
                                    input.value = imageId; // Set ID value
                                    input.disabled = false; // Enable so it sends to server
                                }
                            }

                            // 3. Preview New Uploads
                            function previewEditImages(event, roomId) {
                                const container = document.getElementById('editImagePreview' + roomId);
                                container.innerHTML = '';
                                const files = event.target.files;
                                Array.from(files).forEach(file => {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.style.width = '70px';
                                        img.style.height = '70px';
                                        img.style.objectFit = 'cover';
                                        img.style.borderRadius = '8px';
                                        img.style.border = '2px solid #3f51b5';
                                        container.appendChild(img);
                                    }
                                    reader.readAsDataURL(file);
                                });
                            }
                        </script>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- pop-up for adding rooms -->
    <div class="modal fade" id="addRoomModal" tabindex="-1" aria-hidden="true">
        <style>
            /* Modern Amenity Selection Logic */
            .amenity-card-input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .amenity-card-label {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 15px 10px;
                border: 2px solid #e2e8f0;
                border-radius: 12px;
                transition: all 0.2s ease;
                background: #fff;
                width: 100%;
                cursor: pointer;
                gap: 8px;
            }

            /* When Checked: Change to Blue theme like screenshot */
            .amenity-card-input:checked+.amenity-card-label {
                border-color: #3f51b5;
                background-color: #f0f4ff;
            }

            .amenity-card-input:checked+.amenity-card-label i,
            .amenity-card-input:checked+.amenity-card-label span {
                color: #3f51b5 !important;
                font-weight: 700;
            }

            /* Image Preview Grid */
            #imagePreviewContainer {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 10px;
                margin-top: 15px;
            }

            .preview-img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                border-radius: 8px;
                border: 2px solid #3f51b5;
            }
        </style>

        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.1); font-family: 'Inter', sans-serif;">

                <div class="modal-header" style="border-bottom: 1px solid #f0f0f0; padding: 25px 30px;">
                    <h5 class="modal-title" style="font-weight: 700; color: #2d3748; font-size: 1.4rem;">Add New Room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="padding: 30px;">
                    <form id="addRoomForm" action="{{route('rooms.liststore')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Room No<span class="text-danger">*</span></label>
                                <input type="number" name="roomno" class="form-control" style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0;" required placeholder="101">
                            </div>
                            <div style="flex: 1;">
                                <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Room Types<span class="text-danger">*</span></label>
                                <select name="roomtype" class="form-select" required style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0; height: auto;">
                                    <option value="" selected disabled>Select Type</option>
                                    @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Current Status<span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required style="border-radius: 10px; padding: 12px; border: 1px solid #e2e8f0; height: auto;">
                                <option value="" selected disabled>Select Status</option>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label style="font-weight: 600; color: #4a5568; margin-bottom: 12px; display: block;">Select Amenities<span class="text-danger">*</span></label>
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 12px;">
                                @foreach($amenities as $amenity)
                                <div style="position: relative;">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}" id="amenity{{ $amenity->id }}" class="amenity-card-input">
                                    <label for="amenity{{ $amenity->id }}" class="amenity-card-label">
                                        <i class="{{ $amenity->icon }}" style="font-size: 1.5rem; color: #718096;"></i>
                                        <span style="font-size: 0.85rem; color: #4a5568;">{{ $amenity->name }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label style="font-weight: 600; color: #4a5568; margin-bottom: 8px; display: block;">Room Images</label>
                            <div style="border: 2px dashed #cbd5e0; border-radius: 15px; padding: 30px; text-align: center; background: #f7fafc; position: relative; cursor: pointer;">
                                <input type="file" name="images[]" id="roomImagesInput" multiple style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 3;">
                                <div style="pointer-events: none;">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2rem; color: #4299e1; margin-bottom: 10px;"></i>
                                    <p style="margin: 0; font-weight: 600; color: #4a5568;">Click to browse or drag and drop</p>
                                </div>
                            </div>
                            <div id="imagePreviewContainer"></div>
                        </div>

                        <div class="modal-footer" style="padding: 20px 0 0 0; border-top: none; display: flex; justify-content: flex-end; gap: 12px;">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 12px; padding: 12px 30px; font-weight: 600; background: #fff; border: 1px solid #e2e8f0;">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="border-radius: 12px; background: #3f51b5; border: none; padding: 12px 30px; font-weight: 600; box-shadow: 0 4px 10px rgba(63, 81, 181, 0.2);">Save Room</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('roomImagesInput').addEventListener('change', function(event) {
                const container = document.getElementById('imagePreviewContainer');
                container.innerHTML = '';

                const files = event.target.files;
                if (files) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('preview-img');
                            container.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        </script>
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

                    let imagesHtml = '';
                    if (room.images && room.images.length > 0) {
                        room.images.forEach(image => {
                            imagesHtml += `<img src="{{ asset('storage') }}/${image.image_path}" alt="Room Image" style="width: 30px; height: 30px; object-fit: cover; border-radius: 4px; margin-right: 2px;">`;
                        });
                    }

                    let row = `
                    <tr id="roomRow${room.id}" style="border-bottom: 1px solid #dddddd;">
                        <td style="padding: 15px 20px;">#</td>
                        <td style="padding: 15px 20px;">${typeName}</td>
                        <td style="padding: 15px 20px;">${room.room_number}</td>
                        <td style="padding: 15px 20px;" class="images-cell">${imagesHtml}</td>
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
        let formData = new FormData(this);

        $.ajax({
            url: url,
            method: "POST", // Method spoofing will handle PUT
            data: formData,
            processData: false,
            contentType: false,
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

                let imagesHtml = '';
                if (room.images && room.images.length > 0) {
                    room.images.forEach(image => {
                        imagesHtml += `<img src="{{ asset('storage') }}/${image.image_path}" alt="Room Image" style="width: 30px; height: 30px; object-fit: cover; border-radius: 4px; margin-right: 2px;">`;
                    });
                }

                // UPDATE TABLE ROW WITHOUT RELOAD
                $("#roomRow" + roomId + " td:nth-child(2)").text(typeName);
                $("#roomRow" + roomId + " td:nth-child(3)").text(room.room_number);
                $("#roomRow" + roomId + " .images-cell").html(imagesHtml);
                $("#roomRow" + roomId + " .amenities-cell").html(amenitiesHtml);
                $("#roomRow" + roomId + " td:nth-child(6) span").text(statusText).css({
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