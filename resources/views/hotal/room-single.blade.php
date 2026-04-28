@extends('layout.app')
@section('title', $room->roomType->name . ' · Room details')

@section('content')

@php
	$heroBg = $room->images->count() > 0
		? asset('storage/' . $room->images->first()->image_path)
		: asset('assets/hotal/luxury.jpg');
	$avgRating = (float) ($averageRating ?? 0);
	$statusKey = strtolower($room->status);
	$statusColor = match ($statusKey) {
		'available' => 'success',
		'occupied' => 'danger',
		'cleaning' => 'info',
		'maintenance' => 'warning',
		default => 'secondary',
	};
@endphp

<style>
	.room-single-page { overflow-x: hidden; }
	.room-single-hero {
		position: relative;
		min-height: 300px;
		background-size: cover;
		background-position: center;
	}
	.room-single-hero .overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.45) 100%);
		opacity: 1;
	}
	.room-single-hero .slider-text {
		position: relative;
		z-index: 1;
		min-height: 300px;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 2.5rem 1rem;
	}
	.room-single-hero .bread {
		font-weight: 600;
		letter-spacing: 0.02em;
		text-shadow: 0 4px 20px rgba(0,0,0,0.35);
	}
	.room-single-hero .breadcrumbs {
		margin-bottom: 0.75rem !important;
	}
	.room-single-hero .breadcrumbs span {
		border-bottom: none !important;
		font-size: 12px;
		letter-spacing: 0.12em;
	}
	.room-single-hero .breadcrumbs a {
		color: rgba(255,255,255,0.88) !important;
		text-decoration: none;
	}
	.room-single-hero .breadcrumbs a:hover { color: #fff !important; }
	.room-single-hero .active-crumb { color: #f85959; font-weight: 600; }

	.room-single-wide {
		width: 100%;
		max-width: min(1560px, calc(100vw - 24px));
		margin-left: auto;
		margin-right: auto;
		padding-left: 1rem;
		padding-right: 1rem;
	}
	@media (min-width: 768px) {
		.room-single-wide { padding-left: 1.5rem; padding-right: 1.5rem; }
	}

	.room-single-card {
		background: #fff;
		border-radius: 14px;
		box-shadow: 0 12px 40px rgba(15, 23, 42, 0.06);
		border: 1px solid #e8ecf1;
		padding: 1.25rem 1.25rem 1.5rem;
		margin-bottom: 1.5rem;
	}
	@media (min-width: 768px) {
		.room-single-card { padding: 1.5rem 1.75rem; }
	}

	.room-single-page .single-slider .room-img {
		border-radius: 12px;
		min-height: 360px;
	}
	.room-single-page .single-slider .owl-stage-outer {
		border-radius: 12px;
	}

	.room-single-spec {
		background: #f8fafc;
		border-radius: 10px;
		padding: 0.85rem 1rem;
		border: 1px solid #e2e8f0;
		font-size: 0.95rem;
	}
	.room-single-spec span { color: #64748b; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.06em; }

	.room-single-amenity {
		flex: 1 1 120px;
		max-width: 140px;
		text-align: center;
	}
	.room-single-amenity .amenity-icon-wrap {
		background: #fff;
		border: 1px solid #e2e8f0;
		border-radius: 12px;
		padding: 0.75rem;
		box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
		transition: border-color 0.2s, box-shadow 0.2s;
	}
	.room-single-amenity .amenity-icon-wrap:hover {
		border-color: rgba(248, 89, 89, 0.35);
		box-shadow: 0 8px 22px rgba(248, 89, 89, 0.08);
	}
	.room-single-amenity img {
		width: 100%;
		height: 72px;
		object-fit: contain;
	}

	.room-single-booking {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 16px 48px rgba(15, 23, 42, 0.08);
		border: 1px solid #e8ecf1;
		padding: 1.35rem 1.25rem 1.5rem;
	}
	.room-single-booking h2 {
		font-size: 1.25rem;
		font-weight: 700;
		color: #1e293b;
		text-align: center;
		margin-bottom: 1rem;
	}
	.room-single-booking .form-control {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		padding: 0.55rem 0.85rem;
	}
	.room-single-booking .form-control:focus {
		border-color: rgba(141, 112, 59, 0.55);
		box-shadow: 0 0 0 3px rgba(141, 112, 59, 0.12);
	}
	.room-single-booking label {
		font-size: 0.8rem;
		font-weight: 600;
		color: #64748b;
		text-transform: uppercase;
		letter-spacing: 0.05em;
		margin-bottom: 0.25rem;
	}
	.room-single-booking .btn-book {
		width: 100%;
		border-radius: 10px;
		font-weight: 600;
		padding: 0.75rem 1rem;
	}
	@media (min-width: 992px) {
		.room-single-sidebar-sticky {
			position: sticky;
			top: 100px;
		}
	}

	.room-single-page .review-item {
		border-bottom: 1px solid #eef2f7 !important;
		padding-bottom: 1rem !important;
	}
	.room-single-page .similar-room .room {
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 10px 32px rgba(15, 23, 42, 0.07);
	}
	.room-single-page .similar-room .room .text {
		border: none !important;
	}
	.room-single-page .similar-room .img.img-2 {
		height: 200px;
	}

	.room-single-head .price-pill {
		font-size: 1.35rem;
		font-weight: 700;
		color: #1e293b;
	}
	.room-single-head .per-night {
		font-size: 0.9rem;
		color: #64748b;
		font-weight: 500;
	}
</style>

<div class="room-single-page">

	<div class="hero-wrap room-single-hero" style="background-image: url('{{ $heroBg }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-10 col-lg-8 text-center ftco-animate">
					<div class="text w-100">
						<p class="breadcrumbs mb-2">
							<span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
							<span class="mr-2">/</span>
							<span class="mr-2"><a href="{{ route('room') }}">Rooms</a></span>
							<span class="mr-2">/</span>
							<span class="active-crumb">{{ $room->roomType->name }}</span>
						</p>
						<h1 class="mb-2 bread">{{ $room->roomType->name }}</h1>
						<p class="text-white mb-0 mx-auto" style="max-width: 36rem; opacity: 0.9;">
							Room {{ $room->room_number }} · Up to {{ $room->roomType->max_persons }} guests
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section bg-light" style="padding-top: 2.5rem;">
		<div class="container-fluid room-single-wide">
			<div class="row">
				<div class="col-lg-8 pr-lg-4 mb-5 mb-lg-0">

					<div class="d-flex flex-wrap align-items-center justify-content-between mb-3 room-single-head">
						<div>
							<span class="d-block text-muted small text-uppercase font-weight-bold" style="letter-spacing: 0.12em;">Overview</span>
							<h2 class="mb-1" style="font-weight: 700; color: #232323;">{{ $room->roomType->name }}</h2>
							<span class="badge badge-{{ $statusColor }} px-3 py-2" style="font-size: 0.85rem;">{{ ucfirst($room->status) }}</span>
						</div>
						<div class="text-lg-right mt-3 mt-lg-0">
							<div class="price-pill">${{ number_format($room->roomType->base_price, 0) }}</div>
							<div class="per-night">per night</div>
						</div>
					</div>

					<div class="room-single-card ftco-animate p-0 overflow-hidden">
						<div class="single-slider owl-carousel">
							@if($room->images->count() > 0)
								@foreach($room->images as $image)
									<div class="item">
										<div class="room-img" style="background-image: url('{{ asset('storage/' . $image->image_path) }}')"></div>
									</div>
								@endforeach
							@else
								<div class="item">
									<div class="room-img" style="background-image: url('{{ asset('assets/images/room-1.jpg') }}')"></div>
								</div>
								<div class="item">
									<div class="room-img" style="background-image: url('{{ asset('assets/images/room-2.jpg') }}')"></div>
								</div>
								<div class="item">
									<div class="room-img" style="background-image: url('{{ asset('assets/images/room-3.jpg') }}')"></div>
								</div>
							@endif
						</div>
					</div>

					<div class="room-single-card ftco-animate">
						<h3 class="h5 font-weight-bold text-dark mb-3">Description</h3>
						<p class="text-muted mb-0" style="line-height: 1.75;">{{ $room->roomType->description }}</p>
						<div class="row mt-4">
							<div class="col-sm-6 mb-3">
								<div class="room-single-spec h-100">
									<span class="d-block mb-1">Max guests</span>
									<strong class="text-dark">{{ $room->roomType->max_persons }}</strong>
								</div>
							</div>
							<div class="col-sm-6 mb-3">
								<div class="room-single-spec h-100">
									<span class="d-block mb-1">Room size</span>
									<strong class="text-dark">{{ $room->roomType->room_size }}</strong>
								</div>
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<div class="room-single-spec h-100">
									<span class="d-block mb-1">Room number</span>
									<strong class="text-dark">{{ $room->room_number }}</strong>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="room-single-spec h-100">
									<span class="d-block mb-1">Beds</span>
									<strong class="text-dark">{{ $room->roomType->beds }}</strong>
								</div>
							</div>
						</div>
					</div>

					@if($room->amenities->count() > 0)
						<div class="room-single-card ftco-animate">
							<h3 class="h5 font-weight-bold text-dark mb-3">Amenities</h3>
							<div class="d-flex flex-wrap justify-content-center justify-content-md-start" style="gap: 1rem;">
								@foreach($room->amenities as $amenity)
									<div class="room-single-amenity m-0">
										<div class="amenity-icon-wrap mb-2">
											<img src="{{ asset('storage/' . $amenity->icon) }}" alt="{{ $amenity->name }}">
										</div>
										<span class="small font-weight-bold text-dark">{{ $amenity->name }}</span>
									</div>
								@endforeach
							</div>
						</div>
					@endif

					<div class="room-single-card ftco-animate">
						<h3 class="h5 font-weight-bold text-dark mb-3">Video tour</h3>
						<div class="block-16 rounded overflow-hidden" style="border-radius: 12px;">
							<figure class="mb-0">
								<img src="{{ asset('assets/images/room-4.jpg') }}" alt="Room preview" class="img-fluid w-100">
								<a href="https://vimeo.com/45830194" class="play-button popup-vimeo"><span class="icon-play"></span></a>
							</figure>
						</div>
					</div>

					<div class="room-single-card ftco-animate">
						<h3 class="h5 font-weight-bold text-dark mb-3">Reviews &amp; ratings</h3>
						<div class="rating-wrap mb-4 pb-3 border-bottom">
							<p class="rate mb-0">
								<span class="text-dark" style="font-size: 1.1rem;">
									@for($i = 1; $i <= 5; $i++)
										<i class="{{ $i <= round($avgRating) ? 'icon-star' : 'icon-star-o' }}"></i>
									@endfor
									<span class="text-muted ml-2">({{ number_format($avgRating, 1) }} average)</span>
								</span>
							</p>
						</div>
						<div class="review-list">
							@forelse($reviews as $review)
								<div class="review-item mb-4 pb-3">
									<div class="d-flex align-items-center mb-2">
										<img src="{{ $review->user->image ? asset($review->user->image) : asset('assets/images/person_1.jpg') }}" alt="" class="rounded-circle mr-3" style="width: 48px; height: 48px; object-fit: cover;">
										<div class="flex-grow-1">
											<h5 class="mb-0" style="font-size: 1rem; font-weight: 700;">{{ $review->user->name }}</h5>
											<div class="stars" style="color: #c5a47e;">
												@for($i = 1; $i <= 5; $i++)
													<i class="{{ $i <= $review->rating ? 'icon-star' : 'icon-star-o' }}"></i>
												@endfor
											</div>
										</div>
										<small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
									</div>
									<p class="text-muted mb-0" style="font-style: italic;">"{{ $review->message }}"</p>
								</div>
							@empty
								<p class="text-muted mb-0">No reviews yet for this room.</p>
							@endforelse
						</div>
					</div>

					<div class="ftco-animate mb-2">
						<h3 class="h5 font-weight-bold text-dark mb-3">More {{ $room->roomType->name }} rooms</h3>
						<div class="row">
							@forelse ($sameRooms as $sr)
								<div class="col-md-6 similar-room mb-4">
									<div class="room">
										<a href="{{ route('room-single', $sr->id) }}" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ $sr->images->count() > 0 ? asset('storage/' . $sr->images->first()->image_path) : asset('assets/images/room-1.jpg') }}')">
											<div class="icon d-flex align-items-center justify-content-center">
												<span class="icon-search2"></span>
											</div>
										</a>
										<div class="text p-3 text-center">
											<h3 class="mb-2" style="font-size: 1.1rem;"><a href="{{ route('room-single', $sr->id) }}">{{ $sr->roomType->name }}</a></h3>
											<p class="mb-1"><span class="price mr-2">${{ number_format($sr->roomType->base_price, 0) }}</span> <span class="per">per night</span></p>
											<p class="small text-muted mb-0">Room {{ $sr->room_number }}</p>
											<hr class="my-2">
											<p class="pt-1 mb-0"><a href="{{ route('room-single', $sr->id) }}" class="btn-custom">View details <span class="icon-long-arrow-right"></span></a></p>
										</div>
									</div>
								</div>
							@empty
								<div class="col-12">
									<p class="text-muted text-center py-3 mb-0">No other rooms of this type are listed right now.</p>
								</div>
							@endforelse
						</div>
					</div>

				</div>

				<div class="col-lg-4">
					<div class="room-single-sidebar-sticky">
						<div id="booking-status-container" class="mb-3 text-center" style="{{ $bookingStatus ? '' : 'display: none;' }}">
							<p class="mb-0 small font-weight-bold text-secondary text-uppercase" style="letter-spacing: 0.08em;">Booking status</p>
							<p class="mb-0 mt-1">
								<span id="current-booking-status" class="badge {{ $bookingStatus == 'booked' ? 'badge-success' : ($bookingStatus == 'cancelled' ? 'badge-danger' : 'badge-warning') }} px-3 py-2" style="font-size: 0.9rem;">{{ ucfirst($bookingStatus) }}</span>
							</p>
						</div>

						<div class="sidebar-box ftco-animate room-single-booking">
							<h2>Book this room</h2>

							@if(session('message'))
								<div class="alert alert-success py-2">{{ session('message') }}</div>
							@endif
							@if(session('error'))
								<div class="alert alert-danger py-2">{{ session('error') }}</div>
							@endif
							@if ($errors->any())
								<div class="alert alert-danger py-2">
									<ul class="mb-0 pl-3">
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif

							<div id="booking-message" class="mb-3" style="display: none;"></div>

							@if($room->status !== 'available' || $isRoomBooked)
								<div class="alert alert-warning text-center small mb-3">
									@if($isRoomBooked)
										This room is already booked.
									@else
										This room is currently {{ ucfirst($room->status) }} and cannot be booked.
									@endif
								</div>
							@endif

							<form id="bookingForm" action="{{ route('Booking.post') }}" method="post">
								@csrf
								<div class="form-group mb-3">
									<label for="check_in">Check-in</label>
									<input type="date" name="check_in" id="check_in" class="form-control" required
										{{ ($room->status === 'available' && !$isRoomBooked) ? '' : 'disabled' }}>
								</div>
								<div class="form-group mb-3">
									<label for="check_out">Check-out</label>
									<input type="date" name="check_out" id="check_out" class="form-control" required
										{{ ($room->status === 'available' && !$isRoomBooked) ? '' : 'disabled' }}>
								</div>
								<div class="form-group mb-4">
									<label for="guests">Guests</label>
									<select name="guests" id="guests" class="form-control" required
										{{ ($room->status === 'available' && !$isRoomBooked) ? '' : 'disabled' }}>
										<option value="" selected disabled>Select number of guests</option>
										@for ($i = 1; $i <= $room->roomType->max_persons; $i++)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor
									</select>
								</div>
								<input type="hidden" name="room_type" value="{{ $room->roomType->name }}">
								<input type="hidden" name="room_no" value="{{ $room->room_number }}">
								<input type="hidden" name="base_price" value="{{ $room->roomType->base_price }}">

								<button type="submit" class="btn btn-primary btn-book"
									{{ ($room->status === 'available' && !$isRoomBooked) ? '' : 'disabled' }}>
									{{ ($room->status === 'available' && !$isRoomBooked) ? 'Confirm booking' : 'Unavailable' }}
								</button>
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
$(document).ready(function() {
	$('#bookingForm').on('submit', function(e) {
		e.preventDefault();

		var $form = $(this);
		var $btn = $form.find('button[type="submit"]');
		var checkIn = $form.find('input[name="check_in"]').val();
		var checkOut = $form.find('input[name="check_out"]').val();
		var guests = $form.find('select[name="guests"]').val();

		if (!checkIn || !checkOut || !guests) {
			Swal.fire({
				icon: 'warning',
				title: 'Missing information',
				text: 'Please choose check-in, check-out, and number of guests.'
			});
			return;
		}

		var busyText = 'Processing...';
		$btn.data('orig', $btn.text()).text(busyText).prop('disabled', true).css('opacity', '0.85');

		$.ajax({
			url: $form.attr('action'),
			method: 'POST',
			data: $form.serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response) {
				if (response.success) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: response.message,
						confirmButtonColor: '#8d703b'
					}).then(function() {
						window.location.reload();
					});
				} else {
					Swal.fire({ icon: 'error', title: 'Booking failed', text: response.message });
					$btn.text($btn.data('orig')).prop('disabled', false).css('opacity', '1');
				}
			},
			error: function(xhr) {
				var errorMsg = 'An error occurred. Please try again.';
				if (xhr.status === 422) {
					if (xhr.responseJSON && xhr.responseJSON.errors) {
						errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
					} else if (xhr.responseJSON && xhr.responseJSON.message) {
						errorMsg = xhr.responseJSON.message;
					}
				} else if (xhr.status === 401) {
					errorMsg = 'Your session has expired. Please log in again.';
				} else if (xhr.responseJSON && xhr.responseJSON.message) {
					errorMsg = xhr.responseJSON.message;
				}
				Swal.fire({ icon: 'error', title: 'Booking failed', html: errorMsg });
				$btn.text($btn.data('orig')).prop('disabled', false).css('opacity', '1');
			}
		});
	});
});
</script>
@endsection
