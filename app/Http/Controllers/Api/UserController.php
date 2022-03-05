<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Attendee;
use App\Models\Session;
use App\Models\SessionAttendence;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $boughtPackages = BuyPackage::where('user_id', $user->id)->get();
        $attendance = Attendance::where('user_id', $user->id)->get();
    
        $totalSession = 0;
        foreach ($boughtPackages as $package) {
            $package = Package::where('id', $package->package_id)->first();
            die($package->number_of_sessions);
            $totalSession = $package->number_of_sessions;
        }
    
        $remainingSession = $totalSession;
        foreach ($attendance as $attend) {
            $remainingSession--;
        }
    
        $user = User::where('id', $user->role_id)->first();
        $user->update(['remaining_sessions' => $remainingSession]);
    
        return response()->json([
    'Total Session' => $totalSession,
    'Remaining Session' => $remainingSession,
    ], 200);
    }
    
    public function showAttendance()
    {
        // $number0fSession=User::find($id);
        $response=[
            'number_0f_Sessions' =>  Attendee::where('user_id', Auth::user()->id)->get('number_of_sessions'),
            'remaining_Sessions' =>  Attendee::where('user_id', Auth::user()->id)->get('remaining_sessions'),
        ];
        return response($response);
    }
    public function attend(Session $session, Request $request)
    {
        Attendee::where('user_id', Auth::user()->id)->decrement('remaining_sessions');
        //    DB::table('bought_packages')->where('user_id' ,Auth::user()->id )->decrement('remaining_session',1);
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
}