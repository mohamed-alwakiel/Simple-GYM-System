<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoachesController extends Controller
{
    public function index()
    {       
        return view('coaches.index');
    }
}
