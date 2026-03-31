<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Font Awesome for eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <style>
        /* 1. Global Styles and Layout */
        :root {
            --primary-color: #00bcd4;
            /* Cyan accent */
            --background-color: #1a1a2e;
            /* Deep space blue */
            --card-bg: #2c385b;
            /* Slightly lighter card color */
            --text-color: #ffffff;
            --input-bg: #394a73;
            --border-color: #556080;
        }

        /* Use a standard, clean system font */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            background-image: url('{{ asset('images/hotel-bg.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        /* 1a. Background Overlay for better contrast */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 10, 26, 0.75); /* Darker overlay for depth */
            z-index: 0;
        }


        /* 2. Form Container (Card) */
        .registration-card {
            width: 100%;
            max-width: 450px;
            background-color: rgba(44, 56, 91, 0.85); /* Semi-transparent background */
            backdrop-filter: blur(12px); /* Premium glassmorphism effect */
            -webkit-backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            /* Strong shadow for depth */
            transition: all 0.3s ease;
            position: relative;
            z-index: 10;
        }


        /* 3. Header Text */
        .header h2 {
            color: var(--text-color);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
        }

        .header p {
            color: #b0c4de;
            /* Lighter text for subtitle */
            font-size: 16px;
            margin-bottom: 30px;
            text-align: center;
        }

        /* 4. Input Group and Fields */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #b0c4de;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid var(--border-color);
            background-color: var(--input-bg);
            color: var(--text-color);
            border-radius: 8px;
            box-sizing: border-box;
            /* Include padding in element's total width/height */
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder {
            color: #8fa4b7;
        }

        /* Focus State */
        input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 188, 212, 0.4);
        }

        /* 5. Submit Button */
        .register-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: var(--card-bg);
            /* Dark text on bright button */
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 188, 212, 0.3);
            transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .register-btn:hover {
            background-color: #00a3bb;
            /* Slightly darker cyan */
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 188, 212, 0.5);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        /* 6. Footer Link and Message Box */
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: #00a3bb;
        }

        .login-link span {
            color: #b0c4de;
        }

        #messageBox {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
            display: none;
            /* Hidden by default */
            background-color: #4CAF50;
            /* Green for success */
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Eye icon styling */
        .password-container {
            position: relative;
        }

        .password-container i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8fa4b7;
            transition: color 0.2s;
            z-index: 10;
        }

        .password-container i:hover {
            color: var(--primary-color);
        }

        .password-container input {
            padding-right: 45px !important;
        }
    </style>

</head>

<body>

    <div class="registration-card">
        <!-- Header -->
        <div class="header">
            <h2>Create Account</h2>
            <p>Join us and start your journey.</p>
        </div>
        @if (session('success'))
        <span class="text-success">{{ session('success') }}</span>
        @endif
        @if (session('error'))
        <span class="text-danger">{{ session('error') }}</span>
        @endif

        <!-- Registration Form -->
        <form action="{{route('user.store')}}" method="post">
            @csrf

            <!-- Full Name Input -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Number Input -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Your phone" required>
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Minimum 8 characters" required minlength="8">
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <!-- Registration Button -->
            <button
                type="submit"
                class="register-btn">
                Register Account
            </button>
        </form>



        <!-- Sign In Link -->
        <div class="login-link">
            <span>Already registered?</span>
            <a href="{{route('user.login')}}">
                Sign In
            </a>
        </div>
    </div>


    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>


</html>