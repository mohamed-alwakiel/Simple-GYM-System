<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityManagerRequest;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Models\City;
use App\Models\CityManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CityManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cityManagers = User::role('cityManager')->get();
        $cities = City::all();

       return view('cityManagers.index', [
           'cityManagers' => $cityManagers,
           'cities' => $cities
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('cityManagers.create', [
            'cities' => $cities
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGymManagerRequest  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(StoreGymManagerRequest $request)
    public function store(Request $request)
    {
//        dd($request);
        //fetch request data
        $requestData = request()->all();

        // deal with image
        $image = $request->img;


        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'users/'), $imageName);
        else :
            $imageName = 'cityMgr.png';
        endif;



        // store new data into data base
        $newCityManager = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),

            'profile_img' => $imageName,
            'national_id' => $requestData['national_id'],

            'city_id' => $request['city_id'],
            'role_type' => 'cityManager',
            'role_id' => 2,

        ]);
        $newCityManager->assignRole('cityManager')->givePermissionTo(['create gym','create gym manager','create coach','create session',

        'update gym manager','update gym','update coach','update session',

        'delete gym manager','delete gym','delete coach','delete session',

        'read gym manager','read gym','read coach','read package',

        'read session','assign coach']);

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
        $cities = City::all();

        return view('cityManagers.edit', [
            'cityManager' => $cityManager,
            'cities' => $cities
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGymManagerRequest  $request
     * @param  \App\Models\GymManager  $gymManager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityManagerRequest $request, $cityManagerID)
    {
        //fetch request data
        $requestData = request()->all();

        // update new data into data base
        CityManager::find($cityManagerID)->update([

            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'national_id' => $requestData['national_id'],
            'city_id' => $requestData['city_id']
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
