@extends('admin.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('content')

<div class="" id="dashboard">
    <div class="dashboard" style="background-color: white;padding:10px;border-radius:10px;margin-bottom:10px;text-align:center">
        <h3>User Testimonials</h3>
    </div>

    <div style="margin: 25px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: auto; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <table style="border-collapse: collapse; width: 100%; background-color: #ffffff; text-align: left;">
            <thead>
                <tr style="background-color: #009879; color: #ffffff; text-align: left;">
                    <th style="padding: 15px 20px;">SR</th>
                    <th style="padding: 15px 20px;">User Name</th>
                    <th style="padding: 15px 20px;">Room Number</th>
                    <th style="padding: 15px 20px;">Message</th>
                    <th style="padding: 15px 20px;">Rating</th>
                    <th style="padding: 15px 20px;">Date</th>
                    <th style="padding: 15px 20px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                <tr id="reviewRow{{ $review->id }}" style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 15px 20px;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px 20px;">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ $review->user->image ? asset($review->user->image) : 'https://via.placeholder.com/35' }}" 
                                 style="width: 35px; height: 35px; border-radius: 50%; margin-right: 10px; object-fit: cover;">
                            {{ $review->user->name }}
                        </div>
                    </td>
                    <td style="padding: 15px 20px;">{{ $review->room->room_number ?? 'N/A' }}</td>
                    <td style="padding: 15px 20px; max-width: 300px;" class="review-message">{{ $review->message }}</td>
                    <td style="padding: 15px 20px;">
                        <div style="color: gold;" class="review-rating" data-rating="{{ $review->rating }}">
                            @for($i=1; $i<=5; $i++)
                                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                        </div>
                    </td>
                    <td style="padding: 15px 20px;">{{ $review->created_at->format('M d, Y') }}</td>
                    <td style="padding: 15px 20px;">
                        <button class="btn btn-primary btn-sm editTestimonialBtn" 
                                data-id="{{ $review->id }}" 
                                data-message="{{ $review->message }}" 
                                data-rating="{{ $review->rating }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editTestimonialModal">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-sm deleteTestimonialBtn" 
                                data-id="{{ $review->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center;">No testimonials found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editTestimonialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTestimonialForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_testimonial_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <select name="rating" id="edit_testimonial_rating" class="form-select">
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" id="edit_testimonial_message" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Testimonial</button>
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
        $(document).on('click', '.editTestimonialBtn', function() {
            let id = $(this).data('id');
            let message = $(this).data('message');
            let rating = $(this).data('rating');

            $('#edit_testimonial_id').val(id);
            $('#edit_testimonial_message').val(message);
            $('#edit_testimonial_rating').val(rating);
        });

        // Submit Edit Form
        $('#editTestimonialForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#edit_testimonial_id').val();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ url('admin/testimonial') }}/" + id,
                type: "PUT",
                data: formData,
                success: function(response) {
                    $('#editTestimonialModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Dynamic UI Update
                    let newRating = $('#edit_testimonial_rating').val();
                    let newMessage = $('#edit_testimonial_message').val();
                    let row = $('#reviewRow' + id);

                    // Update message
                    row.find('.review-message').text(newMessage);

                    // Update stars
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        starsHtml += `<i class="bi ${i <= newRating ? 'bi-star-fill' : 'bi-star'}"></i> `;
                    }
                    row.find('.review-rating').html(starsHtml).attr('data-rating', newRating);

                    // Update data attributes on edit button
                    let editBtn = row.find('.editTestimonialBtn');
                    editBtn.attr('data-message', newMessage);
                    editBtn.attr('data-rating', newRating);
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

        // Delete Button Click
        $(document).on('click', '.deleteTestimonialBtn', function() {
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
                        url: "{{ url('admin/testimonial') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#reviewRow' + id).fadeOut();
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
