@extends('layout.app')
@section('title','User Profile')
@section('content')

<div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
            <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
                <div class="text">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Profile</span></p>
                    <h1 class="mb-4 bread">User Profile</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="text-center">
            <h3>User Profile</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="left_sidebar">
                    <h3><a href="#basic_info">Basic Information</a></h3>
                    <h3><a href="#basic_info">Acount Details</a></h3>
                    <h3><a href="#basic_info">Activity & History</a></h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right_sidebar">
                    <div id="basic_info">
                        <div>
                            <img src="" alt="profile" class="rounded_cirle">
                        </div>

                        <h2 for="name">Full Name</h2>
                        <h5>{{ Auth::user()->name }}</h5>

                        <h2 for="email">Email</h2>
                        <h5>{{ Auth::user()->email }}</h5>

                        <h2 for="phone">Phone</h2>
                        <h5>{{ Auth::user()->phone }}</h5>
                        <label for="address">Address</label>

                    </div>
                    <div id="basic_info">
                        <div>
                            <img src="" alt="profile" class="rounded_cirle">
                        </div>

                        <h2 for="name">Password</h2>
                        <h5>{{ Auth::user()->name }}</h5>

                        <h2 for="email">Email</h2>
                        <h5>{{ Auth::user()->email }}</h5>

                        <h2 for="phone">Phone</h2>
                        <h5>{{ Auth::user()->phone }}</h5>
                        <label for="address">Address</label>

                    </div>
                    <!-- ACTIVITY  -->
                     <div id="basic_info">
                        <div>
                            <img src="" alt="profile" class="rounded_cirle">
                        </div>

                        <h2 for="name">Full Name</h2>
                        <h5>{{ Auth::user()->name }}</h5>

                        <h2 for="email">Email</h2>
                        <h5>{{ Auth::user()->email }}</h5>

                        <h2 for="phone">Phone</h2>
                        <h5>{{ Auth::user()->phone }}</h5>
                        <label for="address">Address</label>

                    </div>
                </div>
            </div>
        </div>
        <!-- Acount Details -->


    </div>
</section>







@endsection