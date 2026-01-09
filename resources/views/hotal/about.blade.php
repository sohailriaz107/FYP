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
        <div class="row">
          
            <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                <div class="heading-section heading-section-wo-line pt-md-5 pl-md-5 mb-5">
                    <div class="ml-md-0">
                        
                        <h2 class="mb-2">About StayEase Hotel Management System</h2>
                    </div>
                </div>
                <div class="pb-md-5">
                    <p style="color: black;font-weight:400px">StayEase Hotel Management System is a comprehensive web-based application developed as a Final Year Project to simplify hotel operations and enhance the guest experience. The system is designed to manage key aspects of hotel management, including room booking, guest information, billing, and administrative tasks, in a secure and organized manner.</p>
                    <p style="color: black;font-weight:400px">For hotel administrators, the system offers a powerful and intuitive dashboard to manage room inventories, bookings, and guest records. Role-based access ensures that only authorized personnel can make critical updates, maintaining data security and integrity. The system also generates reports and provides insights into hotel performance, helping management make informed decisions.</p>
                 
                </div>
            </div>
        </div>
    </div>
</section>





@endsection