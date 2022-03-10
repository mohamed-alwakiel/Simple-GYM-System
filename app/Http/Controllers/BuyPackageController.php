<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\BuyPackage;
use App\Models\CityManager;
use App\Models\Gym;
use App\Models\GymManager;
use App\Models\Package;
use App\Models\Stripe;
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
        $isAdmin = auth()->user()->hasRole('admin');
        $isCityManager = auth()->user()->hasRole('cityManager');
        $isGymManager = auth()->user()->hasRole('gymManager');

        if ($isAdmin) {
            $boughtPackageCollection = BuyPackage::all();
        } elseif ($isCityManager) {
            $boughtPackageCollection = BuyPackage::where('city_id', auth()->user()->city_id)->get();
        } elseif ($isGymManager) {
            $boughtPackageCollection = BuyPackage::where('gym_id', auth()->user()->gym_id)->get();
        }else{
            $boughtPackageCollection = BuyPackage::where('user_id', auth()->user()->id)->get();
        }
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
        $packages = DB::table('training_packages')->get();
        $users = User::Role('client')->get();
        $roleAdmin  = Auth::user()->hasRole('admin');
        $roleCityManager = Auth::user()->hasRole('cityManager');
        $roleGymManager = Auth::user()->hasRole('gymManager');

        $loggedInUser = Auth::user();
        $user = User::role('cityManager')->get()->where('id', $loggedInUser->id)->where('city_id', $loggedInUser->city_id);


        if ($roleAdmin) {
            $cities = DB::table("cities")->get();
            return view('payment.create', data: [
                'cities' => $cities,
                'packages' => $packages,
                'users' => $users,
            ]);
        } elseif ($roleCityManager) {
            $city_id = $loggedInUser->city_id;
            $gym_id = Gym::where('city_id', $city_id)->get();
        } elseif ($roleGymManager) {
            $gym_id = $loggedInUser->gym_id;
            $city_id = $loggedInUser->city_id;
        }

        return view('payment.create', data: [
            'cities' => $city_id,
            'packages' => $packages,
            'users' => $users,
            'gyms' => $gym_id,
        ]);
    }


    public function store(Request $requestObj)
    {
        $paymentData = Stripe::first();

        $package = DB::table('training_packages')->where('id', $paymentData->package_id)->first();


        BuyPackage::create([

            'price' => ($package->price / 100),
            'number_of_sessions' => $package->number_of_sessions,
            'remaining_sessions' => $package->number_of_sessions,
            'package_id' => $paymentData->package_id,
            'name' =>  $paymentData->name,
            'gym_id' => $paymentData->gym_id,
            'user_id' => $paymentData->user_id,
            'city_id' => $paymentData->city_id,
        ]);
        DB::table('stripe')->delete();

        return to_route('buyPackage.index');
    }


    public function getGymsBelongsToCity($id)

    {
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
    }
}
