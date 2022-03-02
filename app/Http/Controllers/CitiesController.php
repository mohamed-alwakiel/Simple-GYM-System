<?php

namespace App\Http\Controllers;

use App\Models\City;

use App\Http\Requests\CityRequest;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();

        return view('cities.index', compact('cities'));
    }
    public function create()
    {

        return view('cities.create');
    }
    public function store(CityRequest $request )
    {

        $requestDate = request()->all();
        City::create($requestDate);
        return redirect()->route('cities.index');
    }
    public function edit( $city_id )
    {
        $city = City::find($city_id);
        return view('cities.edit', compact('city'));

    }
    public function update(CityRequest $request, $city_id )
    {
        City::find($city_id)->update($request->all());
        return redirect()->route('cities.index');

    }
    public function destroy($city_id) {
        City::find($city_id)->delete();

        return redirect()->route('cities.index');
    }
}
