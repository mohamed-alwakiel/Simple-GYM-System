<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityManagerRequest;
use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateCityManagerRequest;
use App\Models\City;
use App\Models\CityManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;


class CityManagerController extends Controller
{


    public function index()
    {
        $cityManagers = User::role('cityManager')->get();

        return view('cityManagers.index', [
            'cityManagers' => $cityManagers,
        ]);
    }

    public function create()
    {
        $cities = City::all();

        return view('cityManagers.create', [
            'cities' => $cities
        ]);
    }

    public function show($managerID)
    {
        $manager = User::findOrFail($managerID);
        return view('cityManagers.show', ['manager' => $manager]);
    }


    public function store(StoreGymManagerRequest $request)
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


        $newCityManager = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),

            'profile_img' => $imageName,
            'national_id' => $requestData['national_id'],

            'city_id' => $request['city_id'],
            'email_verified_at' => Carbon::now()->toDateTimeString(),

        ]);
        $newCityManager->assignRole('cityManager')->givePermissionTo([
            'create gym', 'create gym manager', 'create coach', 'create session',
            'update gym manager', 'update gym', 'update coach', 'update session',
            'delete gym manager', 'delete gym', 'delete coach', 'delete session',
            'read gym manager', 'read gym', 'read coach', 'read package',
            'read session', 'assign coach'
        ]);

        return redirect()->route('cityManagers.index');
    }


    public function edit($cityManagerID)
    {
        $cityManager = CityManager::find($cityManagerID);
        $cities = City::all();

        return view('cityManagers.edit', [
            'cityManager' => $cityManager,
            'cities' => $cities
        ]);
    }


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

        return redirect()->route('cityManagers.index');
    }


    public function destroy($cityManagerID)
    {
        $oldimg = CityManager::where('id', $cityManagerID)->first()->profile_img;
        if ($oldimg != "cityMgr.png") {
            // to delete old image
            if (file::exists(public_path('imgs//' . 'users/' . $oldimg))) {
                file::delete(public_path('imgs//' . 'users/' . $oldimg));
            }
        }

        CityManager::findOrFail($cityManagerID)->delete();
        return to_route('cityManagers.index')->with('success', 'user deleted successfully');
    }
}
