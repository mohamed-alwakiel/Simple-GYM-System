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
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $packages = Package::all();
        $isAdmin = auth()->user()->hasRole('admin');
        $isCityManager = auth()->user()->hasRole('cityManager');
        $isGymManager = auth()->user()->hasRole('gymManager');
        $isClient = auth()->user()->hasRole('client');

        if (!$isClient) {
            if ($isAdmin) {
                $boughtPackages = BuyPackage::all();
                $boughtPackagesCount = count($boughtPackages);
                $allClients = User::role('client')->get();
            } elseif ($isCityManager) {
                $boughtPackages = BuyPackage::where('city_id', auth()->user()->city_id)->get();
                $boughtPackagesCount = count($boughtPackages);
                $allClients = User::role('client')->where('city_id', auth()->user()->city_id)->get();
            } elseif ($isGymManager) {
                $boughtPackages = BuyPackage::where('gym_id', auth()->user()->gym_id)->get();
                $boughtPackagesCount = count($boughtPackages);
                $allClients = User::role('client')->where('gym_id', auth()->user()->gym_id)->get();
            }

            $paidPrice = ($boughtPackages->sum('price') / 100);
            $allClientsCount = count($allClients);

            return view('dashboard', data: [
                'packages' => $packages,
                'boughtPackages' => $boughtPackages,
                'boughtPackagesCount' => $boughtPackagesCount,
                'allClientsCount' => $allClientsCount,
                'paidPrice' => $paidPrice,
            ]);
        } else {
            $boughtPackages = BuyPackage::where('user_id', auth()->user()->id)->get();
            return view('dashboard', data: [
                'boughtPackages' => $boughtPackages,
            ]);
        }
    }
}
