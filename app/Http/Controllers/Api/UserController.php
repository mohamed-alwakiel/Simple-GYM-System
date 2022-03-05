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
use App\Models\TrainingSession;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 4)->get();
        return   UserResource::collection($users);
    }

    public function update(Request $request)
    {
        $user=User::find(Auth::user()->id );
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
    public function showAttendance(){
        // $number0fSession=User::find($id);
        $response=[
            'number_0f_Sessions' =>  Attendee::where('user_id' ,Auth::user()->id )->get('number_of_sessions'),
            'remaining_Sessions' =>  Attendee::where('user_id' ,Auth::user()->id )->get('remaining_sessions'),
        ];
        return response($response);

    }
    public function attend(Session $session,Request $request){
        $user=Auth::user();
        $attendance_date= Attendance::where('user_id' ,$user->id )->get('attendance_date');
        $userData=DB::table('bought_packages')->where('user_id' ,$user->id)->first();
        $start_date= TrainingSession::where('package_id' ,$userData->package_id )->get();
        $remaining_sessions=$userData->remaining_sessions;
        if($remaining_sessions != 0 ){
            foreach($start_date as $day){
                $date2=date('Y-m-d', strtotime($day->started_at));
                if(Carbon::today()->eq($date2)){
                    Attendee::where('user_id' ,$user->id )->decrement('remaining_sessions');
                    $sessionID= Attendance::where('user_id' ,$user->id )->get('training_session_id');
                    SessionAttendence::create([
                        "training_session_id" => $sessionID ,
                        "user_id" => Auth::user()->id,
                        "attendance_time" => Carbon::now()->toTimeString(),
                        "attendance_date" => Carbon::now()->toDateString(),
                    ]);
                    return response()->json([
                        'message' => 'Session Attended'
                    ] , 201);
                }
                continue;

            }
            return response()->json([
                'message' => 'You have no Session today',
            ] , 201);

        }
        else{
            return response()->json([
                'message' => 'pay to play',
            ] , 201);
        }



    //     if (Carbon::today()->eq($date2)){
    //         Attendee::where('user_id' ,$user->id )->decrement('remaining_sessions');
    //         $sessionID= Attendance::where('user_id' ,$user->id )->get('training_session_id');
    //           SessionAttendence::create([
    //               "training_session_id" => $sessionID ,
    //               "user_id" => Auth::user()->id,
    //               "attendance_time" => Carbon::now()->toTimeString(),
    //               "attendance_date" => Carbon::now()->toDateString(),
    //           ]);
    //           return response()->json([
    //               'message' => 'Session Attended'
    //           ] , 201);
    //     }
    //     else {
    //         return response()->json([
    //             'message' => 'you messed the session',
    //             // 'backage' =>  $start_date,
    //             'backage' =>    $finish_date,
    //         ] , 201);
    //     }

    }


}
