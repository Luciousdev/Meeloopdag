<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assignments;
use App\Models\User;

class createExerciseController extends Controller
{
    public function createExercise()
    {
        // Get the users status and check if they are a teacher
        $data = User::where('id', session()->get('loggedInUserID'))->first();
        if($data->type != 'teacher')
        {
            return view('/dashboard')->with('error', 'You are not a teacher!');
        }


        return view('teachers/create_exercise', compact('data'));
    }

    public function submitExercise(Request $request)
    {
        // Get the users status and check if they are a teacher
        $data = User::where('id', session()->get('loggedInUserID'))->first();
        if($data->type != 'teacher')
        {
            return view('/dashboard')->with('error', 'You are not a teacher!');
        }

        try {
            // Validate the request
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'short_description' => 'required',
                'points' => 'required',
                'inleverbaar' => 'required'
            ]);

            // Create a new assignment
            $assignment = new assignments();
            $assignment->title = $request->title;
            $assignment->description = $request->description;
            $assignment->short_description = $request->short_description;
            $assignment->points = $request->points;
            $assignment->inleverbaar = $request->inleverbaar;
            $assignment->save();

            return redirect('/dashboard')->with('success', 'Opdracht aangemaakt!');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('error', 'Er is iets fout gegaan!');
        }

    }
}
