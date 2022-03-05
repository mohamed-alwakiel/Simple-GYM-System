<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\City;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\TrainingSession;

class AttendanceController extends Controller
{


    public function index()
    {

        $users =User::all();
        $sessions =TrainingSession::all();
        $cities = City::all();
        $attendances=Attendance::all();
        $gyms=Gym::all();




        return view('attendance.index',[

            'users'=>$users,
            'sessions'=>$sessions,
            'cities'=>$cities,
            'attendances'=>$attendances,
        ]
    );
    }

    public function attend($userId,$trainingSessionId) {



      $start=TrainingSession::find($trainingSessionId,['started_at']);
     $end=TrainingSession::find($trainingSessionId,['finished_at']);

        ////===>Session data:
        $start=date('H',strtotime($start));
        $end=date('H',strtotime($end));
        ////===>Current date and time:
        $dateNow=date('Y-m-d',strtotime(now()));
        $timeNow=date('H',strtotime(now()));

        //TODO: ==> check remaining session.

        if ($timeNow >= $start  && $timeNow <= $end){
        Attendance::create([

            'user_id'=>$userId,
            'training_session_id'=>$trainingSessionId,
            'attendance_time'=>$time,
            'attendance_date'=>$date,
        ]);
    }else{$errors="session not available";}

        return redirect()->route('attendance.index');
    }
}

