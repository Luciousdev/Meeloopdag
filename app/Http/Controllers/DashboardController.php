<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\assignments;

class DashboardController extends Controller
{
    public function index()
    {
        return view('student.dashboard');
    }

    public function Dashboard()
    {
        // Initialize an empty array to hold data
        $data = array();

        // Check if the user is logged in
        if (!session()->has('loggedInUserID'))
        {
            return redirect('/logout');
        }

        // If the user is logged in, get their user ID
        $userID = session()->get('loggedInUserID');
        // Query the database for the user's data
        $data = User::where('id', '=', $userID)->first();
        // get all rows from assignments table and add it to the data array
        $data['assignments'] = assignments::all('title', 'points');


        // Return the dashboard view with the user's data
        return view('student.dashboard', compact('data'));
    }
}
