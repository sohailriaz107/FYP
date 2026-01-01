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


<section class="ftco-section ftc-no-pb ftc-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center"
				style="background-image: url('{{ asset('assets/images/bg_2.jpg') }}');">
				<a href="https://vimeo.com/45830194"
					class="icon popup-vimeo d-flex justify-content-center align-items-center">
					<span class="icon-play"></span>
				</a>
			</div>
			<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
				<div class="heading-section heading-section-wo-line pt-md-5 pl-md-5 mb-5">
					<div class="ml-md-0">
						<span class="subheading">Welcome to Deluxe Hotel</span>
						<h2 class="mb-4">Welcome To Our Hotel</h2>
					</div>
				</div>
				<div class="pb-md-5">
					<p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it
						would have been rewritten a thousand times and everything that was left from its origin
						would be the word "and" and the Little Blind Text should turn around and return to its own,
						safe country. But nothing the copy said could convince her and so it didn’t take long until
						a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged
						her into their agency, where they abused her for their.</p>
					<p>When she reached the first hills of the Italic Mountains, she had a last view back on the
						skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of
						her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she
						continued her way.</p>
					<ul class="ftco-social d-flex">
						<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row d-flex">
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-reception-bell"></span>
						</div>
					</div>
					<div class="media-body p-2 mt-2">
						<h3 class="heading mb-3">25/7 Front Desk</h3>
						<p>A small river named Duden flows by their place and supplies.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-serving-dish"></span>
						</div>
					</div>
					<div class="media-body p-2 mt-2">
						<h3 class="heading mb-3">Restaurant Bar</h3>
						<p>A small river named Duden flows by their place and supplies.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex align-sel Searchf-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-car"></span>
						</div>
					</div>
					<div class="media-body p-2 mt-2">
						<h3 class="heading mb-3">Transfer Services</h3>
						<p>A small river named Duden flows by their place and supplies.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services py-4 d-block text-center">
					<div class="d-flex justify-content-center">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="flaticon-spa"></span>
						</div>
					</div>
					<div class="media-body p-2 mt-2">
						<h3 class="heading mb-3">Spa Suites</h3>
						<p>A small river named Duden flows by their place and supplies.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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



<section class="ftco-section testimony-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 ftco-animate">
				<div class="row ftco-animate">
					<div class="col-md-12">
						<div class="carousel-testimony owl-carousel ftco-owl">
							<div class="item">
								<div class="testimony-wrap py-4 pb-5">
									<div class="user-img mb-4" style="background-image: url('{{ asset('assets/images/person_1.jpg') }}');">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="icon-quote-left"></i>
										</span>
									</div>
									<div class="text text-center">
										<p class="mb-4">A small river named Duden flows by their place and supplies
											it with the necessary regelialia. It is a paradisematic country, in
											which roasted parts of sentences fly into your mouth.</p>
										<p class="name">Nathan Smith</p>
										<span class="position">Guests</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4 pb-5">
									<div class="user-img mb-4" style="background-image: url('{{ asset('assets/images/person_2.jpg') }}');">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="icon-quote-left"></i>
										</span>
									</div>
									<div class="text text-center">
										<p class="mb-4">A small river named Duden flows by their place and supplies
											it with the necessary regelialia. It is a paradisematic country, in
											which roasted parts of sentences fly into your mouth.</p>
										<p class="name">Nathan Smith</p>
										<span class="position">Guests</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4 pb-5">
									<div class="user-img mb-4" style="background-image: url('{{ asset('assets/images/person_3.jpg') }}');">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="icon-quote-left"></i>
										</span>
									</div>
									<div class="text text-center">
										<p class="mb-4">A small river named Duden flows by their place and supplies
											it with the necessary regelialia. It is a paradisematic country, in
											which roasted parts of sentences fly into your mouth.</p>
										<p class="name">Nathan Smith</p>
										<span class="position">Guests</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4 pb-5">
									<div class="user-img mb-4" style="background-image: url('{{ asset('assets/images/person_1.jpg') }}');">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="icon-quote-left"></i>
										</span>
									</div>
									<div class="text text-center">
										<p class="mb-4">A small river named Duden flows by their place and supplies
											it with the necessary regelialia. It is a paradisematic country, in
											which roasted parts of sentences fly into your mouth.</p>
										<p class="name">Nathan Smith</p>
										<span class="position">Guests</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="testimony-wrap py-4 pb-5">
									<div class="user-img mb-4" style="background-image: url('{{ asset('assets/images/person_1.jpg') }}');">
										<span class="quote d-flex align-items-center justify-content-center">
											<i class="icon-quote-left"></i>
										</span>
									</div>
									<div class="text text-center">
										<p class="mb-4">A small river named Duden flows by their place and supplies
											it with the necessary regelialia. It is a paradisematic country, in
											which roasted parts of sentences fly into your mouth.</p>
										<p class="name">Nathan Smith</p>
										<span class="position">Guests</span>
									</div>
								</div>
							</div>
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