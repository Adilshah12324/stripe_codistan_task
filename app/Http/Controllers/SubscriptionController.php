<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $subscription;
    protected $order;

    public function __construct()
    {
        $this->subscription = new Subscription;
        $this->order = new Order();

    }
    public function checkout(Request $request,$id)
    {
        $subscriptions = $this->subscription->whereId($id)->get();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $lineItems = [];
        foreach ($subscriptions as $subscription){
            $lineItems[] = [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $subscription->name,
                        ],
                        'unit_amount' => ($request->duration == 'annually') ? $subscription->price*12 : $subscription->price,
                    ],
                    'quantity' => 1,
                ]
            ];
        }
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success',[],true),
            'cancel_url' => route('checkout.cancel',[],true),
        ]);

        $this->order->user_id = \auth()->user()->id;
        $this->order->subscription_id = $id;
        $this->order->session_id = $checkout_session->id;
        $this->order->duration = $request->duration;
        $this->order->status = 'paid';
        $this->order->save();

        return redirect($checkout_session->url);
    }
    public function success(){

        dd('the payment in done successfully');
    }

    public function cancel(){

        dd('the payment in cancelled');
    }
}
