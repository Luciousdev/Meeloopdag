<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
// use Hash;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;


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
            'password' => 'required|min:6',
        ]);

        // Send the data to the database
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->password = Hash::make($request->input('password'));
        $user->type = 'student';
        $result = $user->save();

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
            'full_name'=> 'required',
            'password' => 'required|min:6',
        ]);

        // Check if the user exists in the database
        $user = User::where('full_name', '=', $request->input('full_name'))->first();

        // If the user exists, check if the password is correct
        if ($user)
        {
            if (Hash::check($request->input('password'), $user->password))
            {
                $request->session()->put('loggedInUserID', $user->id);
                return redirect('dashboard');
            }
            else
            {
                return back()->with('error', 'Invalid password.');
            }
        }
        else
        {
            return back()->with('error', 'No user found.');
        }
    }


    public function Dashboard()
    {
        // Initialize an empty array to hold data
        $data = array();

        // Check if the user is logged in
        if (session()->has('loggedInUserID'))
        {
            // If the user is logged in, get their user ID
            $userID = session()->get('loggedInUserID');
            // Query the database for the user's data
            $data = User::where('id', '=', $userID)->first();
        }

        // Return the dashboard view with the user's data
        return view('student.dashboard', compact('data'));
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
