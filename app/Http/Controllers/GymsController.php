<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymRequest;
use App\Models\City;
use App\Models\Gym;
use Illuminate\Http\Request;

class GymsController extends Controller
{
    public function index()
    {
        $gyms=Gym::all();
        $cities = City::all();
        return view('gyms.index', compact('gyms','cities'));
    }
    public function create() {
        $cities = City::all();
        $gyms = Gym::all();

        return view('gyms.create', [
            'gyms' => $gyms,
            'cities' => $cities,
        ]);
    }

    public function store(GymRequest $request){

        $requestData = request()->all();
        Gym::create($requestData);
        return redirect()->route('gyms.index');
    }

    public function edit($gym_id){

        $gym = Gym::find($gym_id);
        $cities = City::all();
        return view('gyms.edit', compact('gym', 'cities'));
    }

    public function update(GymRequest $request, $gym_id){
        Gym::find($gym_id)->update($request->all());
        return redirect()->route('gyms.index');
    }

    public function destroy($gym_id) {
        Gym::find($gym_id)->delete();

        return redirect()->route('gyms.index');
    }
}
