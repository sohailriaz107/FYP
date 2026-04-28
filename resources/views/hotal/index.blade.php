@extends('layout.app')
@section('title','Home')
@section('content')

<style>
	.home-landing { overflow-x: hidden; }
	.home-landing .home-slider .slider-item .overlay {
		background: linear-gradient(135deg, rgba(15, 23, 42, 0.72) 0%, rgba(15, 23, 42, 0.45) 50%, rgba(15, 23, 42, 0.55) 100%);
	}
	.home-landing .home-slider .slider-text .text h1 {
		font-weight: 700;
		letter-spacing: 0.02em;
		text-shadow: 0 4px 24px rgba(0,0,0,0.35);
	}
	.home-landing .home-slider .slider-text .text h2 {
		font-weight: 400;
		opacity: 0.95;
	}
	.home-hero-badge {
		display: inline-block;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: 0.2em;
		text-transform: uppercase;
		color: rgba(255,255,255,0.9);
		border: 1px solid rgba(255,255,255,0.35);
		padding: 0.45rem 1rem;
		border-radius: 999px;
		margin-bottom: 1.25rem;
		backdrop-filter: blur(6px);
	}
	.home-hero-cta .btn {
		border-radius: 999px;
		font-weight: 600;
		padding: 0.65rem 1.5rem;
		margin: 0.35rem;
	}
	.home-hero-cta .btn-outline-white {
		border-width: 2px;
	}
	/* Keep hero CTAs clear of the overlapping booking strip */
	.home-landing .home-slider .slider-item .slider-text .text {
		padding-bottom: 5rem !important;
	}
	.home-landing .home-hero-cta {
		margin-bottom: 2rem;
	}
	@media (min-width: 768px) {
		.home-landing .home-slider .slider-item .slider-text .text {
			padding-bottom: 7.5rem !important;
		}
		.home-landing .ftco-booking .container {
			margin-top: -140px !important;
		}
	}
	@media (min-width: 992px) {
		.home-landing .ftco-booking .container {
			margin-top: -165px !important;
		}
	}
	/* Remove decorative lines beside hero h2 (theme default) */
	.home-landing .owl-carousel.home-slider .slider-item .slider-text h2:before,
	.home-landing .owl-carousel.home-slider .slider-item .slider-text h2:after {
		display: none !important;
		content: none !important;
		width: 0 !important;
	}
	/* Softer room cards: no doubled vertical borders between columns */
	.home-landing #available-rooms-list .room {
		border-radius: 12px;
		overflow: hidden;
		background: #fff;
		box-shadow: 0 10px 35px rgba(15, 23, 42, 0.07);
	}
	.home-landing #available-rooms-list .room .text {
		border: none !important;
	}
	.home-strip {
		background: linear-gradient(90deg, #1e293b 0%, #334155 50%, #1e293b 100%);
		color: #e2e8f0;
		padding: 2.25rem 0;
		border-top: 1px solid rgba(255,255,255,0.06);
		border-bottom: 1px solid rgba(255,255,255,0.06);
	}
	.home-strip-item {
		text-align: center;
		padding: 0.5rem 1rem;
	}
	.home-strip-item strong {
		display: block;
		font-size: 1.75rem;
		font-family: "Playfair Display", Georgia, serif;
		color: #fff;
		line-height: 1.2;
	}
	.home-strip-item span {
		font-size: 0.8rem;
		text-transform: uppercase;
		letter-spacing: 0.12em;
		opacity: 0.75;
	}
	.home-strip-item .icon-wrap {
		width: 48px;
		height: 48px;
		margin: 0 auto 0.75rem;
		border-radius: 50%;
		background: rgba(248, 89, 89, 0.2);
		color: #f85959;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.25rem;
	}
	.home-section-head .subheading {
		color: #f85959;
		font-weight: 600;
		letter-spacing: 0.18em;
		text-transform: uppercase;
		font-size: 12px;
		display: block;
		margin-bottom: 0.5rem;
	}
	.home-section-head h2 {
		font-weight: 700;
		color: #232323;
	}
	.home-about-card {
		border-radius: 12px;
		box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
		border: 1px solid rgba(0,0,0,0.04);
	}
	.home-about-feature {
		background: #f8fafc;
		padding: 1rem 1.15rem;
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		transition: border-color 0.2s, box-shadow 0.2s;
	}
	.home-about-feature:hover {
		border-color: rgba(248, 89, 89, 0.35);
		box-shadow: 0 8px 24px rgba(248, 89, 89, 0.08);
	}
	.home-about-feature .icon {
		flex-shrink: 0;
	}
	.home-rooms-toolbar {
		margin-top: -0.5rem;
	}
	.home-rooms-toolbar a {
		font-weight: 600;
		font-size: 0.95rem;
	}
	.home-testimony-section {
		background: #fff !important;
	}
	.home-testimony-section .heading-section h2 {
		font-weight: 700;
	}
	@media (max-width: 767px) {
		.home-strip-item { margin-bottom: 1rem; }
		.home-strip-item:last-child { margin-bottom: 0; }
	}
</style>

<div class="home-landing">

<!-- Hero -->
<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url('{{ asset('assets/hotal/grand.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-11 col-lg-10 ftco-animate text-center">
					<div class="text mb-5 pb-3">
						<p class="home-hero-badge mb-3">StayEase · Hotel Management System</p>
						<h1 class="mb-3">Welcome To Deluxe</h1>
						<h2 class="mb-4">Hotels &amp; Resorts</h2>
						<p class="lead text-white mx-auto mb-4" style="max-width: 36rem; font-size: 1.05rem; line-height: 1.65; opacity: 0.92;">
							Plan your stay in a few clicks—browse rooms, check live availability, and book with confidence.
						</p>
						<div class="home-hero-cta pt-2">
							<a href="{{ route('room') }}" class="btn btn-primary px-4">Explore rooms</a>
							<a href="{{ route('about') }}" class="btn btn-outline-white px-4">About the project</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="slider-item" style="background-image: url('{{ asset('assets/hotal/grand2.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-11 col-lg-10 ftco-animate text-center">
					<div class="text mb-5 pb-3">
						<p class="home-hero-badge mb-3">Final Year Project · Laravel</p>
						<h1 class="mb-3">Enjoy A Luxury Experience</h1>
						<h2 class="mb-4">Designed for guests &amp; hotel staff</h2>
						<p class="lead text-white mx-auto mb-4" style="max-width: 36rem; font-size: 1.05rem; line-height: 1.65; opacity: 0.92;">
							A clean, responsive interface for reservations, profiles, and day-to-day hotel workflows.
						</p>
						<div class="home-hero-cta pt-2">
							<a href="{{ route('room') }}" class="btn btn-primary px-4">View all rooms</a>
							<a href="{{ route('contact') }}" class="btn btn-outline-white px-4">Contact</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Booking -->
<section class="ftco-booking">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<form action="{{ route('check.availability') }}" method="POST" class="booking-form" id="availability-form">
					@csrf
					<input type="hidden" name="limit" value="3">
					<div class="row">
						<div class="col-md-3 d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="check_in">Check-in Date</label>
									<input type="text" name="check_in" class="form-control checkin_date"
										placeholder="Check-in date" id="check_in" required autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md-3 d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="check_out">Check-out Date</label>
									<input type="text" name="check_out" class="form-control checkout_date"
										placeholder="Check-out date" id="check_out" required autocomplete="off">
								</div>
							</div>
						</div>
						<div class="col-md d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="room_type">Room</label>
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="room_type" id="room_type" class="form-control" required>
												<option value="">Select Room Type</option>
												@foreach ($room_type as $room)
												<option value="{{ $room->id }}">
													{{ $room->name }}
												</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="customers">Guests</label>
									<div class="form-field">
										<div class="select-wrap">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="customers" id="customers" class="form-control">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md d-flex">
							<div class="form-group d-flex align-self-stretch">
								<input type="submit" value="Check Availability"
									class="btn btn-primary py-3 px-4 align-self-stretch">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Quick stats -->
<section class="home-strip">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-6 col-md-3 home-strip-item ftco-animate">
				<div class="icon-wrap"><span class="ion-ios-home"></span></div>
				<strong>{{ $totalRoomsCount }}</strong>
				<span>Rooms in directory</span>
			</div>
			<div class="col-6 col-md-3 home-strip-item ftco-animate">
				<div class="icon-wrap"><span class="ion-ios-apps"></span></div>
				<strong>{{ $room_type->count() }}</strong>
				<span>Room categories</span>
			</div>
			<div class="col-6 col-md-3 home-strip-item ftco-animate">
				<div class="icon-wrap"><span class="ion-ios-people"></span></div>
				<strong>{{ $testimonials->count() }}</strong>
				<span>Featured reviews</span>
			</div>
			<div class="col-6 col-md-3 home-strip-item ftco-animate">
				<div class="icon-wrap"><span class="ion-ios-checkmark-circle"></span></div>
				<strong>100%</strong>
				<span>Online booking flow</span>
			</div>
		</div>
	</div>
</section>

<!-- About -->
<section class="ftco-section ftc-no-pb ftc-no-pt">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-5 mb-5 mb-lg-0">
				<div class="img img-2 img-3 d-flex justify-content-center align-items-center home-about-card"
					style="background-image: url('{{ asset('assets/hotal/luxury.jpg') }}'); min-height: 480px; background-size: cover; background-position: center;">
				</div>
			</div>
			<div class="col-lg-7 py-5 wrap-about pb-md-5 ftco-animate pl-lg-5">
				<div class="heading-section heading-section-wo-line pt-md-4 mb-4 home-section-head">
					<span class="subheading">About Us</span>
					<h2 class="mb-3">Welcome To StayEase Hotel</h2>
					<p class="text-muted mb-0" style="font-size: 1.05rem; line-height: 1.75; max-width: 38rem;">
						StayEase is a modern, web-based hotel management experience built for your final-year demonstration—covering guest journeys, room discovery, and operational clarity in one cohesive interface.
					</p>
				</div>
				<div class="pb-md-3">
					<ul class="list-unstyled mt-4">
						<li class="d-flex align-items-start mb-3 home-about-feature">
							<div class="icon d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%;">
								<span class="ion-ios-bed" style="font-size: 22px;"></span>
							</div>
							<div class="text pr-2">
								<h5 class="mb-1" style="font-weight: 600;">Luxury rooms</h5>
								<p class="mb-0 text-muted" style="font-size: 14px;">Rich imagery, clear pricing, and status at a glance.</p>
							</div>
						</li>
						<li class="d-flex align-items-start mb-0 home-about-feature">
							<div class="icon d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%;">
								<span class="ion-ios-checkmark-circle-outline" style="font-size: 22px;"></span>
							</div>
							<div class="text pr-2">
								<h5 class="mb-1" style="font-weight: 600;">Simple booking</h5>
								<p class="mb-0 text-muted" style="font-size: 14px;">Pick dates, filter by type, and see availability without friction.</p>
							</div>
						</li>
					</ul>
					<div class="mt-4">
						<a href="{{ route('about') }}" class="btn btn-primary py-3 px-4" style="border-radius: 30px; font-weight: 600;">Discover more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Rooms -->
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row align-items-end mb-5 pb-2">
			<div class="col-md-8 heading-section heading-section-wo-line ftco-animate home-section-head mb-3 mb-md-0">
				<span class="subheading">Accommodation</span>
				<h2 class="mb-2">Our rooms</h2>
				<p class="text-muted mb-0" style="max-width: 32rem;">Hand-picked listings with type and capacity—updated when you run an availability check above.</p>
			</div>
			<div class="col-md-4 text-md-right home-rooms-toolbar ftco-animate">
				<a href="{{ route('room') }}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 999px;">View full catalog</a>
			</div>
		</div>
		<div class="row justify-content-center" id="available-rooms-list">
			@foreach ($rooms as $room )
				@include('hotal.partials.room_card', ['room' => $room, 'homeGrid' => true])
			@endforeach
		</div>
	</div>
</section>

<!-- Testimonials -->
<section class="ftco-section testimony-section bg-light home-testimony-section">
	<div class="container">
		<div class="row justify-content-center mb-4">
			<div class="col-md-8 text-center heading-section heading-section-wo-line ftco-animate home-section-head">
				<span class="subheading">Guest voices</span>
				<h2 class="mb-2">What visitors say</h2>
				<p class="text-muted mb-0">Recent feedback from registered guests—carousel adapts as reviews grow.</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10 ftco-animate">
				<div class="carousel-testimony owl-carousel ftco-owl">
					@forelse($testimonials as $testimonial)
					<div class="item">
						<div class="testimony-wrap py-4 pb-5">
							<div class="user-img mb-4" style="background-image: url('{{ $testimonial->user->image ? asset($testimonial->user->image) : asset('assets/images/person_1.jpg') }}');">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text text-center">
								<p class="mb-4">{{ $testimonial->message }}</p>
								<p class="name">{{ $testimonial->user->name }}</p>
							</div>
						</div>
					</div>
					@empty
					<div class="item">
						<div class="testimony-wrap py-4 pb-5">
							<div class="text text-center">
								<p class="mb-0">No reviews yet. Book a stay and be the first to share your experience.</p>
							</div>
						</div>
					</div>
					@endforelse
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
    $('#availability-form').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message + ' (' + response.available_count + ' rooms found)',
                        icon: 'success',
                        confirmButtonText: 'Great!'
                    });

                    $('#available-rooms-list').html(response.html);

                    $('html, body').animate({
                        scrollTop: $("#available-rooms-list").offset().top - 100
                    }, 800);
                } else {
                    Swal.fire({
                        title: 'Not Available',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                var message = 'Something went wrong. Please try again.';
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    message = Object.values(errors).flat().join('\n');
                }
                Swal.fire({
                    title: 'Error',
                    text: message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
@endsection
