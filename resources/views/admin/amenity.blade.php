@extends('admin.app')

@section('title', 'Amenties')
@section('page-title', 'Amenties')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>Amenities List</h3>
    </div>
    <div class="add_button" style="text-align: end;">
        <button class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#AddAmenity">Add Amenity</button>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">Name</th>
                    <th style="padding: 15px 20px;">Icon</th>
                    <th style="padding: 15px 20px;">Status</th>
                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody id="amenitiesTable">
                @foreach($amenities as $key => $amenity)
                <tr id="amenityRow{{ $amenity->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $key + 1 }}</td>
                    <td style="padding: 15px 20px;">{{ $amenity->name }}</td>
                    <td style="padding: 15px 20px;">
                        @if($amenity->icon)
                        <img src="{{ asset('storage/' . $amenity->icon) }}" alt="icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input amenity-toggle"
                                type="checkbox"
                                data-id="{{ $amenity->id }}"
                                {{ $amenity->is_active ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td style="padding: 15px 20px;" class="d-flex gap-2 align-items-center">

                        <!-- Toggle Switch -->


                        <!-- Edit -->
                        <button class="btn btn-sm btn-primary editAmenityBtn"
                            data-id="{{ $amenity->id }}"
                            data-name="{{ $amenity->name }}"
                            data-icon="{{ asset('storage/' . $amenity->icon) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#EditAmenityModal">
                            Edit
                        </button>

                        <!-- Delete -->
                        <button class="btn btn-sm btn-danger deleteAmenityBtn"
                            data-id="{{ $amenity->id }}">
                            Delete
                        </button>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Amenity Modal -->
    <div class="modal fade" id="AddAmenity" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Add New Amenity</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAmenityForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Amenity Name <span class="text-danger">*</span></label>
                            <input type="text" name="amenity_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Amenity Icon <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="icon" accept="image/*" onchange="previewIcon(this, 'addIconPreview')" required>
                        </div>
                        <div class="mb-3">
                            <img id="addIconPreview" src="" alt="Icon Preview" style="display:none; width:80px; height:80px; object-fit:cover; border-radius:10px; border:1px solid #ddd;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save Amenity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Amenity Modal -->
    <div class="modal fade" id="EditAmenityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Edit Amenity</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAmenityForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editAmenityId">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Amenity Name <span class="text-danger">*</span></label>
                            <input type="text" name="amenity_name" id="editAmenityName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Amenity Icon</label>
                            <input type="file" class="form-control" name="icon" accept="image/*" onchange="previewIcon(this, 'editIconPreview')">
                        </div>
                        <div class="mb-3">
                            <img id="editIconPreview" src="" alt="Icon Preview" style="width:80px; height:80px; object-fit:cover; border-radius:10px; border:1px solid #ddd;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update Amenity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function previewIcon(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }

    $(document).ready(function() {
        // Add Amenity
        $('#addAmenityForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('amenties.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        let amenity = response.amenity;
                        let rowCount = $('#amenitiesTable tr').length + 1;
                        let iconUrl = "{{ asset('storage') }}/" + amenity.icon;

                        let row = `
                        <tr id="amenityRow${amenity.id}" style="border-bottom: 1px solid #dddddd;">
                            <td style="padding: 15px 20px;">${rowCount}</td>
                            <td style="padding: 15px 20px;">${amenity.name}</td>
                            <td style="padding: 15px 20px;">
                                <img src="${iconUrl}" alt="icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input amenity-toggle"
                                        type="checkbox"
                                        data-id="${amenity.id}"
                                        ${amenity.is_active ? 'checked' : ''}>
                                </div>
                            </td>
                            <td style="padding: 15px 20px;" class="d-flex gap-2 align-items-center">
                                <button class="btn btn-sm btn-primary editAmenityBtn" 
                                    data-id="${amenity.id}" 
                                    data-name="${amenity.name}" 
                                    data-icon="${iconUrl}"
                                    data-bs-toggle="modal" data-bs-target="#EditAmenityModal">Edit</button>
                                <button class="btn btn-sm btn-danger deleteAmenityBtn" data-id="${amenity.id}">Delete</button>
                            </td>
                        </tr>`;

                        $('#amenitiesTable').prepend(row);
                        
                        // Update Serial Numbers
                        $('#amenitiesTable tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                        });

                        $('#AddAmenity').modal('hide');
                        $('#addAmenityForm')[0].reset();
                        $('#addIconPreview').hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let msg = '';
                    $.each(errors, function(key, value) {
                        msg += value + '<br>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: msg
                    });
                }
            });
        });

        // Populate Edit Modal
        $(document).on('click', '.editAmenityBtn', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let icon = $(this).data('icon');

            $('#editAmenityId').val(id);
            $('#editAmenityName').val(name);
            $('#editIconPreview').attr('src', icon).show();
            $('#EditAmenityModal').modal('show');
        });

        // Update Amenity
        $('#editAmenityForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#editAmenityId').val();
            let formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: "/amenties/" + id,
                type: "POST", // Spoofing PUT via FormData
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        let amenity = response.amenity;
                        let iconUrl = "{{ asset('storage') }}/" + amenity.icon;
                        let row = $(`#amenityRow${amenity.id}`);

                        row.find('td:nth-child(2)').text(amenity.name);
                        row.find('td:nth-child(3) img').attr('src', iconUrl);

                        // Update data attributes on edit button
                        let editBtn = row.find('.editAmenityBtn');
                        editBtn.data('name', amenity.name);
                        editBtn.data('icon', iconUrl);

                        $('#EditAmenityModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
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

        // Delete Amenity
        $(document).on('click', '.deleteAmenityBtn', function() {
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
                        url: "/amenties/" + id,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $(`#amenityRow${id}`).remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).on('change', '.amenity-toggle', function() {
        let amenityId = $(this).data('id');

        $.ajax({
            url: "{{ route('amenities.toggle') }}",
            type: "POST",
            data: {
                id: amenityId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });
</script>

@endsection