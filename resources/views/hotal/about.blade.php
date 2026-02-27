@extends('layout.app')
@section('title','about')
@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
                    <h1 class="mb-4 bread">About Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>



<section class="ftco-section ftc-no-pb ftc-no-pt">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 p-md-5 img img-2 img-3 d-flex justify-content-center align-items-center" style="background-image: url('{{ asset('assets/images/about.jpg') }}'); min-height: 500px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
            <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                <div class="heading-section heading-section-wo-line pt-md-5 pl-md-5 mb-5">
                    <div class="ml-md-0">
                        <span class="subheading" style="color: #f85959; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">Our System</span>
                        <h2 class="mb-4" style="font-weight: 700; color: #232323;">About StayEase Hotel Management System</h2>
                    </div>
                </div>
                <div class="pb-md-5 pl-md-5">
                    <p style="color: #666; font-size: 16px; line-height: 1.8; margin-bottom: 25px;">StayEase Hotel Management System is a comprehensive web-based application developed as a Final Year Project to simplify hotel operations and enhance the guest experience. The system is designed to manage key aspects of hotel management, including room booking, guest information, billing, and administrative tasks, in a secure and organized manner.</p>
                    <p style="color: #666; font-size: 16px; line-height: 1.8; margin-bottom: 25px;">For hotel administrators, the system offers a powerful and intuitive dashboard to manage room inventories, bookings, and guest records. Role-based access ensures that only authorized personnel can make critical updates, maintaining data security and integrity. The system also generates reports and provides insights into hotel performance, helping management make informed decisions.</p>
                 
                    <ul class="list-unstyled d-flex flex-wrap mt-4" style="gap: 20px;">
                        <li class="d-flex align-items-center mb-3 w-100" style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                            <div class="icon d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%; margin-right: 20px;">
                                <span class="ion-ios-lock" style="font-size: 24px;"></span>
                            </div>
                            <div class="text">
                                <h5 style="margin-bottom: 5px; font-weight: 600;">Secure & Reliable</h5>
                                <p style="margin: 0; color: #777; font-size: 14px;">Role-based access ensuring data security and integrity.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-3 w-100" style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                            <div class="icon d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: #f85959; color: white; border-radius: 50%; margin-right: 20px;">
                                <span class="ion-ios-stats" style="font-size: 24px;"></span>
                            </div>
                            <div class="text">
                                <h5 style="margin-bottom: 5px; font-weight: 600;">Insightful Reports</h5>
                                <p style="margin: 0; color: #777; font-size: 14px;">Generate performance details to aid decision making.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>





@endsection