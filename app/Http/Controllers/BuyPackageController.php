<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyPackageController extends Controller
{
    public function index()
    {

        $cities = DB::table("cities")->get();
        $packages = DB::table('training_packages')->get();
        $users = User::where('role_id', 4)->get();

        return view('buyPackage.index', data: [
            'cities' => $cities,
            'packages' => $packages,
            'users' => $users,
        ]);;
    }

    public function myform()

    {
    }


    /**

     * Get Ajax Request and restun Data

     *

     * @return \Illuminate\Http\Response

     */

    public function getGymsBelongsToCity($id)

    {
        echo json_encode(DB::table('gyms')->where('city_id', $id)->get());
    }
}
