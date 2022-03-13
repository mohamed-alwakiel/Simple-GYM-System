<?php

namespace App\Http\Controllers;

use App\Models\City;

use App\Http\Requests\CityRequest;
use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

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

    public function show($cityID)
    {
        $city = City::findOrFail($cityID);
        return view('cities.show', ['city' => $city]);
    }

    public function store(CityRequest $request)
    {

        $requestDate = request()->all();
        City::create($requestDate);
        return redirect()->route('cities.index');
    }
    public function edit($city_id)
    {
        $city = City::find($city_id);
        return view('cities.edit', compact('city'));
    }
    public function update(CityRequest $request, $city_id)
    {
        City::find($city_id)->update($request->all());
        return redirect()->route('cities.index');
    }

    public function destroy($cityID)
    {
        $checkGym = Gym::where('city_id', $cityID)->first();
        $checkUserORManager = User::where('city_id', $cityID)->first();
        $checkBuyPackage = BuyPackage::where('city_id', $cityID)->first();

        if ($checkUserORManager == null && $checkBuyPackage == null && $checkGym == null) {
            City::findOrFail($cityID)->delete();
            return to_route('cities.index')
                ->with('success', 'City deleted successfully');
        } else {
            // return Redirect::back()->withErrors(['message' => 'delete']);
            return redirect()->route('cities.index')
                ->with('errorMessage', 'cannt be deleted');
        }
    }

    public function deleteMedia($oldImg, $path)
    {
        $oldImg = public_path("imgs//$path//" . $oldImg);
        if (file_exists($oldImg)) {
            unlink($oldImg);
        }
    }
}
