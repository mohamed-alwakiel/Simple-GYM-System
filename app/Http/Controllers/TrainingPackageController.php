<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Pagination\Paginator;

class TrainingPackageController extends Controller
{
    public function index()
    {
        // Paginator::useBootstrapFive();
        $packageCollection = Package::paginate(10);
        return view('trainingPackages.index',['packageCollection' => $packageCollection]);
    }

    public function show(Package $Package)
    {
        return view('trainingPackages.show', ['package' => $Package]);
    }

    public function create()
    {
        return view('trainingPackages.create');
    }

    public function store(StorePackageRequest $requestObj)
    {
        Package::create($requestObj->all());
        return to_route('trainingPackages.index');
    }

    public function edit(Package $Package)
    {
        return view(
            'trainingPackages.edit',
            ['package' => $Package]
        );
    }

    public function update($package_id,StorePackageRequest $requestObj)
    {
        $package =  Package::findOrFail($package_id);
        $package->update($requestObj->all());
        $package->save();
        return to_route('trainingPackages.show', ['package' => $package])
        ->with('success', 'Package Updated Successfully');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return to_route('trainingPackages.index')
            ->with('success', 'package deleted successfully');
       
    }
}

