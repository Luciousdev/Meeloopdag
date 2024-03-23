<?php
$pageTitle = "Registreren";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('./components.headtags')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loginsignup.css') }}">
    @livewireStyles
</head>
<body>
    <h1 class="text-center">Registration Form</h1>
    <form wire:submit.prevent="submit" action="{{ route('register-user') }}" method="post">
        @if(Session::has('success'))
        <div class="alert alert-success">Thanks for registering. Please don't forget to register your account with the link that has been sent to your mailbox. 📬</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-success">{{Session::get('error')}}</div>
        @endif

        @csrf
        <label for="full_name">Name</label>
        <input type="text" name="full_name" placeholder="Please enter your full name." value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror

        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Please enter your email." value="{{ old('email') }}">
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Please enter a password" value="{{ old('password') }}">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <button class="btn btn-prim" type="submit">Register</button>
        <div class="text-right">
            <span style="color:#000;">Already have an account? <a href="{{ url('/') }}">Login here!</a></span>
        </div>
    </form>


    @livewireScripts
</body>
</html>
