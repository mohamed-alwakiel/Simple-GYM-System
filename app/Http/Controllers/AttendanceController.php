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
        $roleClient = auth()->user()->hasRole('client');

        if ($roleAdmin) {
            $attendances = Attendance::all();
        } elseif ($roleCityManager) {
            $attendances = Auth::user()->city->attendances;
        } elseif ($roleGymManager) {
            $attendances = Auth::user()->gym->attendances;
        } elseif ($roleClient) {
            $attendances = Attendance::where('user_id', auth()->user()->id)->get();
        }

        return view('attendance.index', [
            'attendances' => $attendances,
        ]);
    }
}
