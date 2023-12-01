<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
    @livewireStyles
</head>
<body>
    <h1>Registration Form</h1>
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

        <button type="submit">Register</button>
    </form>

    <a href="{{ url('/') }}">Already have an account? Login here!</a>

    @livewireScripts
</body>
</html>
