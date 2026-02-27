@extends('layout.app')
@section('title','Home')
@section('content')

<section class="home-slider owl-carousel">
	<div class="slider-item" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-12 ftco-animate text-center">
					<div class="text mb-5 pb-3">
						<h1 class="mb-3">Welcome To Deluxe</h1>
						<h2>Hotels &amp; Resorts</h2>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="slider-item" style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-12 ftco-animate text-center">
					<div class="text mb-5 pb-3">
						<h1 class="mb-3">Enjoy A Luxury Experience</h1>
						<h2>Join With Us</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ftco-booking">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<form action="{{ route('check.availability') }}" method="POST" class="booking-form" id="availability-form">
					@csrf
					<div class="row">
						<!-- added filter here -->
						<div class="col-md-3 d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="#">Check-in Date</label>
									<input type="text" name="check_in" class="form-control checkin_date"
										placeholder="Check-in date" id="check_in" required>
								</div>
							</div>
						</div>
						<div class="col-md-3 d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="#">Check-out Date</label>
									<input type="text" name="check_out" class="form-control checkout_date"
										placeholder="Check-out date" id="check_out" required>
								</div>
							</div>
						</div>
						<div class="col-md d-flex">
							<div class="form-group p-4 align-self-stretch d-flex align-items-end">
								<div class="wrap">
									<label for="#">Room</label>
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
									<label for="#">Customer</label>
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
<!-- this section is for about us -->

<section class="ftco-section ftc-no-pb ftc-no-pt">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-5 p-md-5 img img-2 img-3 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('assets/images/about.jpg') }}'); min-height: 500px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
			</div>
			<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
				<div class="heading-section heading-section-wo-line pt-md-5 pl-md-5 mb-5">
					<div class="ml-md-0">
						<span class="subheading" style="color: #f85959; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">About Us</span>
						<h2 class="mb-4" style="font-weight: 700; color: #232323;">Welcome To StayEase Hotel</h2>
					</div>
				</div>
				<div class="pb-md-5 pl-md-5">
					<p style="color: #666; font-size: 16px; line-height: 1.8; margin-bottom: 25px;">StayEase Hotel Management System is a modern, web-based application developed to automate and improve hotel operations. We provide an efficient, reliable, and user-friendly platform for managing all your hotel activities seamlessly.</p>
					
					<ul class="list-unstyled d-flex flex-wrap mt-4" style="gap: 20px;">
						<li class="d-flex align-items-center mb-3 w-100" style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
							<div class="icon d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%; margin-right: 20px;">
								<span class="ion-ios-bed" style="font-size: 24px;"></span>
							</div>
							<div class="text">
								<h5 style="margin-bottom: 5px; font-weight: 600;">Luxury Rooms</h5>
								<p style="margin: 0; color: #777; font-size: 14px;">Experience top-tier comfort and aesthetics.</p>
							</div>
						</li>
						<li class="d-flex align-items-center mb-3 w-100" style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
							<div class="icon d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%; margin-right: 20px;">
								<span class="ion-ios-checkmark-circle-outline" style="font-size: 24px;"></span>
							</div>
							<div class="text">
								<h5 style="margin-bottom: 5px; font-weight: 600;">Easy Booking</h5>
								<p style="margin: 0; color: #777; font-size: 14px;">Seamless reservation process with real-time updates.</p>
							</div>
						</li>
					</ul>
					
					<div class="mt-5">
						<a href="#" class="btn btn-primary py-3 px-4" style="border-radius: 30px; font-weight: 600; padding: 15px 30px !important;">Discover More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- end about us -->

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2 class="mb-4">Our Rooms</h2>
			</div>
		</div>
		<div class="row" id="available-rooms-list">
			@foreach ($rooms as $room )
                @include('hotal.partials.room_card', ['room' => $room])
			@endforeach
		</div>

	</div>


	</div>
	</div>
	</div>
</section>


<!-- testmonial part -->
<section class="ftco-section testimony-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 ftco-animate">
				<div class="row ftco-animate">
					<div class="col-md-12">
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
										<p class="mb-4">No reviews yet. Be the first to leave one!</p>
									</div>
								</div>
							</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



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
                    
                    // Dynamic update of rooms list
                    $('#available-rooms-list').html(response.html);
                    
                    // Scroll to rooms section
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
@endsection