<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoachRequest;
use App\Models\Gym;
use App\Models\City;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $coaches = $this->getCoachesAndGymsData()[0];
        $gyms = $this->getCoachesAndGymsData()[1];
        $cities = $this->getCoachesAndGymsData()[2];


        return view('coaches.create', [
            'coaches' => $coaches,
            'gyms' => $gyms,
            'cities' => $cities,
        ]);
    }

    public function store(CoachRequest $request)
    {
        $requestedData = request()->all();
        Coach::create($requestedData);

        return redirect()->route('coaches.index');
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
        $coach->gym()->dissociate();
        $coach->trainingSessions()->detach();
        $coach->delete();
        return redirect()->route('coaches.index');
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
