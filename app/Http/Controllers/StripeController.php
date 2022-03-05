<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Stripe;
use Session;
use Stripe\Checkout\Session as CheckoutSession;

class StripeController extends Controller
{
/**
     * payment view
     */
    public function handleGet()
    {
        return view('payment.home');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        $YOUR_DOMAIN = 'http://127.0.0.1:8001/stripe-payment';
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment." ,
                
    

            // 'line_items' => [[
            //     'price_data' => [
            //         "amount" => 100 * 150,
            //         "currency" => "inr",
                  
            //         "description" => "Making test payment." ,
            //       ],
            //       'quantity' => 1,
                 
            //     ]],
            //     "source" => $request->stripeToken,
            // 'mode' => 'payment',
            // 'success_url' => $YOUR_DOMAIN . '/success',
            // 'cancel_url' => $YOUR_DOMAIN . '/cancel',
        ]);
  
      
    }


    public function success()
    {
        // return to_route('buyPackage.store');
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}
