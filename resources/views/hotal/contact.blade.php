@extends('layout.app')
@section('title', 'Contact')

@section('content')

@php
	$addr = $admin && $admin->address ? $admin->address : '198 West 21th Street, Suite 721 New York NY 10016';
	$phone = $admin && $admin->phone ? $admin->phone : '+1235 2355 98';
	$email = $admin && $admin->email ? $admin->email : 'info@yoursite.com';
@endphp

<style>
	.static-page { overflow-x: hidden; }
	.static-hero {
		position: relative;
		min-height: 300px;
		background-size: cover;
		background-position: center;
	}
	.static-hero .overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.45) 100%);
		opacity: 1;
	}
	.static-hero .slider-text {
		position: relative;
		z-index: 1;
		min-height: 300px;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 2.5rem 1rem;
	}
	.static-hero .bread { font-weight: 600; text-shadow: 0 4px 20px rgba(0,0,0,0.35); }
	.static-hero .breadcrumbs { margin-bottom: 0.75rem !important; }
	.static-hero .breadcrumbs span { border-bottom: none !important; font-size: 12px; letter-spacing: 0.12em; }
	.static-hero .breadcrumbs a { color: rgba(255,255,255,0.88) !important; text-decoration: none; }
	.static-hero .breadcrumbs a:hover { color: #fff !important; }
	.static-hero .active-crumb { color: #f85959; font-weight: 600; }

	.static-wide {
		width: 100%;
		max-width: min(1200px, calc(100vw - 24px));
		margin-left: auto;
		margin-right: auto;
		padding-left: 1rem;
		padding-right: 1rem;
	}
	@media (min-width: 768px) {
		.static-wide { padding-left: 1.5rem; padding-right: 1.5rem; }
	}

	.contact-info-card {
		background: #fff;
		border-radius: 14px;
		border: 1px solid #e8ecf1;
		box-shadow: 0 10px 36px rgba(15, 23, 42, 0.06);
		padding: 1.35rem 1rem;
		height: 100%;
		transition: box-shadow 0.2s, border-color 0.2s;
	}
	.contact-info-card:hover {
		box-shadow: 0 14px 44px rgba(15, 23, 42, 0.09);
		border-color: rgba(248, 89, 89, 0.2);
	}
	.contact-info-card .icon-wrap {
		width: 56px;
		height: 56px;
		background: rgba(248, 89, 89, 0.12);
		color: #f85959;
		border-radius: 50%;
		margin: 0 auto 0.75rem;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.35rem;
	}
	.contact-info-card a { color: #f85959; font-weight: 600; word-break: break-word; }
	.contact-info-card a:hover { color: #e04a4a; }

	.contact-split {
		background: #fff;
		border-radius: 16px;
		overflow: hidden;
		box-shadow: 0 16px 48px rgba(15, 23, 42, 0.08);
		border: 1px solid #e8ecf1;
	}
	.contact-form-panel { padding: 2rem 1.75rem; }
	@media (min-width: 768px) {
		.contact-form-panel { padding: 2.5rem 2.5rem; }
	}
	.contact-form-panel h3 { font-weight: 700; color: #1e293b; }
	.contact-form-panel .form-control {
		border-radius: 10px;
		border: 1px solid #e2e8f0;
		padding: 0.75rem 1rem;
		background: #f8fafc;
	}
	.contact-form-panel .form-control:focus {
		background: #fff;
		border-color: rgba(141, 112, 59, 0.5);
		box-shadow: 0 0 0 3px rgba(141, 112, 59, 0.12);
	}
	.contact-form-panel .btn-send {
		border-radius: 10px;
		font-weight: 600;
		padding: 0.75rem 1.25rem;
	}
	.contact-map-wrap { min-height: 320px; }
	.contact-map-wrap iframe {
		display: block;
		min-height: 320px;
	}
	@media (min-width: 768px) {
		.contact-split { min-height: 520px; }
		.contact-map-wrap,
		.contact-map-wrap iframe {
			min-height: 520px;
			height: 100%;
		}
	}
	.contact-section-inner { padding-top: 2.5rem; padding-bottom: 4rem; }
	.contact-sub {
		color: #f85959;
		font-weight: 600;
		letter-spacing: 0.16em;
		text-transform: uppercase;
		font-size: 12px;
		display: block;
		margin-bottom: 0.4rem;
	}
</style>

<div class="static-page">

	<div class="hero-wrap static-hero" style="background-image: url('{{ asset('assets/hotal/luxury.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-10 col-lg-8 text-center ftco-animate">
					<div class="text w-100">
						<p class="breadcrumbs mb-2">
							<span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
							<span class="mr-2">/</span>
							<span class="active-crumb">Contact</span>
						</p>
						<h1 class="mb-2 bread">Contact us</h1>
						<p class="text-white mb-0 mx-auto" style="max-width: 34rem; opacity: 0.9;">
							Reach the hotel team or send a message — we will get back as soon as we can.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section bg-light contact-section-inner">
		<div class="container-fluid static-wide">
			<div class="row mb-4 mb-md-5">
				<div class="col-12 text-center ftco-animate mb-4 heading-section heading-section-wo-line">
					<span class="contact-sub">Get in touch</span>
					<h2 class="mb-2" style="font-weight: 700; color: #232323;">Contact information</h2>
					<p class="text-muted mb-0 mx-auto" style="max-width: 36rem;">Details below are pulled from your admin profile when available.</p>
				</div>

				<div class="col-6 col-md-3 mb-4 ftco-animate">
					<div class="contact-info-card text-center h-100">
						<div class="icon-wrap"><span class="ion-ios-pin"></span></div>
						<p class="small font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.06em;">Address</p>
						<p class="small text-muted mb-0">{{ $addr }}</p>
					</div>
				</div>
				<div class="col-6 col-md-3 mb-4 ftco-animate">
					<div class="contact-info-card text-center h-100">
						<div class="icon-wrap"><span class="ion-ios-call"></span></div>
						<p class="small font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.06em;">Phone</p>
						<p class="small mb-0"><a href="tel:{{ preg_replace('/\s+/', '', $phone) }}">{{ $phone }}</a></p>
					</div>
				</div>
				<div class="col-6 col-md-3 mb-4 ftco-animate">
					<div class="contact-info-card text-center h-100">
						<div class="icon-wrap"><span class="ion-ios-mail"></span></div>
						<p class="small font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.06em;">Email</p>
						<p class="small mb-0"><a href="mailto:{{ $email }}">{{ $email }}</a></p>
					</div>
				</div>
				<div class="col-6 col-md-3 mb-4 ftco-animate">
					<div class="contact-info-card text-center h-100">
						<div class="icon-wrap"><span class="ion-ios-globe"></span></div>
						<p class="small font-weight-bold text-dark text-uppercase mb-1" style="letter-spacing: 0.06em;">Website</p>
						<p class="small mb-0"><a href="{{ url('/') }}">StayEase HMS</a></p>
					</div>
				</div>
			</div>

			<div class="row contact-split ftco-animate">
				<div class="col-md-6 order-md-last d-flex">
					<form action="{{ route('contact.send') }}" method="POST" class="contact-form contact-form-panel w-100 d-flex flex-column">
						@csrf
						<h3 class="mb-4">Send a message</h3>
						@if(Session::has('success'))
							<div class="alert alert-success py-2 mb-3">{{ Session::get('success') }}</div>
						@endif
						@if($errors->any())
							<div class="alert alert-danger py-2 mb-3">
								<ul class="mb-0 pl-3">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="form-group">
							<label class="small font-weight-bold text-muted" for="contact_name">Name</label>
							<input type="text" name="name" id="contact_name" class="form-control" placeholder="Your name" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold text-muted" for="contact_email">Email</label>
							<input type="email" name="email" id="contact_email" class="form-control" placeholder="Your email" required>
						</div>
						<div class="form-group">
							<label class="small font-weight-bold text-muted" for="contact_subject">Subject</label>
							<input type="text" name="subject" id="contact_subject" class="form-control" placeholder="Subject" required>
						</div>
						<div class="form-group flex-grow-1 d-flex flex-column">
							<label class="small font-weight-bold text-muted" for="contact_message">Message</label>
							<textarea name="message" id="contact_message" rows="5" class="form-control flex-grow-1" placeholder="Your message" required></textarea>
						</div>
						<div class="form-group mb-0 mt-auto">
							<button type="submit" class="btn btn-primary btn-send w-100">Send message</button>
						</div>
					</form>
				</div>
				<div class="col-md-6 p-0 d-flex">
					<div class="contact-map-wrap w-100">
						<iframe
							title="Location map"
							width="100%"
							height="100%"
							style="border:0;"
							loading="lazy"
							allowfullscreen
							src="https://maps.google.com/maps?q={{ urlencode($addr) }}&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
@endsection
