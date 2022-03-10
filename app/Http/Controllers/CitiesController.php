<?php

namespace App\Http\Controllers;

use App\Models\City;

use App\Http\Requests\CityRequest;
use App\Models\Gym;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }
    public function getCity()
    {
        if (request()->ajax()) {
            $data = City::all();
            return DataTables::of($data)
                ->addIndexColumn()


                ->addColumn('name', function ($row) {
                    return $row->name;
                })

                ->addColumn('action', function ($row) {


                    $edit = '<a href="' . route('cities.edit', $row->id) . '" class="btn btn-primary">Update</a>';


                    $delete = '
                     <form action="' . route('cities.destroy', $row->id) . '" method="post">

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    ';

                    return $edit . ' ' . $delete;
                })

                ->make(true);
        }
        return view('cities.datatable');
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
        try {
            City::findOrFail($cityID)->delete();
            return redirect()->route('cities.index');
        } catch (QueryException $e) {
            return redirect()->route('cities.index');
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
