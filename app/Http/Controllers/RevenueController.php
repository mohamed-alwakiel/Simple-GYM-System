<?php

namespace App\Http\Controllers;

use App\Models\GymManager;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGymManagerRequest;
use App\Http\Requests\UpdateGymManagerRequest;
use App\Models\BuyPackage;
use App\Models\City;
use App\Models\CityManager;
use App\Models\Gym;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Yajra\DataTables\Facades\DataTables;

class RevenueController extends Controller
{
    public function index()
    {
        $isAdmin = auth()->user()->hasRole('admin');
        $isCityManager = auth()->user()->hasRole('cityManager');
        $isGymManager = auth()->user()->hasRole('gymManager');

        if ($isAdmin) {
            $boughtPackages = BuyPackage::all();
        } elseif ($isCityManager) {
            $boughtPackages = BuyPackage::where('city_id', auth()->user()->city_id)->get();
        } elseif ($isGymManager) {
            $boughtPackages = BuyPackage::where('gym_id', auth()->user()->gym_id)->get();
        }

        return view('revenue.index', data:[
            'boughtPackages'=>$boughtPackages,
        ]);
    }
    
    public function show(BuyPackage $boughtPackage)
    {
        return view('revenue.show', ['boughtPackage' => $boughtPackage]);
    }
    
    public function destroy($id)
    {
        BuyPackage::find($id)->delete();
        return response()->json(['success' => 'Bought Package deleted successfully']);
    }
}
