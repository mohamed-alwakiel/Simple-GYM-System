<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class BuyPackageController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $boughtPackageCollection = BuyPackage::paginate(10);
        return view('buyPackage.index',['boughtPackageCollection' => $boughtPackageCollection]);
    }

    public function show(BuyPackage $Package)
    {
        return view('buyPackage.show', ['package' => $Package]);
    }

    public function destroy(BuyPackage $package)
    {
        $package->delete();

        return to_route('buyPackage.index')
            ->with('success', 'package deleted successfully');
    }

    public function create()
    {
        $cities = DB::table("cities")->get();
        $packages = DB::table('training_packages')->get();
        $users = User::where('role_id', 4)->get();
        
       $user = Auth::user();
       if($user->role_id==1){
        return view('payment.create', data: [
            'cities' => $cities,
            'packages' => $packages,
            'users' => $users,
        ]);
       }elseif($user->role_id==2){
        return view('payment.create', data: [
            'cities' => DB::table("cities")->where('id',$user->city_id)->get(),
            'packages' => $packages,
            'users' => $users,
        ]);
       }
    //    }elseif($user->role_id==3){
        
    //     $gymId = DB::table('gyms')->where('id',$user->gym_id)->select('city_id')->get();

    //     return view('payment.create', data: [
    //         'cities' => DB::table("cities")->where('id', $gymId)->get(),
    //         'packages' => $packages,
    //         'users' => $users,
    //     ]);
    //    }
    }


 public function store(Request $requestObj)
    {
        // $requestData = $requestObj->all();
         $test = Test::first();

        $package = DB::table('training_packages')->where('id', $test->package_id)->first();
       

        BuyPackage::create([

            'price' => $package->price,
            'number_of_sessions' => $package->number_of_sessions,
            'remaining_sessions'=>$package->number_of_sessions,
            'package_id' => $test->package_id,
            'gym_id' => $test->gym_id,
            'user_id' => $test->user_id,
            'city_id'=> $test->city_id,
        ]);
        DB::table('test')->delete();

        return to_route('buyPackage.index');
    }


    public function getGymsBelongsToCity($id)

    {
        // $user = Auth::user();
        // if($user->role_id==3){
        //     echo json_encode(DB::table('gyms')->where('id', $user->gym_id)->get());
        // }else{
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
        
    }


}
