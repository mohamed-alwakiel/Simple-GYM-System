<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyPackageController extends Controller
{
    public function index()
    {       
        return view('buyPackage.index');
    }
}
