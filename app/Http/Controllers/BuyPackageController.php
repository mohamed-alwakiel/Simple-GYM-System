<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyPackageController extends Controller
{
    public function index()
    {
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

        // $users = User::all();
        // $packages = Package::all();
        // $gyms = Gym::all();

        return view('payment.create', data: [
            'cities' => $cities,
            'packages' => $packages,
            'users' => $users,
        ]);
    }


 public function store(Request $requestObj)
    {
        $requestData = $requestObj->all();
        $package = DB::table('training_packages')->where('id', $requestObj->get('package_id'))->first();

        BuyPackage::create([

            'price' => $package->price,
            'number_of_sessions' => $package->number_of_sessions,
            'package_id' => $requestObj->package_id,
            'gym_id' => $requestObj->gym_id,
            'user_id' => $requestObj->user_id,

        ]);
   
        return to_route('buyPackage.index');
    }


    public function getGymsBelongsToCity($id)

    {
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
    }

}
