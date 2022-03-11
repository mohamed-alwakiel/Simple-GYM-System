<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\City;
use App\Models\User;
use App\Models\Attendance;
use Nette\Utils\Paginator;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function index()
    {

        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');


        if($roleAdmin){
            $attendances=Attendance::all();
        }
        elseif($roleCityManager ){
           $attendances =Auth::user()->city->attendances;
        }
        elseif($roleGymManager){
            $attendances =Auth::user()->city->attendances;
        }
        else{
            $attendances = Attendance::where('user_id', Auth::id());
        }

        return view('attendance.index',[
            'attendances'=>$attendances,
        ]
    );
    }
}
