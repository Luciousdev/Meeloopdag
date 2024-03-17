<?php
$pageTitle="Login Page";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.headtags')
    <link rel="stylesheet" href="{{ asset('css/loginsignup.css') }}">
</head>
<body>
    <h1 class="text-center">Login Form</h1>
    <form wire:submit.prevent="submit" action="{{ route('login-user') }}" method="post">
        @if(Session::has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @error('email') <div class="error">{{ $message }}</div> @enderror
        @error('password') <div class="error">{{ $message }}</div> @enderror

        @csrf
        <div class="form-group">
            <label for="full_name">Email</label>
            <input type="email" class="" name="email" placeholder="Please enter your email." value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="" name="password" placeholder="Please enter your password" value="{{ old('password') }}">
        </div>
        <button class="btn" type="submit">Login</button>
        <div class="text-right">
            <span>Do you not have an account? Register <a href="/register">here!</a></span>
        </div>
    </form>
    @livewireScripts
</body>
</html>
