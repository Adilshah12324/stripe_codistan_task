<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\CardException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\InvalidRequestException;

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
        DB::beginTransaction();
        try{
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

            DB::commit();
            return redirect($checkout_session->url);

        } catch (CardException | InvalidRequestException | AuthenticationException | ApiConnectionException | ApiErrorException $e) {
            
            return redirect()->back()->with('error', $e->getMessage());

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Error occurred. Please try again later.');
        }
    }

    public function success(){

        return view('subscriptions.success');
    }

    public function cancel(){

        return view('subscriptions.success');
    }
}
