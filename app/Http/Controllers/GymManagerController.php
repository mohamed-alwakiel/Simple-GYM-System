<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\City;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GymManagerController extends Controller
{

    public function index()
    {

        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            $gymManagers = User::role('gymManager')->get();
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
            $gymManagers = User::role('gymManager')->where('city_id', $city_id)->get();
        }
        return view('gymManagers.index', [
            'gymManagers' => $gymManagers,
        ]);
    }

    public function create()
    {
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            $cities = City::all();
            return view('gymManagers.create', ['cities' => $cities]);
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
            $gyms = Gym::where('city_id', $city_id)->get();
            return view('gymManagers.create', ['gyms' => $gyms]);
        }
    }

    public function GetGymNameFromCityName(Request $request)
    {
        $city_id = $request->get('city_id');
        $gyms = Gym::where('city_id', '=', $city_id)->get();
        return response()->json($gyms);
    }

    public function show($managerID)
    {
        $manager = User::findOrFail($managerID);
        return view('gymManagers.show', ['manager' => $manager]);
    }

    public function store(StoreGymManagerRequest $request)
    {
        $requestData = request()->all();
        $image = $request->img;

        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'users/'), $imageName);
        else :
            $imageName = 'gymMgr.png';
        endif;

        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        if ($roleAdmin) {
            $city_id = $request['city_id'];
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
        }

        $newGymManager = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'profile_img' => $imageName,
            'national_id' => $requestData['national_id'],
            'city_id' => $request['city_id'],
            'gym_id' => $request['gym_id'],
            'city_id' => $city_id,
            'gym_id' => $request['gym_id'],
            'email_verified_at' =>  Carbon::now()->toDateTimeString(),
        ]);

        $newGymManager->assignRole('gymManager')->givePermissionTo([
            'create session', 'update session', 'delete session',
            'read session', 'read coach', 'read package', 'assign coach'
        ]);

        return redirect()->route('gymManagers.index');
    }

    public function edit($gymManagerID)
    {
        $gymManager = GymManager::find($gymManagerID);
        $gyms = Gym::where('city_id', $gymManager->city_id)->get();

        return view('gymManagers.edit', [
            'gymManager' => $gymManager,
            'gyms' => $gyms
        ]);
    }

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

    public function destroy($gymManagerID)
    {
        User::findOrFail($gymManagerID)->delete();
        return redirect()->route('gymManagers.index');
    }

    public function ban($gymManager)
    {
        GymManager::findOrFail($gymManager)->ban([
            'comment' => 'Enjoy your ban!',
        ]);
        return redirect()->route('gymManagers.index');
    }

    public function unban($gymManager)
    {
        GymManager::findOrFail($gymManager)->unban();
        return redirect()->route('gymManagers.index');
    }

    public function banView()
    {
        $bannedManagers = GymManager::onlyBanned()->get();
        return view('gymManagers.banned', [
            "bannedManagers" => $bannedManagers
        ]);
    }
}
