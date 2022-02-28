<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingPackagesController extends Controller
{
    public function index()
    {       
        return view('trainingPackages.index');
    }
}
