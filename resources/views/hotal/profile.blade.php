@extends('layout.app')
@section('title', 'User Profile')
@section('content')

<style>
    :root {
        --primary-color: #f85959;
        --secondary-color: #2f80ed;
        --bg-light: #f8f9fa;
        --text-dark: #343a40;
        --text-muted: #6c757d;
    }

    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
    }

    .sidebar-nav {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        padding: 40px 20px;
        height: 100%;
        color: #fff;
    }

    .sidebar-nav .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 12px 20px;
        margin-bottom: 10px;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
    }

    .sidebar-nav .nav-link i {
        font-size: 1.1rem;
        width: 25px;
    }

    .sidebar-nav .nav-link:hover, 
    .sidebar-nav .nav-link.active-tab {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateX(5px);
    }

    .sidebar-nav .nav-link.active-tab {
        background: var(--primary-color);
        box-shadow: 0 4px 15px rgba(248, 89, 89, 0.3);
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-img-container {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .profile-img-main {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .edit-photo-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--secondary-color);
        color: #fff;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .edit-photo-btn:hover {
        transform: scale(1.1);
    }

    .section-title {
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
    }

    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        margin-bottom: 5px;
        display: block;
        font-weight: 600;
    }

    .info-value {
        font-size: 1rem;
        color: var(--text-dark);
        background: var(--bg-light);
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .booking-card {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 20px;
        transition: transform 0.3s;
    }

    .status-badge {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-booked { background: #d4edda; color: #155724; }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .star-rating {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .star-rating div {
        font-size: 40px;
        cursor: pointer;
        transition: color 0.2s, transform 0.2s;
        color: #ddd;
    }

    .star-rating div:hover {
        transform: scale(1.2);
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(47, 128, 237, 0.15);
        border-color: var(--secondary-color);
    }

    .btn-custom {
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary-custom {
        background: var(--secondary-color);
        color: #fff;
        border: none;
    }

    .btn-primary-custom:hover {
        background: #2567c2;
        box-shadow: 0 5px 15px rgba(47, 128, 237, 0.3);
    }
</style>

<div class="hero-wrap" style="background-image: url('{{ asset('assets/hotal/luxury.jpg') }}'); min-height: 400px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-items-center justify-content-center" style="min-height: 400px;">
            <div class="col-md-9 ftco-animate text-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Profile</span></p>
                    <h1 class="mb-4 bread">Your Sanctuary</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="profile-card sidebar-nav h-100">
                    <div class="profile-header">
                        <div class="profile-img-container">
                            <img class="profile-img-main sidebar-img" src="{{ $user->image ? asset($user->image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" alt="Profile">
                        </div>
                        <h4 class="sidebar-name text-white mb-1">{{ $user->name }}</h4>
                        <p class="text-white-50 small mb-4">{{ $user->email }}</p>
                    </div>

                    <div class="nav flex-column">
                        <a id="tab-basic-info" class="nav-link active-tab" onclick="showSection('basic-info')">
                            <i class="ion-ios-contact"></i> Personal Info
                        </a>
                        <a id="tab-activity" class="nav-link" onclick="showSection('activity')">
                            <i class="ion-ios-list-box"></i> Recent Bookings
                        </a>
                        <a id="tab-review" class="nav-link" onclick="showSection('review')">
                            <i class="ion-ios-star"></i> Post Testimonial
                        </a>
                        <a id="tab-settings" class="nav-link" onclick="showSection('settings')">
                            <i class="ion-ios-settings"></i> Account Settings
                        </a>
                        <hr class="border-white-50 my-3">
                        <a href="{{ route('admin.logout') }}" class="nav-link text-warning">
                            <i class="ion-ios-log-out"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-8 col-lg-9">
                <div class="profile-card p-4 p-md-5">
                    
                    <!-- Basic Information Section -->
                    <div id="basic-info-section" class="profile-section">
                        <h3 class="section-title">Personal Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="info-label">Full Name</span>
                                <div class="info-value info-name">{{ $user->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <span class="info-label">Email Address</span>
                                <div class="info-value info-email">{{ $user->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <span class="info-label">Phone Number</span>
                                <div class="info-value info-phone">{{ $user->phone ?? 'Not provided' }}</div>
                            </div>
                            <div class="col-md-6">
                                <span class="info-label">Current Address</span>
                                <div class="info-value info-address">{{ $user->address ?? 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Section -->
                    <div id="activity-section" class="profile-section" style="display:none;">
                        <h3 class="section-title">Recent Booking Activities</h3>
                        @if($booking)
                            <div class="booking-card">
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        @if($booking->room && $booking->room->images->count() > 0)
                                            <img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}" class="img-fluid rounded" alt="Room">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center text-white" style="height: 150px;">
                                                <i class="ion-ios-image" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h4 class="mb-0">{{ $booking->RoomType }}</h4>
                                            <span class="status-badge booking-status status-{{ $booking->status }}">
                                                {{ $booking->status }}
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-3">Room Number: <strong>{{ $booking->RoomNo }}</strong></p>
                                        
                                        <div class="row no-gutters mb-4">
                                            <div class="col-6 pr-2">
                                                <div class="p-2 border rounded text-center">
                                                    <span class="d-block small text-muted font-weight-bold">CHECK-IN</span>
                                                    <span class="text-success font-weight-bold">{{ \Carbon\Carbon::parse($booking->Check_in)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-6 pl-2">
                                                <div class="p-2 border rounded text-center">
                                                    <span class="d-block small text-muted font-weight-bold">CHECK-OUT</span>
                                                    <span class="text-danger font-weight-bold">{{ \Carbon\Carbon::parse($booking->Check_out)->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        @if($booking->status != 'cancelled')
                                            <div class="cancel-booking-container text-right">
                                                <button onclick="confirmCancellation({{ $booking->id }})" class="btn btn-outline-danger btn-sm rounded-pill px-4">
                                                    Cancel Reservation
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="ion-ios-calendar text-muted" style="font-size: 4rem;"></i>
                                <p class="mt-3 text-muted">You haven't made any bookings yet.</p>
                                <a href="{{ route('room') }}" class="btn btn-primary-custom btn-custom mt-2">Explore Rooms</a>
                            </div>
                        @endif
                    </div>

                    <!-- Review Section -->
                    <div id="review-section" class="profile-section" style="display:none;">
                        <h3 class="section-title">Share Your Experience</h3>
                        
                        @if($booking && $booking->room)
                            <p class="text-muted mb-4 text-center">How was your stay in the <strong>{{ $booking->RoomType }}</strong>?</p>

                            <form id="reviewForm">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $booking->room->id }}">
                                <input type="hidden" name="rating" id="selected_rating" value="0">
                                
                                <div class="star-rating mb-4" id="star-container">
                                    <div data-value="1">★</div>
                                    <div data-value="2">★</div>
                                    <div data-value="3">★</div>
                                    <div data-value="4">★</div>
                                    <div data-value="5">★</div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold text-dark">Your Message</label>
                                    <textarea class="form-control" rows="4" name="message" placeholder="What did you love about your stay?"></textarea>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary-custom btn-custom">
                                        Submit Testimonial
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="text-center py-5">
                                <i class="ion-ios-chatbubbles text-muted" style="font-size: 4rem;"></i>
                                <p class="mt-3 text-muted">You can share your experience once you've completed a booking.</p>
                                <a href="{{ route('room') }}" class="btn btn-primary-custom btn-custom mt-2">Book a Room Now</a>
                            </div>
                        @endif
                    </div>

                    <!-- Settings Section -->
                    <div id="settings-section" class="profile-section" style="display:none;">
                        <h3 class="section-title">Account Settings</h3>
                        
                        <form id="profileUpdateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center mb-5">
                                <div class="profile-img-container">
                                    <img id="preview" src="{{ $user->image ? asset($user->image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}" class="profile-img-main">
                                    <label for="fileInput" class="edit-photo-btn">
                                        <i class="ion-md-camera"></i>
                                    </label>
                                    <input type="file" name="image" id="fileInput" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                </div>
                                <p class="text-muted small">Click the camera icon to update your photo</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Your Name">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Your Email">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="Your Phone">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">Current Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}" placeholder="Your Address">
                                </div>
                            </div>

                            <hr class="my-4">
                            <h4 class="mb-4">Security</h4>

                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Required for password change">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label class="font-weight-bold">New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Min. 8 characters">
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="button" onclick="showSection('basic-info')" class="btn btn-light btn-custom mr-2">Cancel</button>
                                <button type="submit" class="btn btn-primary-custom btn-custom">Save Changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function previewImage(event) {
        if(event.target.files && event.target.files[0]) {
            document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
        }
    }

    function showSection(sectionId) {
        document.querySelectorAll('.profile-section').forEach(section => {
            section.style.display = 'none';
        });

        document.getElementById(sectionId + '-section').style.display = 'block';

        document.querySelectorAll('.nav-link').forEach(nav => {
            nav.classList.remove('active-tab');
        });
        document.getElementById('tab-' + sectionId).classList.add('active-tab');
        
        // Scroll to content on mobile
        if(window.innerWidth < 768) {
            document.querySelector('.profile-card.p-4').scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Star Rating Logic
    const stars = document.querySelectorAll('#star-container div');
    let selectedRating = 0;

    stars.forEach(star => {
        const value = parseInt(star.getAttribute('data-value'));

        star.addEventListener('mouseenter', () => {
            highlightStars(value, '#f85959');
        });

        star.addEventListener('mouseleave', () => {
            highlightStars(selectedRating, 'gold');
        });

        star.addEventListener('click', () => {
            selectedRating = value;
            document.getElementById('selected_rating').value = selectedRating;
            highlightStars(value, 'gold');
        });
    });

    function highlightStars(count, color) {
        stars.forEach(s => {
            const v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= count ? color : '#ddd';
        });
    }

    // AJAX Profile Update
    $('#profileUpdateForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        let submitBtn = $(this).find('button[type="submit"]');
        let originalText = submitBtn.text();
        submitBtn.prop('disabled', true).html('<i class="ion-ios-sync ion-spin"></i> Updating...');

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
                submitBtn.prop('disabled', false).text(originalText);

                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    if (response.user.image) {
                        let imageUrl = "{{ asset('') }}" + response.user.image;
                        $('.sidebar-img').attr('src', imageUrl);
                        $('#preview').attr('src', imageUrl);
                    }
                    $('.sidebar-name').text(response.user.name);
                    $('.info-name').text(response.user.name);
                    $('.info-email').text(response.user.email);
                    $('.info-address').text(response.user.address || 'Not provided');
                    $('.info-phone').text(response.user.phone || 'Not provided');

                    $('input[name="current_password"]').val('');
                    $('input[name="new_password"]').val('');
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text(originalText);
                let message = 'Something went wrong!';

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    message = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    html: message
                });
            }
        });
    });

    // AJAX Booking Cancellation
    function confirmCancellation(id) {
        Swal.fire({
            title: 'Cancel Reservation?',
            text: "Are you sure you want to cancel this booking? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f85959',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, cancel it',
            cancelButtonText: 'Keep it'
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
                            Swal.fire('Cancelled!', response.message, 'success')
                            .then(() => {
                                $('.booking-status').text('cancelled').removeClass('status-booked status-pending').addClass('status-cancelled');
                                $('.cancel-booking-container').fadeOut();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong', 'error');
                    }
                });
            }
        })
    }

    // AJAX Review Submission
    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();

        if(selectedRating === 0) {
            Swal.fire('Wait!', 'Please select a star rating first.', 'info');
            return;
        }

        let formData = $(this).serialize();
        let submitBtn = $(this).find('button');
        let originalText = submitBtn.text();
        submitBtn.prop('disabled', true).html('<i class="ion-ios-sync ion-spin"></i> Sending...');

        $.ajax({
            url: "{{ route('review.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                submitBtn.prop('disabled', false).text(originalText);
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank You!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#reviewForm')[0].reset();
                    highlightStars(0, '#ddd');
                    selectedRating = 0;
                    document.getElementById('selected_rating').value = 0;
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text(originalText);
                let message = 'Something went wrong!';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    message = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                Swal.fire({ icon: 'error', title: 'Oops...', html: message });
            }
        });
    });
</script>
@endsection

@endsection