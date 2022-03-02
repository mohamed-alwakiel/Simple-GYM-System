<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityManagerRequest;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Models\CityManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CityManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cityManagers = DB::table('users')->where('role_id', 2)->get();

        return view('cityManagers.index', [
            'cityManagers' => $cityManagers,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cityManagers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGymManagerRequest  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(StoreGymManagerRequest $request)
    public function store(StoreCityManagerRequest $request)
    {
        //fetch request data
        $requestData = request()->all();

        // store new data into data base
        CityManager::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),

            'profile_img' => 'cityMgr.png',
            'national_id' => $requestData['national_id'],

            'role_type' => 'City_Mgr',
            'role_id' => 2,
        ]);

        //redirection to posts.index
        return redirect()->route('cityManagers.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function edit($cityManagerID)
    {
        $cityManager = CityManager::find($cityManagerID);

        return view('cityManagers.edit', [
            'cityManager' => $cityManager
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGymManagerRequest  $request
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityManagerRequest $request , $cityManagerID)
    {
        //fetch request data
        $requestData = request()->all();

        // update new data into data base
        CityManager::find($cityManagerID)->update([

            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'national_id' => $requestData['national_id'],
        ]);

        //redirection to posts.index
        return redirect()->route('cityManagers.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($cityManager)
    {
        CityManager::find($cityManager)->delete();
        return redirect()->route('cityManagers.index');
    }
}
