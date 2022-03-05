<?php

namespace App\Http\Controllers;

use App\Models\City;

use App\Http\Requests\CityRequest;
use App\Models\Gym;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
            return view('cities.datatable');
//        return view('cities.index', compact('cities'));
    }
    public function getCity()
    {
        if (request()->ajax()) {
            $data = City::all();
            return DataTables::of($data)
                ->addIndexColumn()


                ->addColumn('name',function($row){
                    return $row->name;
                })

                ->addColumn('action', function($row){


                    $edit='<a href="'. route('cities.edit', $row->id) .'" class="btn btn-primary">Update</a>';


                    $delete='
                     <form action="'.route('cities.destroy', $row->id).'" method="post">

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
//        return datatables()->of(Gym::with('city'))->toJson();
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

        $city = City::find($city_id);

        if ($city->gyms()) {
            $imageOfGym = DB::table('gyms')->select('cover_img')->where('city_id', $city_id)->first()->cover_img; // find all image name belong to city
            $this->deleteMedia($imageOfGym, 'gym');
            $city->gyms()->delete(); //delete all gyms
        };
        $city->delete(); //delete city
        return redirect()->back()->with('success', 'deleted done');

    }

    public function deleteMedia($oldImg, $path)
    {
        $oldImg = public_path("imgs//$path//" . $oldImg);
        if( file_exists($oldImg)){
            unlink($oldImg);
        }
    }

}
