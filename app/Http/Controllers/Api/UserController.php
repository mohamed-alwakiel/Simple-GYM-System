<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Attendee;
use App\Models\Session;
use App\Models\SessionAttendence;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Attendance;
use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 4)->get();
        return   UserResource::collection($users);
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $data=$request->validate([
            'name' => 'required|string|min:3',
            'email' => ['required','email',Rule::unique('users')->ignore($user->id)],
            'date_of_birth' => 'required|date',
            'national_id' => ['required','digits_between:14,14',Rule::unique('users')->ignore($user->id)],
        ]);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'national_id' => $data['national_id'],
            'date_of_birth' =>$data['date_of_birth'],
        ]);
        $response=[
            'message'=>'data updated successfully',
            'user'=>$user,
        ];
        return response($response);
    }
    
    
    public function remainingSessions()
    {
        $user = Auth::user();
        $boughtPackage = BuyPackage::where('user_id', $user->id)->first();
        $totalNumOfSession=$boughtPackage->number_of_sessions;
        $remainingSessions=$boughtPackage->remaining_sessions;
        
    
        return response()->json([
            'total_training_sessions'=> $totalNumOfSession,
            'remaining__training_sessions'=> $remainingSessions,
    ], 200);
    }
    
    public function showAttendance()
    {
        $user = Auth::user();
        // $number0fSession=User::find($id);
        
        $response=[
            'number_0f_Sessions' =>  Attendee::where('user_id', $user->id)->get('number_of_sessions'),
            'remaining_Sessions' =>  Attendee::where('user_id', $user->id)->get('remaining_sessions'),
        ];
        return response($response);
    }
    public function attend(Session $session, Request $request)
    {
        $user = Auth::user();
        Attendee::where('user_id',$user->id)->decrement('remaining_sessions');
        DB::table('bought_packages')->where('user_id' ,$user->id )->decrement('remaining_session',1);
        SessionAttendence::create([
            "session_id" => 1,
            "user_id" => Auth::user()->id,
            "attendance_time" => Carbon::now()->toTimeString(),
            "attendance_date" => Carbon::now()->toDateString(),
        ]);
        return response()->json([
            'message' => 'Session Attended'
        ], 201);
    }

    // public function showAttendanceHistory()
    // {
    //     $user = Auth::user();
        
    //     $boughtPackage = BuyPackage::where('user_id', $user->id)->get();

       
    //     $trainingSession = Attendance::where('user_id',$user->id)->first();
    //     $trainingSessionName= $trainingSession->name;

        
    
    //     return response()->json([
    //         'training_session_name'=> $trainingSessionName,
    //         // 'gymName'=> $gymName,
    // ], 200);
    // }
}