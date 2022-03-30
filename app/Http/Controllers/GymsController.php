<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymRequest;
use App\Models\BuyPackage;
use App\Models\City;
use App\Models\Coach;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\Session;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class GymsController extends Controller
{

    public function index()
    {
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        // if Role Admin
        if ($roleAdmin) {
            $gyms = Gym::all();
            return view('gyms.index', ['gyms' => $gyms]);
        } elseif ($roleCityManager) {
            // if city manager
            $city_id = Auth::user()->city_id;
            $gyms = Gym::where('city_id', $city_id)->get();
            return view('gyms.index', ['gyms' => $gyms]);
        }
    }

    public function create()
    {

        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');
        if ($roleAdmin) {
            $cities = City::all();
            return view('gyms.create', ['cities' => $cities]);
        } elseif ($roleCityManager) {
            // if city manager

            $city_id = Auth::user()->city_id;

            $gyms = Gym::where('city_id', $city_id)->get();
            return view('gyms.create', ['gyms' => $gyms]);
        }
    }

    public function store(GymRequest $request)
    {
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');

        $image = $request->cover_img;

        if ($image != null) :
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'gym'), $imageName);
        else :
            $imageName = 'gym.png';
        endif;

        if ($roleAdmin) {
            $city_id =  $request->city_id;
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
        }

        Gym::create([
            'name' => $request->name,
            'cover_img' => $imageName,
            'city_id' => $city_id
        ]);
        return redirect()->route('gyms.index');
    }

    public function edit($gym_id)
    {

        $gym = Gym::find($gym_id);
        $cities = City::all();
        return view('gyms.edit', compact('gym', 'cities'));
    }

    public function update(GymRequest $request, $gym_id)
    {
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleAdmin = auth()->user()->hasRole('admin');
        
        
        if ($roleAdmin) {
            $city_id = $request['city_id'];
        } elseif ($roleCityManager) {
            $city_id = Auth::user()->city_id;
        }

        $gym = Gym::find($gym_id);


        if ($request->cover_img) :
            $oldImage = public_path("imgs//gym//" . $gym->cover_img);
            
            if ($oldImage != "gym.png") {
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $image = $request->cover_img;
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            $image->move(public_path('imgs//' . 'gym'), $imageName);

            DB::table('gyms')->where('id', $gym_id)->update(['cover_img' => $imageName]);
        endif;


        Gym::find($gym_id)->update([
            'name' => $request->name,
            'city_id' => $city_id
        ]);

        return redirect()->route('gyms.index');
    }

    public function destroy($gymID)
    {

        $checkUserORManager = User::where('gym_id', $gymID)->first();
        $checkBuyPackage = BuyPackage::where('gym_id', $gymID)->first();
        $checkSession = TrainingSession::where('gym_id', $gymID)->first();
        $checkCoach = Coach::where('gym_id', $gymID)->first();

        if ($checkUserORManager == null && $checkBuyPackage == null && $checkSession == null && $checkCoach == null) {
            $oldimg = Gym::where('id', $gymID)->first()->cover_img;
            if ($oldimg != "gym.png") {
                // to delete old image
                if (file::exists(public_path('imgs//' . 'gym/' . $oldimg))) {
                    file::delete(public_path('imgs//' . 'gym/' . $oldimg));
                }
            }

            Gym::findOrFail($gymID)->delete();
            return to_route('gyms.index')->with('success', 'Gym deleted successfully');
        } else {
            return redirect()->route('gyms.index')->with('errorMessage', 'cannt be deleted');
        }
    }
}
