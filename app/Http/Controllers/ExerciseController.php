<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assignments;
use App\Models\submissions;
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

        try {
            // Get the grader's username
            $grader = User::where('id', '=', $assignment->submissions[0]->grade->teacher_id)->first();
        } catch (\Exception $e) {
            $grader = null;
        }


        return view('student.exercise', compact('user', 'assignment', 'data', 'grader'));
    }

    public function submitAssignment(Request $request)
    {
        try {
            $userID = session()->get('loggedInUserID');
            $assignmentID = $request->id;
            $submission_user = $request->submission_user;
//        dd($request->all());

            $submission = new submissions();
            $submission->student_id = $userID;
            $submission->assignment_id = $assignmentID;
            $submission->status = 'submitted';
            $submission->text_submission = $submission_user;
            $submission->save();

            return redirect('/exercise/' . $assignmentID)->with('success', 'Assignment submitted successfully!');
        } catch (\Exception $e) {
            return redirect('/exercise/' . $assignmentID)->with('error', 'An error occurred while submitting the assignment. Please try again.');
        }
    }
}
