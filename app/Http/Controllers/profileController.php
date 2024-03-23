<?php

namespace App\Http\Controllers;

use App\Models\User;

class profileController extends Controller
{
    public function profile()
    {
        function getMinMaxAvgGradesByWeek($grades): array
        {
            $gradesByWeek = [];

            foreach ($grades as $grade) {
                $weekNumber = date('W', strtotime($grade->created_at));
                if (!isset($gradesByWeek[$weekNumber])) {
                    $gradesByWeek[$weekNumber] = [
                        'min' => $grade->score,
                        'max' => $grade->score,
                        'total' => $grade->score,
                        'count' => 1
                    ];
                } else {
                    $gradesByWeek[$weekNumber]['min'] = min($gradesByWeek[$weekNumber]['min'], $grade->score);
                    $gradesByWeek[$weekNumber]['max'] = max($gradesByWeek[$weekNumber]['max'], $grade->score);
                    $gradesByWeek[$weekNumber]['total'] += $grade->score;
                    $gradesByWeek[$weekNumber]['count']++;
                }
            }
            foreach ($gradesByWeek as &$week) {
                $week['avg'] = $week['total'] / $week['count'];
            }

            return $gradesByWeek;
        }

        // Get the user's information
        $data = User::where('id', session()->get('loggedInUserID'))->with('grades')->with('submissions')->first();
        $gradesByWeek = getMinMaxAvgGradesByWeek($data->grades); // Get min, max, and avg grades by week

        // Return the view with the user's information
        return view('profile', compact('data', 'gradesByWeek'));
    }
}
