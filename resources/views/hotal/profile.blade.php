@extends('layout.app')
@section('title','User Profile')
@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Profile</span></p>
                    <h1 class="mb-4 bread">User Profile</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Container -->
<div style="width:1100px; margin:40px auto; background:#fff; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,0.1); display:flex; min-height: 500px;">

    <!-- Sidebar -->
    <div style="width:300px; background:linear-gradient(180deg,#b8d7e9,#c7d9ee); padding:30px; border-radius:10px 0 0 10px; color:#fff;">

        <div style="text-align:center;">
            <img class="sidebar-img" src="{{ $user->image ? asset($user->image) : 'https://via.placeholder.com/70' }}" style="width:70px; height:70px; border-radius:50%; border:3px solid #fff; object-fit: cover;">
            <h4 class="sidebar-name" style="margin-top:10px; color:#fff;">{{ $user->name }}</h4>
        </div>

        <div style="margin-top:40px;">
            <div id="tab-basic-info" class="tab-item active-tab" onclick="showSection('basic-info')" style="font-size:18px; margin:17px 0; font-weight:bold; cursor:pointer; color:#fff; padding:7px; border-radius:5px; transition: 0.3s;">
                <i class="fa fa-user"></i> Basic Information
            </div>

            <div id="tab-activity" class="tab-item" onclick="showSection('activity')" style="font-size:18px; margin:17px 0; font-weight:bold; cursor:pointer; color:#fff; padding:7px; border-radius:5px; transition: 0.3s;">
                Activity
            </div>

            <div id="tab-review" class="tab-item" onclick="showSection('review')" style="font-size:18px; margin:17px 0; font-weight:bold; cursor:pointer; color:#fff; padding:7px; border-radius:5px; transition: 0.3s;">
                Testimonial
            </div>

            <div id="tab-settings" class="tab-item" onclick="showSection('settings')" style="font-size:18px; margin:17px 0; font-weight:bold; cursor:pointer; color:#fff; padding:7px; border-radius:5px; transition: 0.3s;">
                Setting
            </div>

            <p style="font-size:22px; margin:20px 0; font-weight:bold; padding-left:10px;">
                <a href="{{route('admin.logout')}}" style="color:#fff; text-decoration:none;">Logout</a>
            </p>
        </div>
    </div>

    <style>
        .active-tab {
            background: #28a745 !important;
            color: #fff !important;
        }

        .tab-item:hover {
            background: rgba(40, 167, 69, 0.2);
        }
    </style>

    <!-- Content -->
    <div style="flex:1; padding:40px;">

        <!-- Basic Information Section -->
        <div id="basic-info-section" class="profile-section">
            <h2 style="text-align:center; margin-top:0;">User Profile</h2>
            <!-- Profile Image -->
            <div style="text-align:center; margin:30px 0;">
                <div style="position:relative; display:inline-block;">
                    <img class="basic-info-img" src="{{ $user->image ? asset($user->image) : 'https://via.placeholder.com/130' }}"
                        style="width:130px; height:130px; border-radius:50%; border:5px solid #f1f1f1; object-fit:cover; display:block;">
                </div>
            </div>

            <div style="display:flex; gap:40px;">
                <!-- Left Column -->
                <div style="flex:1;">
                    <label>Full Name</label>
                    <div class="info-name" style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd; background:#f9f9f9;">{{ $user->name }}</div>

                    <label>Email</label>
                    <div class="info-email" style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd; background:#f9f9f9;">{{ $user->email }}</div>
                </div>

                <!-- Right Column -->
                <div style="flex:1;">
                    <label>Address</label>
                    <div class="info-address" style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd; background:#f9f9f9;">{{ $user->address ?? 'Not provided' }}</div>
                    <label>Phone</label>
                    <div class="info-phone" style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd; background:#f9f9f9;">{{ $user->phone ?? 'Not provided' }}</div>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div id="activity-section" class="profile-section" style="display:none;">
            <h2 style="text-align:center; margin-top:0;">User Activity</h2>
            <div class="activity" style="text-align: center; margin-top:30px;">
                @if($booking)
                <h3>Recent Booking</h3>
                <div class="room-image" style="margin: 20px 0;">
                    @if($booking->room && $booking->room->images->count() > 0)
                    <img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}" alt="Room Image" width="200px" style="border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1);">
                    @else
                    <img src="https://via.placeholder.com/200" alt="No Image" width="200px" style="border-radius:10px;">
                    @endif

                    <h5 style="margin-top:15px; font-weight:bold;">{{ $booking->RoomType }}</h5>
                    <p style="color:#666;">Room Number: {{ $booking->RoomNo }}</p>
                </div>
                <div class="chekinout" style="display:flex; justify-content:center; gap:30px; margin: 20px 0;">
                    <div>
                        <p style="font-size:14px; margin-bottom:5px; font-weight:bold;">Check In</p>
                        <span style="background:green; padding:5px 15px; border-radius:15px; border:1px solid black; color:white;">{{ $booking->Check_in }}</span>
                    </div>
                    <div>
                        <p style="font-size:14px; margin-bottom:5px; font-weight:bold;">Check Out</p>
                        <span style="background:red; padding:5px 15px; border-radius:15px; border:1px solid black; color:white;">{{ $booking->Check_out }}</span>
                    </div>
                </div>

                <div style="margin-top:20px;">
                    <p>Status: <strong class="booking-status" style="text-transform: capitalize; color: {{ $booking->status == 'cancelled' ? 'red' : ($booking->status == 'booked' ? 'green' : 'orange') }}">{{ $booking->status }}</strong></p>
                </div>

                @if($booking->status != 'cancelled')
                <div class="cancel-booking-container" style="margin-top:30px;">
                    <button type="button" onclick="confirmCancellation({{ $booking->id }})" class="btn btn-danger" style="padding:10px 30px; border-radius:20px; font-weight:bold;">Cancel booking</button>
                </div>
                @endif
                @else
                <p style="color:#666; font-style:italic;">No recent booking activities found.</p>
                @endif
            </div>
        </div>
        <!-- Feedback Section -->
        <div id="review-section" class="profile-section" style="display:none;">
            <h2 style="text-align:center; margin-top:0;">Give us review</h2>

            <form id="reviewForm">
                @csrf
                @if($booking && $booking->room)
                    <input type="hidden" name="room_id" value="{{ $booking->room->id }}">
                @endif
                <input type="hidden" name="rating" id="selected_rating" value="0">
                <!-- Profile Image Upload -->
                <div style=" gap:40px; margin-top:30px;">
                    <!-- Left Column -->
                    <label style="font-weight:bold;">Message</label>
                    <textarea style="color: black;" class="form-control" rows="3" name="message" placeholder="Share your experience..."></textarea>
                </div>
                <div style="display: flex; gap: 10px; cursor: pointer;" id="star-container">
                    <div data-value="1" style="font-size: 50px; width: 60px; height: 60px;  display: flex; align-items: center; justify-content: center; color: black;">★</div>
                    <div data-value="2" style="font-size: 50px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; color: black;">★</div>
                    <div data-value="3" style="font-size: 50px; width: 60px; height: 60px;  display: flex; align-items: center; justify-content: center; color: black;">★</div>
                    <div data-value="4" style="font-size: 50px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; color: black;">★</div>
                    <div data-value="5" style="font-size: 50px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; color: black;">★</div>
                </div>

               <script>
const stars = document.querySelectorAll('#star-container div');
let selectedRating = 0;

stars.forEach(star => {
    const value = parseInt(star.getAttribute('data-value'));

    star.addEventListener('click', () => {
        selectedRating = value;
        document.getElementById('selected_rating').value = selectedRating;
        stars.forEach(s => {
            const v = parseInt(s.getAttribute('data-value'));
            // Selected stars = gold, unselected = white, all keep black border
            s.style.color = v <= selectedRating ? 'gold' : 'black';
           
        });
    });
});
</script>

                <div class="buttons mt-3" style="text-align: end;">
                    <button class="btn btn-info"> Send </button>
                </div>

            </form>
        </div>
        <!-- Settings Section -->
        <div id="settings-section" class="profile-section" style="display:none;">
            <h2 style="text-align:center; margin-top:0;">Change Personal Info</h2>

            <form id="profileUpdateForm" enctype="multipart/form-data">
                @csrf
                <!-- Profile Image Upload -->
                <div style="text-align:center; margin:30px 0;">
                    <div style="position:relative; display:inline-block;">
                        <!-- Image Preview -->
                        <img id="preview"
                            src="{{ $user->image ? asset($user->image) : 'https://via.placeholder.com/130' }}"
                            style="width:130px; height:130px; border-radius:50%; border:5px solid #f1f1f1; object-fit:cover; display:block;">

                        <!-- Plus Icon (Centered Bottom) -->
                        <i onclick="document.getElementById('fileInput').click()"
                            style="position:absolute; bottom:11px; left:61%; transform:translateX(61%); width:36px; height:36px; border-radius:50%; background:#2f80ed; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; cursor:pointer; box-shadow:0 4px 10px rgba(0,0,0,0.25); font-style:normal;">+</i>

                        <!-- Hidden File Input -->
                        <input type="file" name="image" id="fileInput" accept="image/*" onchange="previewImage(event)" style="display:none;">
                    </div>
                </div>

                <div style="display:flex; gap:40px; margin-top:30px;">
                    <!-- Left Column -->
                    <div style="flex:1;">
                        <label style="font-weight:bold;">Full Name</label>
                        <input type="text" name="name" value="{{ $user->name }}" placeholder="Your Name"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">

                        <label style="font-weight:bold;">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" placeholder="Your Email"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                    </div>

                    <!-- Right Column -->
                    <div style="flex:1;">
                        <label style="font-weight:bold;">Address</label>
                        <input type="text" name="address" value="{{ $user->address }}" placeholder="Your address"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">

                        <label style="font-weight:bold;">Phone</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="Your phone number"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                </div>

                <h2 style="margin-top:20px; border-top: 1px solid #eee; padding-top:20px;">Update Password</h2>

                <div style="display:flex; gap:40px; margin-top:20px;">
                    <div style="flex:1;">
                        <label style="font-weight:bold;">Current Password</label>
                        <input type="password" name="current_password" placeholder="Current Password"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                    <div style="flex:1;">
                        <label style="font-weight:bold;">New Password</label>
                        <input type="password" name="new_password" placeholder="New Password"
                            style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                    </div>
                </div>

                <div style="text-align:right; margin-top:30px;">
                    <button type="submit" style="background:#2f80ed; color:#fff; padding:10px 25px; border:none; border-radius:20px; cursor:pointer; font-weight:bold;">
                        Update Password
                    </button>
                    <button type="button" onclick="showSection('basic-info')" style="background:#e0e0e0; color:#555; padding:10px 25px; border:none; border-radius:20px; margin-left:10px; cursor:pointer; font-weight:bold;">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewImage(event) {
        document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
    }

    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.profile-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show selected section
        document.getElementById(sectionId + '-section').style.display = 'block';

        // Update active tab styling
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.classList.remove('active-tab');
        });
        document.getElementById('tab-' + sectionId).classList.add('active-tab');
    }

    // Default to basic info if loaded
    window.onload = function() {
        showSection('basic-info');
    }

    // AJAX Profile Update
    $('#profileUpdateForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: "{{ route('profile.update') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                submitBtn.prop('disabled', false).text('Update Password');

                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Update UI elements
                    if (response.user.image) {
                        let imageUrl = "{{ asset('') }}" + response.user.image;
                        $('.sidebar-img').attr('src', imageUrl);
                        $('.basic-info-img').attr('src', imageUrl);
                    }
                    $('.sidebar-name').text(response.user.name);
                    $('.info-name').text(response.user.name);
                    $('.info-email').text(response.user.email);
                    $('.info-address').text(response.user.address || 'Not provided');
                    $('.info-phone').text(response.user.phone || 'Not provided');

                    // Clear passwords
                    $('input[name="current_password"]').val('');
                    $('input[name="new_password"]').val('');
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text('Update Password');
                let message = 'Something went wrong!';

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    message = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: message
                });
            }
        });
    });

    // AJAX Booking Cancellation
    function confirmCancellation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('/booking/cancel') }}/" + id,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire(
                                'Cancelled!',
                                response.message,
                                'success'
                            ).then(() => {
                                // Update status text in UI or hide cancel button
                                $('.booking-status').text('cancelled').css('color', 'red');
                                $('.cancel-booking-container').fadeOut();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong',
                            'error'
                        );
                    }
                });
            }
        })
    }

    // AJAX Review Submission
    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let submitBtn = $(this).find('button');
        submitBtn.prop('disabled', true).text('Sending...');

        $.ajax({
            url: "{{ route('review.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                submitBtn.prop('disabled', false).text('Send');
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#reviewForm')[0].reset();
                    stars.forEach(s => s.style.color = 'black');
                    document.getElementById('selected_rating').value = 0;
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text('Send');
                let message = 'Something went wrong!';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    message = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: message
                });
            }
        });
    });
</script>
@endsection

@endsection