<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymsController extends Controller
{
    public function index()
    {       
        return view('gyms.index');
    }
}
