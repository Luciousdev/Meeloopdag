<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\submissions;
use App\Models\grades;
use App\Models\User;

class gradeController extends Controller
{
    public function grading()
    {
        // get the user's id
        $userid = session()->get('loggedInUserID');

        // get the user's data
        $data = User::find($userid)->first();
        if($data->type != 'teacher'){
            return redirect('/dashboard')->with('error', 'You are not authorized to view this page');
        }

        // get all submissions with the related exercise
        $submissions = submissions::with('assignment')->with('user')->with('grade')->get();

        return view('teachers.grading', compact('data', 'submissions'));
    }

    public function grade($id)
    {
        // get the user's id
        $userid = session()->get('loggedInUserID');

        // get the user's data
        $data = User::find($userid)->first();
        if($data->type != 'teacher'){
            return redirect('/dashboard')->with('error', 'You are not authorized to view this page');
        }

        // get the submission
        $submission = submissions::with('assignment')->with('user')->with('grade')->where('id', $id)->first();

        return view('teachers.grade', compact('data', 'submission'));
    }

    public function gradeSubmission(Request $request)
    {
        // get the user's id
        $userid = session()->get('loggedInUserID');

        // get the user's data
        $data = User::find($userid)->first();
        if($data->type != 'teacher'){
            return redirect('/dashboard')->with('error', 'You are not authorized to view this page');
        }

        // validate the request
        $request->validate([
            'score' => 'required',
            'feedback' => 'required',
            'id' => 'required'
        ]);

        // get the submission
        $submission = submissions::find($request->id);
        // check if the submission has already been graded
        if($submission->grade){
            return redirect('/grading')->with('error', 'Submission has already been graded');
        }

        // create the grade
        $grade = new grades();
        $grade->score = $request->score;
        $grade->feedback = $request->feedback;
        $grade->submission_id = $request->id;
        $grade->teacher_id = $userid;
        $grade->save();

        // update the submission so the status is graded
        $submission->status = 'graded';
        $submission->save();

        return redirect('/grade/'.$request->id )->with('success', 'Submission graded successfully');
    }
}
