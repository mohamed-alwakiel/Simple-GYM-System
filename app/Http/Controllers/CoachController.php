<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachRequest;
use App\Models\Gym;
use App\Models\City;
use App\Models\Coach;
use App\Models\CoachSession;
use Database\Factories\CoachFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = $this->getCoachesAndGymsData()[0];

        return view(
            'coaches.index',
            [
                'coaches' => $coaches
            ]
        );
    }

    public function create()
    {

        $roleAdmin  = Auth::user()->hasRole('admin');
        $roleCityManager = Auth::user()->hasRole('cityManager');
        $roleGymManager = Auth::user()->hasRole('gymManager');

        $loggedInUser = Auth::user();


        if ($roleAdmin) {
            $cities = City::get();
            return view('coaches.create', data: [
                'cities' => $cities,
            ]);
        } elseif ($roleCityManager) {
            $city_id = $loggedInUser->city_id;
            $gym_id = Gym::where('city_id', $city_id)->get();
        
        } elseif ($roleGymManager) {
            $gym_id = $loggedInUser->gym_id;
            $city_id = $loggedInUser->city_id;
        }

        return view('coaches.create', data: [
            'cities' => $city_id,
            'gyms' => $gym_id,
        ]);
    }

    public function store(CoachRequest $request)
    {

        $gym_id = $request->gym_id;
        $name = $request->name;
        if ($gym_id == null ) {
            return Redirect::back()->withErrors(['message' => 'complete your data']);
        } else {
            Coach::create([
                'name' =>  $name,
                'gym_id' => $gym_id,
            ]);

        return redirect()->route('coaches.index');
        }
    }

    public function show($id)
    {
        $coach = Coach::findOrFail($id);
        return view('coaches.show', ['coach' => $coach]);
    }


    public function edit($id)
    {
        $coach = Coach::find($id);
        $gyms = $this->getCoachesAndGymsData()[1];
        $cities = $this->getCoachesAndGymsData()[2];

        return view(
            'coaches.edit',
            [
                'coaches' => $coach,
                'gyms' => $gyms,
                'cities' => $cities,
            ]
        );
    }

    public function update($id, CoachRequest $request)
    {
        $formDAta = request()->all();
        $coach = Coach::find($id)->update($formDAta);
        return redirect()->route('coaches.index');
    }


    public function destroy($id)
    {
        $coach = Coach::find($id);
        $checkSession = CoachSession::where('coach_id', $id)->first();

        if ($checkSession == null) {
            $coach->gym()->dissociate();
            $coach->trainingSessions()->detach();
            $coach->delete();
            return to_route('coaches.index')
                ->with('success', 'Coach deleted successfully');
        } else {
            // return Redirect::back()->withErrors(['message' => 'delete']);
            return redirect()->route('coaches.index')->with('errorMessage', 'cannt be deleted');

        }
    }


    public function getCoachesAndGymsData()
    {
        $roleAdmin = auth()->user()->hasRole('admin');
        $roleCityManager = auth()->user()->hasRole('cityManager');
        $roleGymManager = auth()->user()->hasRole('gymManager');

        if ($roleAdmin) {
            $coaches = Coach::all();
            $cities = City::all();
            $gyms = Gym::all();
        } elseif ($roleCityManager) {
            $coaches = Auth::user()->city->coaches;
            $gyms = Auth::user()->city->gyms;
            $cities = Auth::user()->city;
        } elseif ($roleGymManager) {
            $coaches = Auth::user()->gym->coaches;
            $gyms = Auth::user()->gym;
            $cities = Auth::user()->city;
        }

        return [$coaches, $gyms, $cities];
    }
}
