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

        return view('revenue.datatable');
    }

    public function getRevenue(Request $request)
    {
        $isAdmin = auth()->user()->hasRole('admin');
        $isCityManager = auth()->user()->hasRole('cityManager');
        $isGymManager = auth()->user()->hasRole('gymManager');

        if (request()->ajax()) {

            if ($isAdmin) {
                $boughtPackages = BuyPackage::all();

                return DataTables::of($boughtPackages)
                    ->addColumn('Client Name', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('Client Email', function ($row) {
                        return $row->user->email;
                    })
                    ->addColumn('Package Name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('Paid Price', function ($row) {
                        return $row->price;
                    })
                    ->addColumn('Gym', function ($row) {
                        return $row->gym->name;
                    })
                    ->addColumn('City', function ($row) {
                        // return $row->gym->name;
                        return $row->gym->city->name;
                    })


                    ->addColumn('action', function ($row) {
                        $delete = '<button type="button" data-id="' . $row->id . '" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } elseif ($isCityManager) {
                // $boughtPackages = BuyPackage::where('gym_id', auth()->user()->gym->gym_id)->get();
                $boughtPackages = BuyPackage::all();
                return DataTables::of($boughtPackages)
                    // ->addIndexColumn()

                    ->addColumn('Client Name', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('Client Email', function ($row) {
                        return $row->user->email;
                    })
                    ->addColumn('Package Name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('Paid Price', function ($row) {
                        return $row->price;
                    })
                    ->addColumn('Gym', function ($row) {
                        return $row->gym->name;
                    })

                    ->addColumn('action', function ($row) {
                        $delete = '<button type="button" data-id="' . $row->id . '" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';

                        return $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } elseif ($isGymManager) {
                $boughtPackages = BuyPackage::where('gym_id', auth()->user()->gym_id)->get();

                return DataTables::of($boughtPackages)
                    // ->addIndexColumn()

                    ->addColumn('Client Name', function ($row) {
                        return $row->user->name;
                    })
                    ->addColumn('Client Email', function ($row) {
                        return $row->user->email;
                    })
                    ->addColumn('Package Name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('Paid Price', function ($row) {
                        return $row->price;
                    })
                    ->addColumn('action', function ($row) {
                        $delete = '<button type="button" data-id="' . $row->id . '" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                        return $delete;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        return view('revenue.datatable');
    }

    public function destroy($id)
    {
        BuyPackage::find($id)->delete();
        return response()->json(['success' => 'Product deleted successfully']);
    }
}
