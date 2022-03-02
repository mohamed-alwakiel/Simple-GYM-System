<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

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
