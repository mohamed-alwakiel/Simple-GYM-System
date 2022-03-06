<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\City;
use App\Models\CityManager;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class GymManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gymManagers = GymManager::where('role_id', 3)->get();
        $gyms = Gym::all();

       return view('gymManagers.index', [
           'gymManagers' => $gymManagers,
           'gyms' => $gyms
       ]);
    }


    public function create()
    {
        // if admin
        // $role = Auth::user()->role_type;
        // $role= auth()->user()->hasPermissionTo('create gym manager');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            $cities = City::all();
            return view('gymManagers.create', ['cities' => $cities]);
        } elseif ($roleCityManager) {
            // // if city manager
            $city_id = Auth::user()->city_id;
            $gyms = Gym::where('city_id', $city_id)->get();
            return view('gymManagers.create', ['gyms' => $gyms]);
        }
    }

    /**
     * function to get all gyms by city name or id
     */
    public function GetGymNameFromCityName(Request $request)
    {
        $city_id = $request->get('city_id');
        $gyms = Gym::where('city_id', '=', $city_id)->get();
        return response()->json($gyms);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGymManagerRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreGymManagerRequest $request)
    {

        //fetch request data
        $requestData = request()->all();

        // deal with image
        $image = $request->img;
        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'users/'), $imageName);
        else :
            $imageName = 'gymMgr.png';
        endif;

        // handle creator
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            $city_id = $request['city_id'];
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
        }

        // store new data into data base
        $newGymManager = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),

            'profile_img' => $imageName,
            'national_id' => $requestData['national_id'],


            'city_id' => $request['city_id'],
            'gym_id' => $request['gym_id'],

            'role_type' => 'gymManager',
            'role_id' => 3,

            'city_id' => $city_id,
            'gym_id' => $request['gym_id']
        ]);

        
        $newGymManager->assignRole('gymManager')->givePermissionTo([
            'create session', 'update session', 'delete session',
            'read session', 'read coach', 'read package', 'assign coach'
        ]);


        return redirect()->route('gymManagers.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function edit($gymManagerID)
    {
        $gymManager = GymManager::find($gymManagerID);
        $gyms = Gym::where('city_id', $gymManager->city_id)->get();

        return view('gymManagers.edit', [
            'gymManager' => $gymManager,
            'gyms' => $gyms
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGymManagerRequest  $request
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGymManagerRequest $request, $gymManagerID)
    {
        //fetch request data
        $requestData = request()->all();

        // update new data into data base
        GymManager::find($gymManagerID)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'national_id' => $requestData['national_id'],
            'gym_id' => $requestData['gym_id']
        ]);

        //redirection to posts.index
        return redirect()->route('gymManagers.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($gymManager)
    {
        GymManager::find($gymManager)->delete();
        return redirect()->route('gymManagers.index');
    }


    // for ban users
    public function ban($gymManager)
    {
        GymManager::findOrFail($gymManager)->ban([
            'comment' => 'Enjoy your ban!',
        ]);
        return redirect()->route('gymManagers.index');
    }

    // for unban users
    public function unban($gymManager)
    {
        GymManager::findOrFail($gymManager)->unban();
        return redirect()->route('gymManagers.index');
    }

    // for show bans users
    public function banView()
    {
        $bannedManagers = GymManager::onlyBanned()->get();
        return view('gymManagers.banned', [
            "bannedManagers" => $bannedManagers
        ]);
    }
}
