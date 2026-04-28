@extends('layout.app')
@section('title', 'Rooms')

@section('content')

<style>
	.rooms-page { overflow-x: hidden; }
	.rooms-page-hero {
		position: relative;
		min-height: 320px;
		background-size: cover;
		background-position: center;
		border-radius: 0;
	}
	.rooms-page-hero .overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(135deg, rgba(15, 23, 42, 0.82) 0%, rgba(15, 23, 42, 0.5) 100%);
		opacity: 1;
	}
	.rooms-page-hero .slider-text {
		position: relative;
		z-index: 1;
		min-height: 320px;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 3rem 1rem;
	}
	.rooms-page-hero .bread {
		font-weight: 600;
		letter-spacing: 0.02em;
		text-shadow: 0 4px 20px rgba(0,0,0,0.35);
	}
	.rooms-page-hero .breadcrumbs {
		margin-bottom: 0.75rem !important;
	}
	.rooms-page-hero .breadcrumbs span {
		border-bottom: none !important;
		font-size: 12px;
		letter-spacing: 0.14em;
	}
	.rooms-page-hero .breadcrumbs a {
		color: rgba(255,255,255,0.85) !important;
		text-decoration: none;
	}
	.rooms-page-hero .breadcrumbs a:hover {
		color: #fff !important;
	}
	.rooms-page-hero .breadcrumbs .active-crumb {
		color: #f85959;
		font-weight: 600;
	}

	.rooms-ai-wrap {
		background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
		border-bottom: 1px solid #e2e8f0;
		padding-top: 2.5rem;
		padding-bottom: 2.5rem;
	}
	.rooms-ai-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 16px 50px rgba(15, 23, 42, 0.08);
		border: 1px solid rgba(226, 232, 240, 0.9);
		padding: 1.75rem 1.5rem 2rem;
	}
	@media (min-width: 768px) {
		.rooms-ai-card { padding: 2rem 2.25rem 2.25rem; }
	}
	.rooms-ai-badge {
		display: inline-block;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: 0.16em;
		text-transform: uppercase;
		color: #f85959;
		background: rgba(248, 89, 89, 0.1);
		padding: 0.35rem 0.85rem;
		border-radius: 999px;
		margin-bottom: 0.65rem;
	}
	.rooms-ai-card h3 {
		font-weight: 700;
		color: #1e293b;
		font-size: 1.35rem;
	}
	.rooms-ai-card .form-control {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		padding: 0.65rem 0.9rem;
		height: auto;
		min-height: 46px;
	}
	.rooms-ai-card .form-control:focus {
		border-color: rgba(248, 89, 89, 0.45);
		box-shadow: 0 0 0 3px rgba(248, 89, 89, 0.12);
	}
	.rooms-ai-card textarea.form-control {
		min-height: 52px;
	}
	.rooms-ai-card .btn-ai {
		border-radius: 999px;
		font-weight: 600;
		padding: 0.65rem 1.75rem;
	}

	.rooms-catalog {
		padding-top: 3rem;
		padding-bottom: 4rem;
	}
	/* Wider layout than default Bootstrap .container (~1140px) */
	.rooms-catalog-wide {
		width: 100%;
		max-width: min(1920px, calc(100vw - 20px));
		margin-left: auto;
		margin-right: auto;
		padding-left: 0.75rem;
		padding-right: 0.75rem;
	}
	@media (min-width: 768px) {
		.rooms-catalog-wide {
			max-width: min(1920px, calc(100vw - 32px));
			padding-left: 1.25rem;
			padding-right: 1.25rem;
		}
	}
	@media (min-width: 1400px) {
		.rooms-catalog-wide {
			padding-left: 2rem;
			padding-right: 2rem;
		}
	}
	.rooms-ai-wrap .rooms-catalog-wide {
		max-width: min(1920px, calc(100vw - 20px));
	}
	.rooms-catalog .heading-section-wo-line h2 {
		font-weight: 700;
		color: #232323;
	}
	.rooms-catalog .subheading {
		color: #f85959;
		font-weight: 600;
		letter-spacing: 0.16em;
		text-transform: uppercase;
		font-size: 12px;
		display: block;
		margin-bottom: 0.4rem;
	}

	.rooms-sidebar-card {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 12px 40px rgba(15, 23, 42, 0.07);
		border: 1px solid #e8ecf1;
		padding: 1.5rem 1.35rem 1.75rem;
	}
	.rooms-sidebar-card h3 {
		font-size: 1.1rem;
		font-weight: 700;
		color: #1e293b;
		padding-bottom: 0.75rem;
		margin-bottom: 1rem !important;
		border-bottom: 2px solid rgba(248, 89, 89, 0.2);
	}
	.rooms-sidebar-card .form-control {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		padding: 0.6rem 0.85rem;
	}
	.rooms-sidebar-card .form-control:focus {
		border-color: rgba(141, 112, 59, 0.5);
		box-shadow: 0 0 0 3px rgba(141, 112, 59, 0.12);
	}
	.rooms-sidebar-card .btn-search {
		border-radius: 10px;
		width: 100%;
		font-weight: 600;
		padding: 0.75rem 1rem;
	}
	@media (min-width: 992px) {
		.rooms-sidebar-sticky {
			position: sticky;
			top: 100px;
		}
	}

	.rooms-page #rooms-list .room {
		border-radius: 12px;
		overflow: hidden;
		background: #fff;
		box-shadow: 0 10px 35px rgba(15, 23, 42, 0.07);
	}
	.rooms-page #rooms-list .room .text {
		border: none !important;
	}
	.rooms-page #rooms-list .room .img {
		height: 240px;
		min-height: 220px;
	}
</style>

<div class="rooms-page">

	<!-- Hero -->
	<div class="hero-wrap rooms-page-hero" style="background-image: url('{{ asset('assets/hotal/grand2.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-10 col-lg-8 text-center ftco-animate">
					<div class="text w-100">
						<p class="breadcrumbs mb-2">
							<span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
							<span class="mr-2">/</span>
							<span class="active-crumb">Rooms</span>
						</p>
						<h1 class="mb-0 bread">Our rooms</h1>
						<p class="text-white mt-3 mb-0 mx-auto" style="max-width: 32rem; opacity: 0.88; font-size: 1rem;">
							Browse every listing, filter by dates, or let AI suggest a match for your budget.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- AI recommendation -->
	<section class="rooms-ai-wrap">
		<div class="container-fluid rooms-catalog-wide">
			<div class="rooms-ai-card ftco-animate">
				<div class="row align-items-center mb-3 mb-md-4">
					<div class="col-lg-7 text-center text-lg-left">
						<span class="rooms-ai-badge">Smart pick</span>
						<h3 class="mb-2">AI room recommendation</h3>
						<p class="text-muted mb-0" style="font-size: 0.95rem; line-height: 1.6;">
							Add your budget, optional room type, and a short note—get a focused suggestion for your stay.
						</p>
					</div>
				</div>
				<form id="ai-recommendation-form" method="POST" action="{{ route('ai.recommend') }}">
					@csrf
					<div class="row">
						<div class="col-md-4 mb-3 mb-md-0">
							<label class="d-block small font-weight-bold text-muted mb-1" for="ai_budget">Budget (per night)</label>
							<input type="number" class="form-control" id="ai_budget" name="budget" placeholder="e.g. 5000" required min="1">
						</div>
						<div class="col-md-4 mb-3 mb-md-0">
							<label class="d-block small font-weight-bold text-muted mb-1" for="ai_room_type">Preferred type</label>
							<select class="form-control" id="ai_room_type" name="room_type">
								<option value="">Any type (optional)</option>
								@foreach($room_types as $type)
									<option value="{{ $type->name }}">{{ $type->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 mb-3 mb-md-0">
							<label class="d-block small font-weight-bold text-muted mb-1" for="ai_preferences">Preferences</label>
							<textarea id="ai_preferences" name="preferences" class="form-control" rows="2"
								placeholder="e.g. quiet floor, WiFi, near elevator"></textarea>
						</div>
					</div>
					<div class="text-center text-lg-left mt-2">
						<button type="submit" class="btn btn-primary btn-ai">Get AI recommendation</button>
					</div>
				</form>
			</div>
		</div>
	</section>

	<!-- Catalog + sidebar -->
	<section class="ftco-section bg-light rooms-catalog">
		<div class="container-fluid rooms-catalog-wide">
			<div class="row">
				<div class="col-lg-9 pr-lg-4 mb-5 mb-lg-0">
					<div class="heading-section heading-section-wo-line ftco-animate mb-4">
						<span class="subheading">Accommodation</span>
						<h2 class="mb-2">Room directory</h2>
						<p class="text-muted mb-0" style="max-width: 48rem;">
							Each card shows live status, capacity, and nightly rate. Use the panel on the right to search by stay dates.
						</p>
					</div>
					<div class="row" id="rooms-list">
						@foreach ($rooms as $room)
							@include('hotal.partials.room_card', ['room' => $room, 'roomsFourColumns' => true])
						@endforeach
					</div>
				</div>
				<div class="col-lg-3">
					<div class="rooms-sidebar-sticky">
						<div class="sidebar-wrap rooms-sidebar-card ftco-animate">
							<h3 class="heading mb-0">Search by dates</h3>
							<p class="small text-muted mb-3">Find types free for your check-in and check-out.</p>
							<form action="{{ route('check.availability') }}" method="POST" id="rooms-search-form">
								@csrf
								<input type="hidden" name="rooms_catalog" value="1">
								<div class="fields">
									<div class="form-group mb-3">
										<label class="small font-weight-bold text-muted d-block mb-1" for="checkin_date">Check-in</label>
										<input type="text" name="check_in" id="checkin_date" class="form-control checkin_date"
											placeholder="Check-in date" required autocomplete="off">
									</div>
									<div class="form-group mb-3">
										<label class="small font-weight-bold text-muted d-block mb-1" for="checkout_date">Check-out</label>
										<input type="text" name="check_out" id="checkout_date" class="form-control checkout_date"
											placeholder="Check-out date" required autocomplete="off">
									</div>
									<div class="form-group mb-3">
										<label class="small font-weight-bold text-muted d-block mb-1" for="room_type">Room type</label>
										<div class="select-wrap one-third">
											<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="room_type" id="room_type" class="form-control" required>
												<option value="">Select room type</option>
												@foreach($room_types as $type)
													<option value="{{ $type->id }}">{{ $type->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group mb-0">
										<input type="submit" value="Search availability" class="btn btn-primary py-3 btn-search">
									</div>
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
	$(document).ready(function() {
		$('#ai-recommendation-form').on('submit', function(e) {
			e.preventDefault();

			Swal.fire({
				title: 'Thinking...',
				text: 'Finding the best room for you',
				allowOutsideClick: false,
				didOpen: function() { Swal.showLoading(); }
			});

			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					if (response.status === 'success') {
						Swal.fire({
							icon: 'success',
							title: 'AI recommendation',
							text: response.message,
							confirmButtonText: 'Great!'
						});
						$('#rooms-list').hide().html(response.html).fadeIn(500);
					} else {
						Swal.fire('Error', response.message, 'error');
					}
				},
				error: function(xhr) {
					var message = 'Failed to get recommendation.';
					if (xhr.status === 401) {
						message = 'Unauthorized: please check your OpenAI API key.';
					} else if (xhr.responseJSON && xhr.responseJSON.message) {
						message = xhr.responseJSON.message;
					}
					Swal.fire('Error', message, 'error');
				}
			});
		});

		$('#rooms-search-form').on('submit', function(e) {
			e.preventDefault();

			var formData = $(this).serialize();

			$.ajax({
				url: $(this).attr('action'),
				type: 'POST',
				data: formData,
				success: function(response) {
					if (response.status === 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Found',
							text: response.message + ' (' + response.available_count + ' rooms)',
							timer: 2000,
							showConfirmButton: false
						});
						$('#rooms-list').hide().html(response.html).fadeIn(500);
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Not available',
							text: response.message
						});
					}
				},
				error: function(xhr) {
					var message = 'Something went wrong. Please try again.';
					if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
						message = Object.values(xhr.responseJSON.errors).flat().join('\n');
					}
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: message
					});
				}
			});
		});
	});
</script>
@endsection
