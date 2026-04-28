@extends('layout.app')
@section('title', 'Profile')

@section('content')

@php
	$avatarUrl = $user->image ? asset($user->image) : asset('assets/images/person_1.jpg');
@endphp

<style>
	.profile-page { overflow-x: hidden; }
	.profile-hero {
		position: relative;
		min-height: 280px;
		background-size: cover;
		background-position: center;
	}
	.profile-hero .overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(15, 23, 42, 0.48) 100%);
		opacity: 1;
	}
	.profile-hero .slider-text {
		position: relative;
		z-index: 1;
		min-height: 280px;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 2.25rem 1rem;
	}
	.profile-hero .bread { font-weight: 600; text-shadow: 0 4px 20px rgba(0,0,0,0.35); }
	.profile-hero .breadcrumbs { margin-bottom: 0.75rem !important; }
	.profile-hero .breadcrumbs span { border-bottom: none !important; font-size: 12px; letter-spacing: 0.12em; }
	.profile-hero .breadcrumbs a { color: rgba(255,255,255,0.88) !important; text-decoration: none; }
	.profile-hero .breadcrumbs a:hover { color: #fff !important; }
	.profile-hero .active-crumb { color: #f85959; font-weight: 600; }

	.profile-wide {
		width: 100%;
		max-width: min(1480px, calc(100vw - 28px));
		margin-left: auto;
		margin-right: auto;
		padding-left: 1rem;
		padding-right: 1rem;
	}
	@media (min-width: 768px) {
		.profile-wide { padding-left: 1.5rem; padding-right: 1.5rem; }
	}

	.profile-section-wrap {
		padding-top: 3.5rem;
		padding-bottom: 5rem;
	}
	@media (min-width: 992px) {
		.profile-section-wrap {
			padding-top: 4.5rem;
			padding-bottom: 6rem;
		}
	}

	.profile-sidebar-card {
		background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
		border-radius: 16px;
		padding: 1.75rem 1.25rem;
		box-shadow: 0 16px 48px rgba(15, 23, 42, 0.2);
		border: 1px solid rgba(255,255,255,0.06);
		height: 100%;
	}
	@media (min-width: 992px) {
		.profile-sidebar-sticky { position: sticky; top: 100px; }
	}

	.profile-sidebar-card .profile-img-main {
		width: 112px;
		height: 112px;
		border-radius: 50%;
		object-fit: cover;
		border: 3px solid rgba(255,255,255,0.25);
		box-shadow: 0 8px 24px rgba(0,0,0,0.25);
	}
	.profile-sidebar-card .sidebar-name { font-weight: 700; letter-spacing: 0.02em; }
	.profile-sidebar-card .nav-link {
		color: rgba(255,255,255,0.78);
		padding: 0.65rem 1rem;
		margin-bottom: 0.35rem;
		border-radius: 10px;
		font-weight: 500;
		display: flex;
		align-items: center;
		gap: 0.65rem;
		transition: background 0.2s, color 0.2s, transform 0.2s;
		cursor: pointer;
		border: 1px solid transparent;
	}
	.profile-sidebar-card .nav-link i { font-size: 1.15rem; width: 1.35rem; text-align: center; }
	.profile-sidebar-card .nav-link:hover {
		background: rgba(255,255,255,0.08);
		color: #fff;
		transform: translateX(3px);
	}
	.profile-sidebar-card .nav-link.active-tab {
		background: rgba(248, 89, 89, 0.95);
		color: #fff;
		border-color: rgba(255,255,255,0.12);
		box-shadow: 0 6px 20px rgba(248, 89, 89, 0.35);
	}
	.profile-sidebar-card .nav-link.text-warning { color: #fcd34d !important; }
	.profile-sidebar-card .nav-link.text-warning:hover { color: #fde68a !important; }

	.profile-main-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 16px 48px rgba(15, 23, 42, 0.07);
		border: 1px solid #e8ecf1;
		padding: 1.75rem 1.35rem;
	}
	@media (min-width: 768px) {
		.profile-main-card { padding: 2.25rem 2.5rem; }
	}

	.profile-main-card .section-title {
		font-weight: 700;
		color: #1e293b;
		margin-bottom: 1.5rem;
		padding-bottom: 0.75rem;
		border-bottom: 2px solid rgba(248, 89, 89, 0.2);
	}
	.profile-main-card .info-label {
		font-size: 0.72rem;
		text-transform: uppercase;
		letter-spacing: 0.1em;
		color: #64748b;
		margin-bottom: 0.35rem;
		display: block;
		font-weight: 600;
	}
	.profile-main-card .info-value {
		font-size: 0.98rem;
		color: #1e293b;
		background: #f8fafc;
		padding: 0.75rem 1rem;
		border-radius: 10px;
		margin-bottom: 1.1rem;
		border: 1px solid #e2e8f0;
	}

	.profile-main-card .booking-card {
		border: 1px solid #e8ecf1;
		border-radius: 14px;
		padding: 1.35rem;
		background: #fafbfc;
		transition: box-shadow 0.2s;
	}
	.profile-main-card .booking-card:hover {
		box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
	}

	.status-badge {
		padding: 0.35rem 0.85rem;
		border-radius: 999px;
		font-size: 0.72rem;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.06em;
	}
	.status-booked { background: #d1fae5; color: #065f46; }
	.status-pending { background: #fef3c7; color: #92400e; }
	.status-cancelled { background: #fee2e2; color: #991b1b; }

	.profile-main-card .form-control {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		padding: 0.65rem 1rem;
	}
	.profile-main-card .form-control:focus {
		border-color: rgba(141, 112, 59, 0.55);
		box-shadow: 0 0 0 3px rgba(141, 112, 59, 0.12);
	}

	.btn-profile-primary {
		background: #8d703b;
		color: #fff;
		border: none;
		border-radius: 999px;
		font-weight: 600;
		padding: 0.65rem 1.5rem;
		transition: background 0.2s, box-shadow 0.2s;
	}
	.btn-profile-primary:hover {
		background: #7a6233;
		color: #fff;
		box-shadow: 0 6px 18px rgba(141, 112, 59, 0.35);
	}

	.btn-invoice {
		background: #1e293b;
		color: #fff;
		border: none;
		border-radius: 999px;
		font-weight: 600;
		padding: 0.5rem 1.25rem;
		font-size: 0.875rem;
	}
	.btn-invoice:hover { color: #fff; background: #334155; }

	.star-rating { display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap; }
	.star-rating div {
		font-size: 2.5rem;
		line-height: 1;
		cursor: pointer;
		transition: color 0.2s, transform 0.2s;
		color: #e2e8f0;
		user-select: none;
	}
	.star-rating div:hover { transform: scale(1.08); }

	.edit-photo-btn {
		position: absolute;
		bottom: 0;
		right: 0;
		background: #f85959;
		color: #fff;
		width: 38px;
		height: 38px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		box-shadow: 0 4px 12px rgba(0,0,0,0.2);
		transition: transform 0.2s;
		border: 2px solid #fff;
	}
	.edit-photo-btn:hover { transform: scale(1.06); color: #fff; }
</style>

<div class="profile-page">

	<div class="hero-wrap profile-hero" style="background-image: url('{{ asset('assets/hotal/luxury.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-10 col-lg-8 text-center ftco-animate">
					<div class="text w-100">
						<p class="breadcrumbs mb-2">
							<span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
							<span class="mr-2">/</span>
							<span class="active-crumb">Profile</span>
						</p>
						<h1 class="mb-2 bread">Your profile</h1>
						<p class="text-white mb-0 mx-auto" style="max-width: 32rem; opacity: 0.9;">
							Manage your details, bookings, and feedback in one place.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section bg-light profile-section-wrap">
		<div class="container-fluid profile-wide">
			<div class="row">
				<div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
					<div class="profile-sidebar-sticky">
						<div class="profile-sidebar-card">
							<div class="text-center mb-4">
								<div class="position-relative d-inline-block">
									<img class="profile-img-main sidebar-img" src="{{ $avatarUrl }}" alt="Profile">
								</div>
								<h4 class="sidebar-name text-white mt-3 mb-1">{{ $user->name }}</h4>
								<p class="small mb-0" style="color: rgba(255,255,255,0.55);">{{ $user->email }}</p>
							</div>

							<nav class="nav flex-column">
								<a id="tab-basic-info" class="nav-link active-tab" role="button" onclick="showSection('basic-info')">
									<i class="ion-ios-contact"></i> Personal info
								</a>
								<a id="tab-activity" class="nav-link" role="button" onclick="showSection('activity')">
									<i class="ion-ios-calendar"></i> Recent booking
								</a>
								<a id="tab-review" class="nav-link" role="button" onclick="showSection('review')">
									<i class="ion-ios-star"></i> Post testimonial
								</a>
								<a id="tab-settings" class="nav-link" role="button" onclick="showSection('settings')">
									<i class="ion-ios-settings"></i> Account settings
								</a>
								<hr style="border-color: rgba(255,255,255,0.12);" class="my-3">
								<a href="{{ route('admin.logout') }}" class="nav-link text-warning">
									<i class="ion-ios-log-out"></i> Sign out
								</a>
							</nav>
						</div>
					</div>
				</div>

				<div class="col-lg-8 col-xl-9">
					<div class="profile-main-card">

						<div id="basic-info-section" class="profile-section">
							<h3 class="section-title">Personal information</h3>
							<div class="row">
								<div class="col-md-6">
									<span class="info-label">Full name</span>
									<div class="info-value info-name">{{ $user->name }}</div>
								</div>
								<div class="col-md-6">
									<span class="info-label">Email</span>
									<div class="info-value info-email">{{ $user->email }}</div>
								</div>
								<div class="col-md-6">
									<span class="info-label">Phone</span>
									<div class="info-value info-phone">{{ $user->phone ?? 'Not provided' }}</div>
								</div>
								<div class="col-md-6">
									<span class="info-label">Address</span>
									<div class="info-value info-address">{{ $user->address ?? 'Not provided' }}</div>
								</div>
							</div>
						</div>

						<div id="activity-section" class="profile-section" style="display:none;">
							<h3 class="section-title">Recent booking</h3>
							@if($booking)
								<div class="booking-card">
									<div class="row align-items-center">
										<div class="col-md-4 mb-3 mb-md-0">
											@if($booking->room && $booking->room->images->count() > 0)
												<img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}" class="img-fluid rounded" alt="Room" style="border-radius: 12px;">
											@else
												<div class="rounded d-flex align-items-center justify-content-center text-white" style="height: 160px; background: #cbd5e1;">
													<i class="ion-ios-image" style="font-size: 2.5rem;"></i>
												</div>
											@endif
										</div>
										<div class="col-md-8">
											<div class="d-flex justify-content-between align-items-start mb-2 flex-wrap" style="gap: 0.5rem;">
												<h4 class="mb-0" style="font-weight: 700; color: #1e293b;">{{ $booking->RoomType }}</h4>
												<span class="status-badge booking-status status-{{ $booking->status }}">{{ $booking->status }}</span>
											</div>
											<p class="text-muted small mb-3">Room <strong>{{ $booking->RoomNo }}</strong></p>

											<div class="row no-gutters mb-3">
												<div class="col-6 pr-2">
													<div class="p-2 border rounded text-center bg-white" style="border-color: #e2e8f0 !important; border-radius: 10px;">
														<span class="d-block small text-muted font-weight-bold">Check-in</span>
														<span class="text-success font-weight-bold">{{ \Carbon\Carbon::parse($booking->Check_in)->format('M d, Y') }}</span>
													</div>
												</div>
												<div class="col-6 pl-2">
													<div class="p-2 border rounded text-center bg-white" style="border-color: #e2e8f0 !important; border-radius: 10px;">
														<span class="d-block small text-muted font-weight-bold">Check-out</span>
														<span class="text-danger font-weight-bold">{{ \Carbon\Carbon::parse($booking->Check_out)->format('M d, Y') }}</span>
													</div>
												</div>
											</div>

											<div class="d-flex flex-wrap" style="gap: 0.75rem;">
												<a href="{{ route('booking.invoice', $booking->id) }}" class="btn btn-invoice btn-sm" target="_blank" rel="noopener">
													<i class="ion-ios-cloud-download"></i> Download invoice
												</a>
												@if($booking->status != 'cancelled')
													<button type="button" onclick="confirmCancellation({{ $booking->id }})" class="btn btn-outline-danger btn-sm rounded-pill px-3 cancel-booking-container">
														Cancel reservation
													</button>
												@endif
											</div>
										</div>
									</div>
								</div>
							@else
								<div class="text-center py-5">
									<i class="ion-ios-calendar text-muted" style="font-size: 3.5rem;"></i>
									<p class="mt-3 text-muted mb-4">You have not made a booking yet.</p>
									<a href="{{ route('room') }}" class="btn btn-profile-primary">Explore rooms</a>
								</div>
							@endif
						</div>

						<div id="review-section" class="profile-section" style="display:none;">
							<h3 class="section-title">Share your experience</h3>

							@if($booking && $booking->room)
								<p class="text-muted mb-4 text-center">How was your stay in <strong>{{ $booking->RoomType }}</strong>?</p>

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
										<label class="font-weight-bold text-dark">Your message</label>
										<textarea class="form-control" rows="4" name="message" placeholder="What did you like about your stay?"></textarea>
									</div>

									<div class="text-md-right">
										<button type="submit" class="btn btn-profile-primary">Submit testimonial</button>
									</div>
								</form>
							@else
								<div class="text-center py-5">
									<i class="ion-ios-chatbubbles text-muted" style="font-size: 3.5rem;"></i>
									<p class="mt-3 text-muted mb-4">You can leave a review after you complete a booking.</p>
									<a href="{{ route('room') }}" class="btn btn-profile-primary">Book a room</a>
								</div>
							@endif
						</div>

						<div id="settings-section" class="profile-section" style="display:none;">
							<h3 class="section-title">Account settings</h3>

							<form id="profileUpdateForm" enctype="multipart/form-data">
								@csrf
								<div class="text-center mb-4 mb-md-5">
									<div class="position-relative d-inline-block">
										<img id="preview" src="{{ $avatarUrl }}" class="profile-img-main" alt="" style="width: 120px; height: 120px;">
										<label for="fileInput" class="edit-photo-btn" title="Change photo">
											<i class="ion-md-camera"></i>
										</label>
										<input type="file" name="image" id="fileInput" accept="image/*" onchange="previewImage(event)" style="display:none;">
									</div>
									<p class="text-muted small mb-0 mt-2">Tap the camera icon to update your photo</p>
								</div>

								<div class="row">
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">Full name</label>
										<input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Your name">
									</div>
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">Email</label>
										<input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Your email">
									</div>
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">Phone</label>
										<input type="text" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="Your phone">
									</div>
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">Address</label>
										<input type="text" name="address" class="form-control" value="{{ $user->address }}" placeholder="Your address">
									</div>
								</div>

								<hr class="my-4" style="border-color: #e8ecf1;">
								<h4 class="mb-3 font-weight-bold text-dark" style="font-size: 1.1rem;">Security</h4>

								<div class="row">
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">Current password</label>
										<input type="password" name="current_password" class="form-control" placeholder="Required to change password">
									</div>
									<div class="col-md-6 form-group mb-3">
										<label class="font-weight-bold text-dark">New password</label>
										<input type="password" name="new_password" class="form-control" placeholder="At least 8 characters">
									</div>
								</div>

								<div class="text-md-right mt-4">
									<button type="button" onclick="showSection('basic-info')" class="btn btn-light rounded-pill px-4 mr-md-2 mb-2 mb-md-0" style="border: 1px solid #e2e8f0;">Cancel</button>
									<button type="submit" class="btn btn-profile-primary">Save changes</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function previewImage(event) {
		if (event.target.files && event.target.files[0]) {
			document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
		}
	}

	function showSection(sectionId) {
		document.querySelectorAll('.profile-section').forEach(function(section) {
			section.style.display = 'none';
		});

		document.getElementById(sectionId + '-section').style.display = 'block';

		document.querySelectorAll('.profile-sidebar-card .nav-link').forEach(function(nav) {
			nav.classList.remove('active-tab');
		});
		var tab = document.getElementById('tab-' + sectionId);
		if (tab) tab.classList.add('active-tab');

		if (window.innerWidth < 992) {
			var surface = document.querySelector('.profile-main-card');
			if (surface) surface.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	const stars = document.querySelectorAll('#star-container div');
	let selectedRating = 0;

	stars.forEach(function(star) {
		var value = parseInt(star.getAttribute('data-value'), 10);

		star.addEventListener('mouseenter', function() {
			highlightStars(value, '#f85959');
		});

		star.addEventListener('mouseleave', function() {
			highlightStars(selectedRating, '#c5a47e');
		});

		star.addEventListener('click', function() {
			selectedRating = value;
			document.getElementById('selected_rating').value = String(selectedRating);
			highlightStars(value, '#c5a47e');
		});
	});

	function highlightStars(count, color) {
		stars.forEach(function(s) {
			var v = parseInt(s.getAttribute('data-value'), 10);
			s.style.color = (v <= count) ? color : '#e2e8f0';
		});
	}

	$('#profileUpdateForm').on('submit', function(e) {
		e.preventDefault();

		var formData = new FormData(this);
		var submitBtn = $(this).find('button[type="submit"]');
		var originalText = submitBtn.text();
		submitBtn.prop('disabled', true).html('<i class="ion-ios-sync"></i> Updating...');

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
						title: 'Profile updated',
						text: response.message,
						timer: 2000,
						showConfirmButton: false
					});

					if (response.user.image) {
						var imageUrl = "{{ asset('') }}" + response.user.image;
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
				var message = 'Something went wrong.';

				if (xhr.status === 422) {
					if (xhr.responseJSON && xhr.responseJSON.errors) {
						message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
					}
				} else if (xhr.responseJSON && xhr.responseJSON.message) {
					message = xhr.responseJSON.message;
				}

				Swal.fire({
					icon: 'error',
					title: 'Update failed',
					html: message
				});
			}
		});
	});

	function confirmCancellation(id) {
		Swal.fire({
			title: 'Cancel reservation?',
			text: 'This cannot be undone.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#f85959',
			cancelButtonColor: '#64748b',
			confirmButtonText: 'Yes, cancel',
			cancelButtonText: 'Keep booking'
		}).then(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					url: "{{ url('/booking/cancel') }}/" + id,
					type: "POST",
					data: { _token: "{{ csrf_token() }}" },
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire('Cancelled', response.message, 'success').then(function() {
								$('.booking-status').text('cancelled').removeClass('status-booked status-pending').addClass('status-cancelled');
								$('.cancel-booking-container').fadeOut();
							});
						}
					},
					error: function(xhr) {
						Swal.fire('Error', xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong', 'error');
					}
				});
			}
		});
	}

	$('#reviewForm').on('submit', function(e) {
		e.preventDefault();

		if (selectedRating === 0) {
			Swal.fire('Select a rating', 'Please tap the stars before submitting.', 'info');
			return;
		}

		var formData = $(this).serialize();
		var submitBtn = $(this).find('button[type="submit"]');
		var originalText = submitBtn.text();
		submitBtn.prop('disabled', true).html('<i class="ion-ios-sync"></i> Sending...');

		$.ajax({
			url: "{{ route('review.store') }}",
			type: "POST",
			data: formData,
			success: function(response) {
				submitBtn.prop('disabled', false).text(originalText);
				if (response.status === 'success') {
					Swal.fire({
						icon: 'success',
						title: 'Thank you',
						text: response.message,
						timer: 2000,
						showConfirmButton: false
					});
					$('#reviewForm')[0].reset();
					highlightStars(0, '#e2e8f0');
					selectedRating = 0;
					document.getElementById('selected_rating').value = '0';
				}
			},
			error: function(xhr) {
				submitBtn.prop('disabled', false).text(originalText);
				var message = 'Something went wrong.';
				if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
					message = Object.values(xhr.responseJSON.errors).flat().join('<br>');
				} else if (xhr.responseJSON && xhr.responseJSON.message) {
					message = xhr.responseJSON.message;
				}
				Swal.fire({ icon: 'error', title: 'Error', html: message });
			}
		});
	});
</script>
@endsection
