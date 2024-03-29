<?php

namespace App\Http\Controllers;

use App\Models\assignments;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SignupConfirm;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function login()
    {

        // Redirect user to dashboard if they're already logged in. Else just show the login page
        if (session()->has('loggedInUserID'))
        {
            return redirect('dashboard');
        }

        return view('index');
    }

    public function registration()
    {
        // Redirect user to dashboard if they're already logged in. Else show the register page
        if (session()->has('loggedInUserID'))
        {
            return redirect('dashboard');
        }

        return view('registration');
    }

    public function accountRegistration(Request $request)
    {
        // Validate the user input
        $request->validate([
            'full_name'     => 'required|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
        ]);

        // Generate a random number for the verification code
        $randomInt = mt_rand(1000, 9999);

        // Store the user data in the database
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->verification_code = $randomInt;
        $user->verified = false;
        $user->type = 'student';
        $result = $user->save();

        // Send the user an email with the verification code
        Mail::to($user->email)->send(new SignupConfirm($user));


        // Redirect the user to the login page, based on the output state of the insert data into DB
        if ($result)
        {
            return back()->with('success', 'User created successfully.');
        }
        else
        {
            return back()->with('error', 'Whoops! some error encountered. Please try again.');
        }
    }

    public function loginUser(Request $request)
    {
        // Validate the user input
        $request->validate([
            'email'=> 'required',
            'password' => 'required',
        ]);

        // Check if the user exists in the database
        $user = User::where('email', '=', $request->input('email'))->first();

        // If the user exists, check if the password is correct
        if ($user)
        {
            // Check if the user has verified their account
            if ($user->verified == 0 || $user->verified == false)
            {
                return back()->with('error', 'Please verify your account first.');
            }

            // Check if the password matches the one in the database
            if (Hash::check($request->input('password'), $user->password))
            {
                $request->session()->put('loggedInUserID', $user->id);
                return redirect('dashboard');
            }

            return back()->with('error', 'Invalid password.'); // If password is incorrect and user has not verified their account yet.
        }
        else
        {
            return back()->with('error', 'No user found.');
        }
    }


    public function verify($email, $code)
    {
        $email = urldecode($email);

        // Check if the user exists in the database
        $user = User::where('email', '=', $email)->first();


        if ($user)
        {
            // Check if the code matches the one in the database
            if ($user->verification_code == $code)
            {
                // Update the user's verified status to true
                $user->verified = true;
                $user->save();

                // Redirect the user to the login page
                return redirect('/')->with('success', 'Account verified successfully.');
            }
            else
            {
                // Redirect the user to the login page  with an error message
                return redirect('/')->with('error', 'Invalid verification code.');
            }
        }
        else
        {
            // Redirect the user to the login page with an error message
            return redirect('/')->with('error', 'No user found.');
        }
    }

    public function logoutUser()
    {
        // Check if the user is logged in
        if (session()->has('loggedInUserID'))
        {
            // Remove the userID from the users sessions
            session()->pull('loggedInUserID');
            // Redirect the user to the homepage
            return redirect('/');
        }
    }
}
