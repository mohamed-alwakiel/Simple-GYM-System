<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use App\Models\City;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

// use Illuminate\Support\Facades\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');

        if ($roleAdmin) {
            $users = User::role('client')->get();
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
            $users = User::role('client')->where('city_id', $city_id)->get();
        } elseif ($roleGymManager) {
            $gym_id = Auth::user()->gym_id;
            $users = User::role('client')->where('gym_id', $gym_id)->get();
        }

        return view('users.index', data: [
            'users' => $users,
        ]);
        // return view('users.datatable');
    }


    public function getUsers()
    {
        if (request()->ajax()) {

            $users = User::where('role_id', 4)->get();



            return DataTables::of($users)
                ->addIndexColumn()


                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('national_id', function ($row) {
                    return $row->national_id;
                })



                ->addColumn('action', function ($row) {


                    $edit = '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary">Update</a>';


                    $delete = '
                     <form action="' . route('users.destroy', $row->id) . '" method="post">

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    ';

                    return $edit . ' ' . $delete;
                })

                ->make(true);
        }
        return view('users.datatable');
        //        return datatables()->of(Gym::with('city'))->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');

        if ($roleAdmin) {
            $cities = City::all();
            return view('users.create', ['cities' => $cities]);
        }
        elseif ($roleCityManager)
        {
            $city_id = Auth::user()->city_id;
            $gyms = Gym::where('city_id', $city_id)->get();
            return view('users.create', ['gyms' => $gyms]);
        }
        elseif ($roleGymManager)
        {
            return view('users.create');
        }
    }

    public function GetGymNameFromCityName(Request $request)
    {
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
        $img = $request->profileImg;
        $request = request()->all();

        if ($img != null) :
            $imageName = time() . rand(1, 200) . '.' . $img->extension();
            $img->move(public_path('imgs//' . 'users'), $imageName);
        else :
            $imageName = 'Client.Png';
        endif;

        // handle creator
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');

        if ($roleAdmin) {
            $city_id = $request['city_id'];
            $gym_id = $request['gym_id'];
        }
        elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
            $gym_id = $request['gym_id'];
        }
        elseif($roleGymManager) {
            $city_id = Auth::user()->city_id;
            $gym_id = Auth::user()->gym_id;
        }

        // store new data into data base
        $newUser = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['passwd']),
            'national_id' => $request['national_id'],
            'profile_img' => $imageName,
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'role_type' => 'client',
            'role_id' => 4,
            'city_id' =>  $city_id,
            'gym_id' =>  $gym_id,
        ]);
        $newUser->assignRole('client');
        //redirection to posts.index
        return redirect()->route('users.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        $user = User::find($userId);
        $gyms = Gym::where('city_id', $user->city_id)->get();

        return view("users.edit", [
            'user' => $user,
            'gyms' => $gyms
        ]);
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
        // handle creator
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');

        if ($roleAdmin || $roleCityManager) {
            $gym_id = $request['gym_id'];
        }
        elseif($roleGymManager) {
            $gym_id = Auth::user()->gym_id;
        }

        $request = request()->all();
        User::find($id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'national_id' => $request['national_id'],
            'date_of_birth' => $request['date_of_birth'],
            'gym_id' => $gym_id
        ]);
        
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


    // update profile data
    public function editProfile()
    {
        return view('profile.editProfile');
    }

    public function updateProfile(Request $request)
    {
        $userID = $request->id;

        $validated = $request->validate([
            'name' => 'required|max:50|min:3',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userID],
            'national_id' => ['required', 'min:14', 'max:14', 'unique:users,national_id,' . $userID],
        ]);

        // deal with image
        $oldimg = $request->oldimg;

        if ($request->newimg) {
            $request->validate([
                'newimg' => 'image | mimes:jpg,jpeg',
            ]);

            $imageName = time() . '.' . $request->file('newimg')->extension();
            $request->newimg->move(public_path('imgs//' . 'users'), $imageName);

            DB::table('users')->where('id', '=', $userID)->update(['profile_img' => $imageName]);

            // to delete old image
            if (file::exists(public_path('imgs//' . 'users/' . $oldimg))) {
                file::delete(public_path('imgs//' . 'users/' . $oldimg));
            }
        }

        User::find($userID)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'national_id' => $validated['national_id'],
        ]);
        return redirect()->route('dashboard');
    }

    // update password
    public function editPassword()
    {
        $msg = 0;
        return view('profile.editPassword', ["msg" => $msg]);
    }

    public function updatePassword(Request $request)
    {
        $userid = Auth::id();

        $data = $request->validate([
            'newpassword'  => 'required|min:6',
            'oldpassword'  => 'required|min:6'
        ]);

        $userPassword = Auth::user()->password;

        $newPassword = Hash::make($data['newpassword']);

        if (Hash::check($data['oldpassword'], $userPassword)) {     // check if enter old password correct or not

            DB::table('users')->where('id', '=', $userid)->update(['password' => $newPassword]);
            return redirect()->route('dashboard');
        } else {
            $msg = 'please enter your old password correctly';
            return view('profile.editPassword', ['msg' => $msg]);
        }
    }
}
