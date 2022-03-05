<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\GymManager;
use App\Models\Package;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $packages = Package::all();
        $boughtPackages = BuyPackage::all();
        
        return view('dashboard', data: [
            'packages' => $packages,
            'boughtPackages' => $boughtPackages,
        ]);
    }




    // for ban and unban users










}
