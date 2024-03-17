<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assignments;
use App\Models\User;

class ExerciseController extends Controller
{
    public function exercise($id)
    {
        $userID = session()->get('loggedInUserID');

        // Query the database for the user's data
        $user = User::find($userID);

        $data = User::where('id', '=', $userID)->first();

        // Check if the user exists
        if (!$user) {
            return redirect('/404');
        }

        // Retrieve the assignment with its associated feedback (grade) for the logged-in user
        $assignment = assignments::with(['submissions' => function ($query) use ($userID) {
            $query->where('student_id', $userID)->with('grade');
        }])->find($id);

        // Check if the assignment exists
        if (!$assignment) {
            return redirect('/404');
        }

        return view('student.exercise', compact('user', 'assignment', 'data'));
    }
}
