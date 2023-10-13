<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\SubscriptionRepositoryInterface;

class SubscriptionController extends Controller
{
    protected $subscription;
    
    public function __construct()
    {
        $this->subscription = new Subscription;
        
    }
    public function getSubscription($id)
    {
        $data = $this->subscription->whereId($id)->get();

        return view('subscriptions.checkout',compact('data'));
        
    }
}
