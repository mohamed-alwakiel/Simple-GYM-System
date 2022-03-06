<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymRequest;
use App\Models\City;
use App\Models\Gym;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GymsController extends Controller
{

    public function index()
    {
        $gyms=Gym::all();
        $cities = City::all();
//        dd($gyms);
        return view('gyms.datatable', compact('gyms','cities'));
    }

    public function getGym()
    {
        if (request()->ajax()) {
            $data = Gym::all();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('cover',function($row){
                    $url=$row->cover_img;

                    return view('gyms.widget_cover',compact("url"));
                })
                ->addColumn('city',function($row){
                    return $row->city->name;
                })

                ->addColumn('action', function($row){


                    $edit='<a href="'. route('gyms.edit', $row->id) .'" class="btn btn-primary">Update</a>';


                    $delete='
                     <form action="'.route('gyms.destroy', $row->id).'" method="post">

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    ';

                    return $edit . ' ' . $delete;

                })

                ->make(true);
        }
        return view('gyms.datatable');
//        return datatables()->of(Gym::with('city'))->toJson();
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

        $image = $request->cover_img;

        $imageName = time() . rand(1, 200) . '.' . $image->extension();
        $image->move(public_path('imgs//' . 'gym'), $imageName);


        Gym::create([
            'name' => $request->name,
            'cover_img' => $imageName,
            'city_id' => $request->city_id
        ]);
        return redirect()->route('gyms.index');
    }

    public function edit($gym_id){

        $gym = Gym::find($gym_id);
        $cities = City::all();
        return view('gyms.edit', compact('gym', 'cities'));
    }

    public function update(GymRequest $request, $gym_id){
//        dd($request);
        $gym = Gym::find($gym_id);
        // get yem

        $data = $request->except('cover_img');


        // all data exeept image
        if( $request->cover_img){
//            if user want update image
            // get old image
            $oldImage = public_path("imgs//gym//" . $gym->cover_img);
            if( file_exists($oldImage)){
                // delete old image
                unlink($oldImage);
            }
            $image = $request->cover_img;
            // create new name for image
            $imageName = time() . rand(1, 200) . '.' . $image->extension();
            // move image to public folder
            $image->move(public_path('imgs//' . 'gym'), $imageName);
            // add image to data
            $data['cover_img'] =$imageName;
        }
        // update gym ;
        Gym::find($gym_id)->update($data);
        return redirect()->route('gyms.index');
    }

    public function destroy($gym_id) {

        Gym::find($gym_id)->delete();

        return redirect()->route('gyms.index');
    }
}
