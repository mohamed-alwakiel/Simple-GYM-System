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
use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{

    public function update(Request $request)
    {
        $user=User::find(Auth::user()->id );
        $data=$request->validate([
            'name' => 'required|string|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'date_of_birth' => 'required|date',
            'national_id' => ['required', 'digits_between:14,14', Rule::unique('users')->ignore($user->id)],
        ]);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'national_id' => $data['national_id'],
            'date_of_birth' => $data['date_of_birth'],
        ]);
        $response = [
            'message' => 'data updated successfully',
            'user' => $user,
        ];
        return response($response);
    }


    public function remainingSessions()
    {
        $user = Auth::user();
        $userData = BuyPackage::where('user_id', $user->id)->first();
        if (isset($userData->package_id)) {
            $totalNumOfSession = $userData->number_of_sessions;
            $remainingSessions = $userData->remaining_sessions;
            return response()->json([
            'total_training_sessions' => $totalNumOfSession,
            'remaining__training_sessions' => $remainingSessions,
        ], 200);
        }
        else{
            return response()->json([
                'message' => 'you must buy package first',
            ], 201);
        }
    }


    public function attend(Session $session,Request $request){
        $user=Auth::user();
        $userData=DB::table('bought_packages')->where('user_id' ,$user->id)->first();
        $dateNow=date('Y-m-d H', strtotime(now()));
        if (isset($userData->package_id)) {
            $start_date= TrainingSession::where('gym_id', $userData->gym_id)->get();
            $remaining_sessions=$userData->remaining_sessions;
            if ($remaining_sessions != 0) {
                foreach ($start_date as $day) {
                    $date2=date('Y-m-d', strtotime($day->started_at));
                    $startTime=date('Y-m-d H', strtotime($day->started_at));
                    $finishTime=date('Y-m-d H', strtotime($day->finished_at));
                    if (Carbon::today()->eq($date2)) {
                        $sessionID=$day->id;
                        if (isset($sessionID)) {
                            if ($dateNow >= $startTime && $dateNow < $finishTime) {
                                Attendee::where('user_id', $user->id)->decrement('remaining_sessions');
                                SessionAttendence::create([
                                    "training_session_id" => $sessionID ,
                                    "user_id" => Auth::user()->id,
                                    "attendance_time" => Carbon::now()->toTimeString(),
                                    "attendance_date" => Carbon::now()->toDateString(),
                            ]);
                                return response()->json([
                            'message' => 'Session Attended'
                            ], 201);
                            }else if ($dateNow < $startTime){
                                return response()->json([
                                    'message' => 'You have Session today but you came early'
                                ], 201);
                            } else if ($dateNow > $finishTime){
                                continue;
                            }
                        } else {
                            return response()->json([
                            'message' => 'Invalid session '
                        ], 201);
                        }
                    }
                    continue;
                }
                return response()->json([
                'message' => 'You have no Session today',
            ], 201);
            } else {
                return response()->json([
                'message' => 'pay to play',
            ], 201);
            }
        }
        else{
            return response()->json([
                'message' => 'you must buy package first',
            ], 201);
        }

    }

    public function showAttendanceHistory()
    {
        $user = Auth::user();

        $userData = BuyPackage::where('user_id', $user->id)->first();
        if (isset($userData->package_id)) {
            $gymName = DB::table('gyms')->where('id', $userData->gym_id)->select('name as Gym name')->get();
            $sessionName = DB::table('training_sessions')->where('gym_id', $userData->gym_id)->get('name as Session name');
            $trainingSession = SessionAttendence::where('user_id', $user->id)->select('attendance_date', 'attendance_time')->get();

            $attendanceHistory = collect([
            $gymName ,
            $sessionName,
            $trainingSession,
        ]);

            $arrayOfAttendanceHistory = $attendanceHistory->collapse();

            return response()->json(
                $arrayOfAttendanceHistory->all(),
                200
            );
        } else {
            return response()->json([
            'message' => 'you must buy package first',
        ], 201);
        }
    }
}
