<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Support\Facades\Session;
use App\Models\BuyPackage;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;


class TrainingPackageController extends Controller
{
    public function index()
    {
        $packageCollection = Package::all();
        return view('trainingPackages.index', ['packageCollection' => $packageCollection]);
    }

    public function trainingPackagesDatatables()
    {
        $packageCollection = Package::all();

        return view('trainingPackages.datatables-front', ['packageCollection' => $packageCollection]);
    }

    public function show(Package $Package)
    {
        $id = $Package->id;
        $package_id = BuyPackage::find($id);
        return view('trainingPackages.show', ['package' => $Package, 'package_id' => $package_id]);
    }

    public function create()
    {
        return view('trainingPackages.create');
    }

    public function store(StorePackageRequest $requestObj)
    {
        Package::create([
            'name' => $requestObj->name,
            'price' => $requestObj->price * 100,
            'number_of_sessions' => $requestObj->number_of_sessions,

        ]);
        return to_route('trainingPackages.index');
    }

    public function edit(Package $Package)
    {
        return view(
            'trainingPackages.edit',
            ['package' => $Package]
        );
    }

    public function update($package_id, UpdatePackageRequest $requestObj)
    {
        $package =  Package::findOrFail($package_id);
        $package->update([
            'price' => $requestObj->price * 100,
            'number_of_sessions' => $requestObj->number_of_sessions,
        ]);
        $package->save();
        return to_route('trainingPackages.show', ['package' => $package])
            ->with('success', 'Package Updated Successfully');
    }


    public function destroy(Package $package)
    {
        $id = $package->id;
        $package_id = BuyPackage::where('package_id', $id)->first();

        if ($package_id == null) {
            $package->delete();
            return to_route('trainingPackages.index')
                ->with('success', 'package deleted successfully');

        } else {
            return redirect()->route('trainingPackages.index')->with('errorMessage', 'cannt be deleted');
        }
    }
}
