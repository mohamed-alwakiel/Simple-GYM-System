<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function stripe(Request $request)
    {

     

        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://127.0.0.1:8000/buyPackage/create';

        $checkout_session = \Stripe\Checkout\Session::create([          
            'amount' => 100 * 150,
            'currency' => "inr",
            'source' => $request->stripeToken,
            'description' => "Making test payment." ,
            'mode' => 'payment',
            'source' => $request->stripeToken,
            'success_url' => $YOUR_DOMAIN . '/success',
            'cancel_url' => $YOUR_DOMAIN . '/cancel',
        ]);


        header("HTTP/1.1 303 See Other");

        return redirect($checkout_session->url); 
    }
    public function store(Request $requestObj)
    {
        DB::table('test')->delete();
        $requestData = $requestObj->all();
        $package = DB::table('training_packages')->where('id', $requestObj->get('package_id'))->first();

        Test::create([

            'price' => $package->price,
            'number_of_sessions' => $package->number_of_sessions,
            'package_id' => $requestObj->package_id,
            'gym_id' => $requestObj->gym_id,
            'user_id' => $requestObj->user_id,
            'city_id' => $requestObj->city,
        ]);
   
        return redirect()->away('https://buy.stripe.com/test_28o9D32OG3z0fT2144');
    }
    public function success()
    {
        
        // return to_route('buyPackage.store');
        return view('payment.success');
    }

    public function cancel()
    {
        DB::table('test')->delete();

        return to_route('buyPackage.index');
    }
}
