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
                    @csrf
                    <div class="form-group">
                        <label for="full_name">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Please enter your email." value="{{ old('email') }}">
                        @error('full_name') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Please enter your password" value="{{ old('password') }}">
                        @error('password') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="text-center">Do you not have an account? Register <a href="{{ url('/register') }}">here!</a></p>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
