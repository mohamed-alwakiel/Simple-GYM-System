<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityManagersController extends Controller
{
    public function index()
    {       
        return view('cityManagers.index');
    }
}
