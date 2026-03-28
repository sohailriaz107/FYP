	@php
    $admin = \App\Models\User::where('role', 'admin')->first();
@endphp

<footer class="ftco-footer ftco-bg-dark" style="padding: 50px 0 20px 0;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">StayEase HMS</h2>
                    <p>StayEase HMS provides a premium hospitality experience with seamless room bookings and world-class amenities designed for your comfort.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-4">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Navigation</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="py-2 d-block">Home</a></li>
                        <li><a href="{{ route('room') }}" class="py-2 d-block">Rooms</a></li>
                        
                        <li><a href="{{ route('about') }}" class="py-2 d-block">About Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Information</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('profile') }}" class="py-2 d-block">My Account</a></li>
                        <li><a href="{{ route('contact') }}" class="py-2 d-block">Contact Us</a></li>
                        <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
                        <li><a href="#" class="py-2 d-block">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">{{ $admin && $admin->address ? $admin->address : '198 West 21th Street, New York, USA' }}</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{ $admin && $admin->phone ? $admin->phone : '+1235 2355 98' }}</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{ $admin && $admin->email ? $admin->email : 'info@stayease.com' }}</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | <strong>StayEase HMS</strong>
                </p>
            </div>
        </div>
    </div>
</footer>
