<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(Request $request){
        $data=$request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:password',
            'profileImg' => 'required|image|mimes:jpg,jpeg',
            'date_of_birth' => 'required|date',
            'national_id' => 'required|unique:users|digits_between:14,14',
            'gender' =>'required|in:male,female',
        ]);
        $img= $data['profileImg'];
        $imageName = time() . rand(1, 200) . '.' . $img->extension();
        $img->move(public_path('imgs//' . 'client'), $imageName);
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_img' => $imageName,
            'date_of_birth' =>$data['date_of_birth'],
            'gender' => $data['gender'],
            'national_id'=> $data['national_id'],
            'role_type' => 'client',
            'role_id' => 4,
        ]);

        //sending mail to registered user
        // $user->notify(new WelcomeEmailNotification($user));

        $token = $user->createToken('GymProjectToken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        return response($response,201);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response(['message'=>'logged out successfully']);
    }


    public function login(Request $request){
        $data=$request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response(['message'=> 'Invalid credentials'],401);
        }
        else{
            $token = $user->createToken('GymProjectTokenLogin')->plainTextToken;
            $response=[
                'user'=>$user,
                'token'=>$token,
            ];
            return response($response,200);
        }

    }

}
