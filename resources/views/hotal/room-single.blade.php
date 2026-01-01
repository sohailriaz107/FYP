@extends('layout.app')
@section('title','room-details')
@section('content')



<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
			<div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
				<div class="text">
					<p class="breadcrumbs mb-2" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="rooms.html">Room</a></span> <span>Room Single</span></p>
					<h1 class="mb-4 bread">Room Single</h1>
				</div>
			</div>
		</div>
	</div>
</div>


<section class="ftco-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
						<h2 class="mb-4">{{$room->roomType->name}}</h2>
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
					<div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
						<p>{{$room->roomType->description}}</p>
						<div class="d-md-flex mt-5 mb-5">
							<ul class="list">
								<li><span>Max Person :</span> {{$room->roomType->max_persons}} </li>
								<li><span>Size : </span>{{$room->roomType->room_size}}</li>
							</ul>
							<ul class="list ml-md-5">
								<li><span>Room No: </span>{{$room->room_number}}</li>
								<li><span>Bed:</span>{{$room->roomType->beds}}</li>
							</ul>
						</div>

					</div>
					<!-- Amenties -->
					<div class="row">
						<div class="col-md-12 room-single mt-3 mb-3" style="text-align: center;">
							<h3>Amenities of this Room</h3>
							<div class="d-flex flex-wrap mt-4">
								@foreach($room->amenities as $amenity)
								<div class="text-center m-2" style="width: 150px;">
									<div style="border: 1px solid black; padding: 5px;">
										<img src="{{ asset('storage/' . $amenity->icon) }}"
											alt="{{ $amenity->name }}"
											class="img-fluid"
											style="width:100%; height:100px; object-fit: contain;">
									</div>
									<span class="d-block mt-1">{{ $amenity->name }}</span>
								</div>
								@endforeach
							</div>
						</div>
					</div>


					<div class="col-md-12 room-single ftco-animate mb-5 mt-4">
						<h3 class="mb-4">Take A Tour</h3>
						<div class="block-16">
							<figure>
								<img src="{{ asset('assets/images/room-4.jpg') }}" alt="Image placeholder" class="img-fluid">
								<a href="https://vimeo.com/45830194" class="play-button popup-vimeo"><span class="icon-play"></span></a>
							</figure>
						</div>
					</div>

					<div class="col-md-12 properties-single ftco-animate mb-5 mt-4">
						<h4 class="mb-4">Review &amp; Ratings</h4>
						<div class="row">
							<div class="col-md-6">
								<form method="post" class="star-rating">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">
											<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i> 100 Ratings</span></p>
										</label>
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">
											<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i> 30 Ratings</span></p>
										</label>
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">
											<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i> 5 Ratings</span></p>
										</label>
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">
											<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i> 0 Ratings</span></p>
										</label>
									</div>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">
											<p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i> 0 Ratings</span></p>
										</label>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-12 room-single ftco-animate mb-5 mt-5">
						<h4 class="mb-4"> Others Available {{$room->roomType->name}} Room</h4>
						<div class="row">
							@forelse ( $sameRooms as $sr )
							<div class="col-sm col-md-6 ftco-animate">
								<div class="room">
									<a href="{{ route('room-single', $sr->id) }}" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ $sr->images->count() > 0 ? asset('storage/' . $sr->images->first()->image_path) : asset('assets/images/room-1.jpg') }}')">
										<div class="icon d-flex justify-content-center align-items-center">
											<span class="icon-search2"></span>
										</div>
									</a>
									<div class="text p-3 text-center">
										<h3 class="mb-3"><a href="{{ route('room-single', $sr->id) }}">{{ $sr->roomType->name }}</a></h3>
										<p><span class="price mr-2">$ {{$sr->roomType->base_price}}</span> <span class="per">per night</span></p>
										<p><span>Room Number</span> {{$sr->room_number}}</p>
										<hr>
										<p class="pt-1"><a href="{{ route('room-single', $sr->id) }}" class="btn-custom">View Room Details <span class="icon-long-arrow-right"></span></a></p>
									</div>
								</div>
							</div>
							@empty
							<div class="col-md-12 text-center">
								<h2 class="text-muted" style="color: black;font-size:18px;">No other rooms of {{$room->roomType->name}} currently available.</h2>
							</div>
							@endforelse
						</div>
					</div>

				</div>
			</div> <!-- .col-md-8 -->
			<div class="col-lg-4 sidebar ftco-animate">
						<div id="booking-status-container" style="margin-bottom: 15px; {{ $bookingStatus ? '' : 'display: none;' }}">
							<p style="font-size: 16px; font-weight: 600; color: #2c3e50;text-align:center">
								Booking Status: <span id="current-booking-status" class="badge {{ $bookingStatus == 'booked' ? 'badge-success' : ($bookingStatus == 'cancelled' ? 'badge-danger' : 'badge-warning') }}" style="padding: 8px 12px; border-radius: 20px;">{{ ucfirst($bookingStatus) }}</span>
							</p>
						</div>
				<div class="sidebar-box ftco-animate">
					<div style="max-width:350px; background:#ffffff; padding:25px; border-radius:12px;  font-family:Arial, sans-serif; border:1px solid black">

						<h2 style="text-align:center; margin-bottom:20px;">
							Book Now
						</h2>

						@if(session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif

						@if(session('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						@endif

						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<div id="booking-message" style="margin-bottom: 20px; display: none;"></div>

						<form id="bookingForm" action="{{route('Booking.post')}}" method="post">
							@csrf
							<!-- Check In -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Check-In
							</label>
							<input type="date" name="check_in" required
								style="width:100%; padding:10px; margin:6px 0 15px;
                               border:1px solid #ccc; border-radius:8px; outline:none;">

							<!-- Check Out -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Check-Out
							</label>
							<input type="date" name="check_out" required
								style="width:100%; padding:10px; margin:6px 0 15px;
                         border:1px solid #ccc; border-radius:8px; outline:none;">

							<!-- Max Guest -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Max Guests
							</label>
							<select name="guests"
								style="width:100%; padding:10px; margin:6px 0 20px;
                           border:1px solid #ccc; border-radius:8px; outline:none;">
								<option selected disabled>Select Max Guests</option>
								@for ($i = 1; $i <= $room->roomType->max_persons; $i++)
									<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>

							<!-- Hidden Fields for Room Info -->
							<input type="hidden" name="room_type" value="{{ $room->roomType->name }}">
							<input type="hidden" name="room_no" value="{{ $room->room_number }}">
							<input type="hidden" name="base_price" value="{{ $room->roomType->base_price }}">

							<!-- Submit Button -->
							<input type="submit" value="Book Now"
								style="width:100%; padding:12px; background:#3498db;
                          color:#fff; border:none; border-radius:8px;
                              font-size:16px; font-weight:600; cursor:pointer;">
						</form>
					</div>

				</div>


			</div>
		</div>
	</div>
</section>









@section('scripts')
<script>
$(document).ready(function() {
    $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        
        let $form = $(this);
        let $btn = $form.find('input[type="submit"]');
        let $message = $('#booking-message');
        
        $btn.val('Processing...').prop('disabled', true);
        $message.hide().removeClass('alert alert-success alert-danger').empty();

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            success: function(response) {
                $message.addClass('alert alert-success').text(response.message).fadeIn();
                $form[0].reset();
                $btn.val('Book Now').prop('disabled', false);
            },
            error: function(xhr) {
                let errorMsg = 'An error occurred. Please try again.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    errorMsg = Object.values(errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $message.addClass('alert alert-danger').html(errorMsg).fadeIn();
                $btn.val('Book Now').prop('disabled', false);
            }
        });
    });
});
</script>
@endsection
@endsection