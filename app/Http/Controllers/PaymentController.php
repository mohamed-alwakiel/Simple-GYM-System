<?php

namespace App\Http\Controllers;

use App\Models\BuyPackage;
use App\Models\Gym;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function stripe()
    {

        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://127.0.0.1:8000/buyPackage/create';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                      'name' => 'package',
                    ],
                    'unit_amount' => 2000,
                  ],
                  'quantity' => 1,
                ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success',
            'cancel_url' => $YOUR_DOMAIN . '/cancel',
        ]);

        header("HTTP/1.1 303 See Other");
        return redirect($checkout_session->url); 
    }

    public function success()
    {
 
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
