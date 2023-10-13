<?php
$pageTitle="Login Page";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.headtags')
    <style>
        body {
            background-color: #000;
        }

        .login-container {
            margin-top: 100px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255);
            border-radius: 10px;
        }

        .form-container {
            width: 20%;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-7 justify-content-center form-container">
                <h1 class="text-center">Login Form</h1>
                <form wire:submit.prevent="submit" action="{{ route('login-user') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Please enter your full name." value="{{ old('full_name') }}">
                        @error('full_name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Please enter your password" value="{{ old('password') }}">
                        @error('password') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Login</button>
                </form>

                <p class="text-center">
                    <a href="{{ url('/register') }}">Do you not have an account? Register here!</a>
                </p>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
