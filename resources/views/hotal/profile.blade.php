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

<!-- Main Container -->
<div style="width:1100px; margin:40px auto; background:#fff; border-radius:10px; box-shadow:0 10px 30px rgba(0,0,0,0.1); display:flex;">

    <!-- Sidebar -->
    <div style="width:300px; background:linear-gradient(180deg,#b8d7e9,#c7d9ee); padding:30px; border-radius:10px 0 0 10px; color:#fff;">

        <div style="text-align:center;">
            <img src="" style="width:70px; height:70px; border-radius:50%; border:3px solid #fff;">
        </div>

        <div style="margin-top:40px;">
            <p style="font-size:22px; margin:20px 0;font-weight:bold;"> <i class="fa fa-user"></i> Basic Information</p>
           
            <p style="font-size:22px; margin:20px 0; font-weight:bold; "> Activity </p>
            <p style="font-size:22px; margin:20px 0; font-weight:bold; "> Setting</p>
            <p style="font-size:22px; margin:20px 0; font-weight:bold; "> <a href="{{route('admin.logout')}}">Logout</a> </p>
        </div>
    </div>

    <!-- Content -->
    <div style="flex:1; padding:40px;">

        <h2 style="text-align:center; margin-top:0;">User Profile</h2>
        <!-- Profile Image -->
        <div style="text-align:center; margin:30px 0;">

            <div style="position:relative; display:inline-block;">

                <!-- Image Preview -->
                <img id="preview"
                    src="https://via.placeholder.com/130"
                    style="
                width:130px;
                height:130px;
                border-radius:50%;
                border:5px solid #f1f1f1;
                object-fit:cover;
                display:block;
             ">

                <!-- Plus Icon (Centered Bottom) -->
                <i onclick="document.getElementById('fileInput').click()"
                    style="
            position:absolute;
            bottom:11px;
            left:61%;
            transform:translateX(61%);
            width:36px;
            height:36px;
            border-radius:50%;
            background:#2f80ed;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            cursor:pointer;
            box-shadow:0 4px 10px rgba(0,0,0,0.25);
            font-style:normal;
           ">+</i>

                <!-- Hidden File Input -->
                <input type="file"
                    id="fileInput"
                    accept="image/*"
                    onchange="previewImage(event)"
                    style="display:none;">
            </div>
        </div>
        <script>
            function previewImage(event) {
                document.getElementById('preview').src =
                    URL.createObjectURL(event.target.files[0]);
            }
        </script>
        <!-- Form -->
        <div style="display:flex; gap:40px;">
            <!-- Left Column -->
            <div style="flex:1;">
                <label>Full Name</label>
                <input type="text" placeholder="Your Name"
                    style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">


                <label>Email</label>
                <input type="email" placeholder="Your Eamil"
                    style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">




            </div>

            <!-- Right Column -->
            <div style="flex:1;">
                <label>Address</label>
                <input type="text" placeholder="Your address"
                    style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                <label>Phone</label>
                <input type="password"
                    style="width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ddd;">
            </div>

        </div>
        <!--Setting-->
        <!-- Profile Image -->
        <div style="text-align:center; margin:30px 0;">

            <div style="position:relative; display:inline-block;">

                <!-- Image Preview -->
                <img id="preview"
                    src="https://via.placeholder.com/130"
                    style="
                width:130px;
                height:130px;
                border-radius:50%;
                border:5px solid #f1f1f1;
                object-fit:cover;
                display:block;
             ">

                <!-- Plus Icon (Centered Bottom) -->
                <i onclick="document.getElementById('fileInput').click()"
                    style="
            position:absolute;
            bottom:11px;
            left:61%;
            transform:translateX(61%);
            width:36px;
            height:36px;
            border-radius:50%;
            background:#2f80ed;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:22px;
            cursor:pointer;
            box-shadow:0 4px 10px rgba(0,0,0,0.25);
            font-style:normal;
           ">+</i>

                <!-- Hidden File Input -->
                <input type="file"
                    id="fileInput"
                    accept="image/*"
                    onchange="previewImage(event)"
                    style="display:none;">
            </div>
        </div>
        <script>
            function previewImage(event) {
                document.getElementById('preview').src =
                    URL.createObjectURL(event.target.files[0]);
            }
        </script>
        <h2>Change Personal Info</h2>
        <form action="#">
            <!-- Form -->
            <div style="display:flex; gap:40px;">

                <!-- Left Column -->
                <div style="flex:1;">
                    <label>Full Name</label>
                    <input type="text" placeholder="Your Name"
                        style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">


                    <label>Email</label>
                    <input type="email" placeholder="Your Eamil"
                        style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">

                </div>

                <!-- Right Column -->
                <div style="flex:1;">
                    <label>Address</label>
                    <input type="text" placeholder="Your address"
                        style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                    <label>Phone</label>
                    <input type="password"
                        style="width:100%; padding:10px; margin:8px 0; border-radius:5px; border:1px solid #ddd;">
                </div>

            </div>
            <!-- Chnage Password -->
            <h2>Update Password</h2>
            <!-- Form -->
            <div style="display:flex; gap:40px;">

                <!-- Left Column -->
                <div style="flex:1;">
                    <label>Current Password</label>
                    <input type="password" placeholder="Your Name"
                        style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">
                </div>

                <!-- Right Column -->
                <div style="flex:1;">

                    <label>New Password</label>
                    <input type="password" placeholder="New Password"
                        style="width:100%; padding:10px; margin:8px 0 20px; border-radius:5px; border:1px solid #ddd;">

                </div>

            </div>

            <!-- Buttons -->
            <div style="text-align:right; margin-top:30px;">
                <button style="background:#2f80ed; color:#fff; padding:10px 20px; border:none; border-radius:20px; cursor:pointer;">
                    Update Password
                </button>

                <button style="background:#e0e0e0; color:#555; padding:10px 20px; border:none; border-radius:20px; margin-left:10px; cursor:pointer;">
                    Cancel
                </button>
            </div>
        </form>


        <!-- Activity -->
        <h2>User Activity</h2>
        <div class="activity" style="text-align: center;">
            <h3>Recent Booking</h3>
            <div class="room-image">
                <img src="" alt="" width="150px" height="150">
                <h5>Room Type</h5>
                <p>Type Name</p>
            </div>
            <div class="chekinout">
                <p style="font-size:14px;">Check In</p>
                <span>data</span>
                 <p style="font-size:14px;">Check Out</p>
                <span>data</span>

            </div>
            <div class="cancel-booking">
                <button class="btn btn-danger">Cancel booking</button>
            </div>
        </div>
    </div>

</div>







@endsection