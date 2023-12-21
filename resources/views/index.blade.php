<?php
$pageTitle="Login Page";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.headtags')
</head>
<body>
    <div class="container container-settings">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Login Form</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form wire:submit.prevent="submit" action="{{ route('login-user') }}" method="POST">
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
                    <button class="" type="submit">Login</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-center">Do you not have an account? Register <a href="/register">here!</a></p>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
