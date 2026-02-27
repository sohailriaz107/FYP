@extends('layout.app')
@section('title','contact')
@section('content')




<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
                    <h1 class="mb-4 bread">Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="ftco-section contact-section bg-light" style="padding: 6em 0;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center mb-5">
                <span class="subheading" style="color: #f85959; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">Get In Touch</span>
                <h2 class="h2 mb-4" style="font-weight: 700; color: #232323;">Contact Information</h2>
            </div>
            
            <div class="col-md-3 d-flex pb-5">
                <div class="info bg-white p-4 w-100 text-center" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="icon d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px; background: #f85959; color: white; border-radius: 50%;">
                        <span class="ion-ios-pin" style="font-size: 28px;"></span>
                    </div>
                    <p style="font-weight: 600; color: #333; margin-bottom: 5px;">Address:</p>
                    <p style="color: #666; font-size: 14px; margin: 0;">{{ $admin && $admin->address ? $admin->address : '198 West 21th Street, Suite 721 New York NY 10016' }}</p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex pb-5">
                <div class="info bg-white p-4 w-100 text-center" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="icon d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px; background: #f85959; color: white; border-radius: 50%;">
                        <span class="ion-ios-call" style="font-size: 28px;"></span>
                    </div>
                    <p style="font-weight: 600; color: #333; margin-bottom: 5px;">Phone:</p>
                    <p style="color: #666; font-size: 14px; margin: 0;"><a href="tel://{{ $admin && $admin->phone ? $admin->phone : '1234567920' }}" style="color: #f85959;">{{ $admin && $admin->phone ? $admin->phone : '+1235 2355 98' }}</a></p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex pb-5">
                <div class="info bg-white p-4 w-100 text-center" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="icon d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px; background: #f85959; color: white; border-radius: 50%;">
                        <span class="ion-ios-mail" style="font-size: 28px;"></span>
                    </div>
                    <p style="font-weight: 600; color: #333; margin-bottom: 5px;">Email:</p>
                    <p style="color: #666; font-size: 14px; margin: 0; word-break: break-all;"><a href="mailto:{{ $admin && $admin->email ? $admin->email : 'info@yoursite.com' }}" style="color: #f85959;">{{ $admin && $admin->email ? $admin->email : 'info@yoursite.com' }}</a></p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex pb-5">
                <div class="info bg-white p-4 w-100 text-center" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <div class="icon d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 60px; height: 60px; background: #f85959; color: white; border-radius: 50%;">
                        <span class="ion-ios-globe" style="font-size: 28px;"></span>
                    </div>
                    <p style="font-weight: 600; color: #333; margin-bottom: 5px;">Website:</p>
                    <p style="color: #666; font-size: 14px; margin: 0;"><a href="{{ url('/') }}" style="color: #f85959;">StayEase HMS</a></p>
                </div>
            </div>
        </div>
        
        <div class="row block-9" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <div class="col-md-6 order-md-last d-flex p-0">
                <!-- message  -->
                <form action="{{ route('contact.send') }}" method="POST" class="contact-form w-100" style="padding: 50px;">
                    @csrf
                    <h3 class="mb-4" style="font-weight: 700;">Send a Message</h3>
                    @if(Session::has('success'))
                        <div class="alert alert-success mt-3" style="border-radius: 8px;">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="form-group mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required style="border-radius: 8px; padding: 15px; height: auto; background: #f9f9f9; border: 1px solid #eee;">
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required style="border-radius: 8px; padding: 15px; height: auto; background: #f9f9f9; border: 1px solid #eee;">
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required style="border-radius: 8px; padding: 15px; height: auto; background: #f9f9f9; border: 1px solid #eee;">
                    </div>
                    <div class="form-group mb-4">
                        <textarea name="message" id="" cols="30" rows="6" class="form-control" placeholder="Message" required style="border-radius: 8px; padding: 15px; background: #f9f9f9; border: 1px solid #eee;"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary py-3 px-5 w-100" style="border-radius: 8px; font-weight: 600; font-size: 16px;">Send Message</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 d-flex p-0">
                <div class="w-100" style="min-height: 500px;">
                    <iframe 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        style="border:0;" 
                        allowfullscreen 
                        src="https://maps.google.com/maps?q={{ urlencode($admin && $admin->address ? $admin->address : 'New York, USA') }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection