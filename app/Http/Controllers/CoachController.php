<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Coach;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CoachController extends Controller
{
    public function index()
    {
        $coaches=Coach::all();

        return view('coaches.index',
        [
            'coaches' => $coaches
        ]);
    }
    public function getCoaches()
    {
        if (request()->ajax()) {
            $coaches=Coach::all();


            return DataTables::of($coaches)
                ->addIndexColumn()


                ->addColumn('name',function($row){
                    return $row->name;
                })

                ->addColumn('action', function($row){


                    $edit='<a href="'. route('coaches.edit', $row->id) .'" class="btn btn-primary">Update</a>';


                    $delete='
                     <form action="'.route('coaches.destroy', $row->id).'" method="post">

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    ';

                    return $edit . ' ' . $delete;

                })

                ->make(true);
        }
        return view('coaches.datatable');
//        return datatables()->of(Gym::with('city'))->toJson();
    }

    public function create()
    {
        $coaches=Coach::all();

        return view('coaches.create',
        [
            'coaches' => $coaches
        ]);
    }


    public function store()
    {
        $requestedData=request()->all();
        Coach::create($requestedData);

        return redirect()->route('coaches.index');
    }


    public function show($id)
    {
        $coach= Coach::find($id);


        return view('$coaches.show', [
            'coaches' => $coach
        ]);
    }


    public function edit($id)
    {
        $coach= Coach::find($id);
        return view('coaches.update', [
            'coaches' => $coach
        ]);

    }

    public function update( $id)
    {
        $formDAta=request()->all();

        $coach=Coach::find($id)->update($formDAta);

         return redirect()->route('coaches.index');
    }


    public function destroy($id)
    {
         $coach= Coach::find($id);

        $coach->delete();


        return redirect()->route('coaches.index');
    }
}
