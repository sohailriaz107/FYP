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
					<div class="col-md-12 ftco-animate">
						<h2 class="mb-4">{{$room->roomType->name}}</h2>
						<div class="single-slider owl-carousel">
							<div class="item">
								<div class="room-img" style="background-image: url('{{ asset('assets/images/room-1.jpg') }}')"></div>
							</div>
							<div class="item">
								<div class="room-img" style="background-image: url('{{ asset('assets/images/room-2.jpg') }}')"></div>
							</div>
							<div class="item">
								<div class="room-img" style="background-image: url('{{ asset('assets/images/room-3.jpg') }}')"></div>
							</div>
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
							<div class="col-sm col-md-6 ftco-animate">
								@foreach ( $sameRooms as $sr )
									
								
								<div class="room">
									<a href="rooms.html" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('assets/images/room-1.jpg') }}')">
										<div class="icon d-flex justify-content-center align-items-center">
											<span class="icon-search2"></span>
										</div>
									</a>
									<div class="text p-3 text-center">
										<h3 class="mb-3"><a href="rooms.html"></a></h3>
										<p><span class="price mr-2">$ {{$sr->base_price}}</span> <span class="per">per night</span></p>
										<p><span>Room Number</span> {{$sr->room_number}}</p>
										<hr>
										<p class="pt-1"><a href="" class="btn-custom">View Room Details <span class="icon-long-arrow-right"></span></a></p>
									</div>
								</div>
								@endforeach
							</div>
							<div class="col-sm col-md-6 ftco-animate">
								<div class="room">
									<a href="rooms.html" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('assets/images/room-2.jpg') }}')">
										<div class="icon d-flex justify-content-center align-items-center">
											<span class="icon-search2"></span>
										</div>
									</a>
									<div class="text p-3 text-center">
										<h3 class="mb-3"><a href="rooms.html">Family Room</a></h3>
										<p><span class="price mr-2">$20.00</span> <span class="per">per night</span></p>
										<hr>
										<p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details <span class="icon-long-arrow-right"></span></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div> <!-- .col-md-8 -->
			<div class="col-lg-4 sidebar ftco-animate">

				<div class="sidebar-box ftco-animate">
					<div style="max-width:350px; background:#ffffff; padding:25px; border-radius:12px;  font-family:Arial, sans-serif; border:1px solid black">

						<h2 style="text-align:center; margin-bottom:20px;">
							Book Now
						</h2>

						<form action="">
							<!-- Check In -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Check-In
							</label>
							<input type="date"
								style="width:100%; padding:10px; margin:6px 0 15px;
                              border:1px solid #ccc; border-radius:8px; outline:none;">

							<!-- Check Out -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Check-Out
							</label>
							<input type="date"
								style="width:100%; padding:10px; margin:6px 0 15px;
                         border:1px solid #ccc; border-radius:8px; outline:none;">

							<!-- Max Guest -->
							<label style="font-size:14px; font-weight:600; color:#34495e;">
								Max Guests
							</label>
							<select
								style="width:100%; padding:10px; margin:6px 0 20px;
                           border:1px solid #ccc; border-radius:8px; outline:none;">
								<option selected disabled>Select Max Guests</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>

							<!-- Submit Button -->
							<input type="submit" value="Check Availability"
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









@endsection