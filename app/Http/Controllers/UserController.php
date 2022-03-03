<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gym;
use App\Models\City;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 4)->get();

        return view('users.index',data: [
            'users' => $users,]);
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities=City::all();
        return view('users.create',data: [
            'cities' =>$cities,
        ]);
    }

    public function GetGymNameFromCityName(Request $request){

        $city_id = $request->get('city_id');
        $gyms = Gym::where('city_id', '=', $city_id)->get();
        return response()->json($gyms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
            //fetch request data
            $request = request()->all();
            $img=$request['profileImg'];
            $ext=$img->getClientOriginalExtension();
            $imgName =$request['name']."-". rand() . '.'. $ext ;
            $img->move(public_path('userImage'), $imgName );
            // store new data into data base
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['passwd']),
                'national_id' => $request['national_id'],
                'profile_img' => $imgName,
                'date_of_birth' =>$request['date_of_birth'],
                'gender' => $request['gender'],
                'role_type' => 'client',
                'role_id' => 4,
                'city_id' =>  $request['city_id'],
                'gym_id' =>  $request['gym_id'],
            ]);

            //redirection to posts.index
            return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        // $user =User::find($userId);
        // $gym=Gym::find($user->gym_id);
        // $city=City::find($user->city_id);
        // return view("users.edit",[
        //     'user'=> $user,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( $userId)
    {
        $user =User::find($userId);
        return view("users.edit",['user'=> $user,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $userId)
    {
      User::find($userId)->delete($request->all());
      return redirect()->route('users.index');
    }
}
