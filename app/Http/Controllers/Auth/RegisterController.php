<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:password',
            'userImg' => 'image|mimes:jpg,jpeg',
            'date_of_birth' => 'required|date',
            'national_id' => 'required|unique:users|digits_between:14,14',
            'gender' =>'required|in:male,female',
            'city_id' =>'exists:cities,id',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (array_key_exists("userImg",$data)):
            $img = $data['userImg'];
        else:
            $img = null;
        endif;

        if ($img != null) :
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs//' . 'users'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_img' => $imageName,
            'date_of_birth' =>$data['date_of_birth'],
            'gender' => $data['gender'],
            'national_id'=> $data['national_id'],
            'city_id' =>  $data['city_id'],
        ]);


        $user->assignRole('client');
        return $user;
    }

}


