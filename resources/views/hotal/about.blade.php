@extends('layout.app')
@section('title', 'About')

@section('content')

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
	/* Wider content band + horizontal breathing room */
	.about-section .static-wide {
		max-width: min(1480px, calc(100vw - 32px));
		padding-left: 1.25rem;
		padding-right: 1.25rem;
	}
	@media (min-width: 768px) {
		.about-section .static-wide {
			padding-left: 2rem;
			padding-right: 2rem;
		}
	}
	@media (min-width: 1200px) {
		.about-section .static-wide {
			padding-left: 2.5rem;
			padding-right: 2.5rem;
		}
	}

	.about-row > [class*="col-"] { display: flex; flex-direction: column; }
	.about-visual {
		flex: 1 1 auto;
		width: 100%;
		min-height: 440px;
		border-radius: 16px;
		background-size: cover;
		background-position: center;
		box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
		border: 1px solid rgba(0,0,0,0.04);
	}
	@media (min-width: 992px) {
		.about-visual {
			min-height: max(580px, 52vh);
		}
	}
	@media (min-width: 1400px) {
		.about-visual {
			min-height: max(640px, 50vh);
		}
	}
	.about-card {
		background: #f8fafc;
		border: 1px solid #e2e8f0;
		border-radius: 12px;
		padding: 1.1rem 1.25rem;
		transition: border-color 0.2s, box-shadow 0.2s;
	}
	.about-card:hover {
		border-color: rgba(248, 89, 89, 0.35);
		box-shadow: 0 8px 28px rgba(248, 89, 89, 0.08);
	}
	.about-card .icon {
		width: 52px;
		height: 52px;
		background: #f85959;
		color: #fff;
		border-radius: 50%;
		flex-shrink: 0;
	}
	.about-copy { color: #64748b; font-size: 1.02rem; line-height: 1.8; }
	.about-sub {
		color: #f85959;
		font-weight: 600;
		letter-spacing: 0.16em;
		text-transform: uppercase;
		font-size: 12px;
		display: block;
		margin-bottom: 0.4rem;
	}
	.about-section {
		padding-top: 3.5rem;
		padding-bottom: 4.5rem;
		margin-top: 0;
		margin-bottom: 0;
	}
	@media (min-width: 768px) {
		.about-section {
			padding-top: 4.5rem;
			padding-bottom: 5.5rem;
		}
	}
	@media (min-width: 992px) {
		.about-section {
			padding-top: 5.5rem;
			padding-bottom: 6.5rem;
		}
	}

	.about-cta {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 0.75rem 1rem;
	}
	.about-cta .btn-primary {
		border-radius: 999px;
		font-weight: 600;
		padding: 0.65rem 1.5rem;
	}
	.about-cta .btn-outline-gold {
		border-radius: 999px;
		font-weight: 600;
		padding: 0.65rem 1.5rem;
		color: #8d703b;
		border: 2px solid #8d703b;
		background: transparent;
	}
	.about-cta .btn-outline-gold:hover {
		background: #8d703b;
		color: #fff;
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
							<span class="active-crumb">About</span>
						</p>
						<h1 class="mb-2 bread">About us</h1>
						<p class="text-white mb-0 mx-auto" style="max-width: 34rem; opacity: 0.9;">
							StayEase — a Laravel-based hotel management experience built for your FYP demonstration.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section bg-light about-section">
		<div class="container-fluid static-wide">
			<div class="row align-items-lg-stretch about-row">
				<div class="col-lg-6 mb-4 mb-lg-0 pr-lg-4 ftco-animate">
					<div class="about-visual" style="background-image: url('{{ asset('assets/hotal/grand2.jpg') }}');"></div>
				</div>
				<div class="col-lg-6 pl-lg-4 ftco-animate d-flex flex-column">
					<div class="heading-section heading-section-wo-line mb-4">
						<span class="about-sub">Our system</span>
						<h2 class="mb-3" style="font-weight: 700; color: #232323;">About StayEase Hotel Management System</h2>
					</div>
					<p class="about-copy mb-4">
						StayEase is a comprehensive web application developed as a <strong class="text-dark">Final Year Project</strong> to simplify hotel operations and improve the guest journey. It covers room booking, guest information, billing, and day-to-day administration in one secure, organized place.
					</p>
					<p class="about-copy mb-4">
						Administrators get a clear dashboard for inventory, bookings, and records. <strong class="text-dark">Role-based access</strong> limits sensitive actions, while reporting helps management see performance at a glance.
					</p>
					<ul class="list-unstyled mt-4 mb-0">
						<li class="d-flex align-items-start mb-3 about-card">
							<div class="icon d-flex align-items-center justify-content-center mr-3">
								<span class="ion-ios-lock" style="font-size: 22px;"></span>
							</div>
							<div>
								<h5 class="mb-1 font-weight-bold text-dark">Secure &amp; reliable</h5>
								<p class="mb-0 small text-muted">Role-based access and sensible defaults to protect guest and hotel data.</p>
							</div>
						</li>
						<li class="d-flex align-items-start mb-0 about-card">
							<div class="icon d-flex align-items-center justify-content-center mr-3">
								<span class="ion-ios-analytics" style="font-size: 22px;"></span>
							</div>
							<div>
								<h5 class="mb-1 font-weight-bold text-dark">Insightful reporting</h5>
								<p class="mb-0 small text-muted">Summaries and records that support better operational decisions.</p>
							</div>
						</li>
					</ul>
					<div class="mt-auto pt-4 about-cta">
						<a href="{{ route('room') }}" class="btn btn-primary">Browse rooms</a>
						<a href="{{ route('contact') }}" class="btn btn-outline-gold">Contact</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
@endsection
