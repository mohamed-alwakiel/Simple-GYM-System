<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\Stripe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function stripe(Request $request)
    {
        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://127.0.0.1:8000/buyPackage/create';

        $checkout_session = \Stripe\Checkout\Session::create([
            'source' => $request->stripeToken,
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success',
            'cancel_url' => $YOUR_DOMAIN . '/cancel',
        ]);


        header("HTTP/1.1 303 See Other");

        return redirect($checkout_session->url);
    }
    public function store(Request $requestObj)
    {
        DB::table('stripe')->delete();
        $requestData = $requestObj->all();
        $package = DB::table('training_packages')->where('id', $requestObj->get('package_id'))->first();
        $gym_id = $requestObj->gym_id;
        $user_id = $requestObj->user_id;
        $package_id = $requestObj->package_id;
        $city = $requestObj->city;

        if ($gym_id == null ||  $user_id == null ||  $package_id == null  || $city == null) {
            return Redirect::back()->withErrors(['message' => 'complete your data']);
        } else {

            Stripe::create([
                'price' => $package->price,
                'number_of_sessions' => $package->number_of_sessions,
                'package_id' => $package_id,
                'name' =>  $package->name,
                'city_id' => $city,
                'gym_id' => $gym_id,
                'user_id' => $user_id,

            ]);
            return redirect()->away('https://buy.stripe.com/test_28o9D32OG3z0fT2144');
        }


        
    }
    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        DB::table('stripe')->delete();
        return to_route('buyPackage.index');
    }
}
