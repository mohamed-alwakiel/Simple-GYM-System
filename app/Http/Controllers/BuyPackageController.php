<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;


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

  
}
