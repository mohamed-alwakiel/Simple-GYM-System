<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymManagersController extends Controller
{
    public function index()
    {       
        return view('gymManagers.index');
    }
}
