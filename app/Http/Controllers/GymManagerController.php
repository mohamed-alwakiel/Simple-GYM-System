<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gyms = Gym::all();

        return view('gymManagers.create', [
            'gyms' => $gyms
        ]);
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
            $image->move(public_path('imgs//' . 'GymMgr'), $imageName);
        else :
            $imageName = 'gymMgr.png';
        endif;

        // store new data into data base
        $newGymManager = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),

            'profile_img' => $imageName,
            'national_id' => $requestData['national_id'],

            'gym_id' => $request['gym_id'],

            'role_type' => 'gymManager',
            'role_id' => 3,
        ]);
        $newGymManager->assignRole('gymManager')->givePermissionTo(['create session','update session','delete session',
        'read session', 'read coach','read package', 'assign coach']);


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
        $gyms = Gym::all();

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
}
