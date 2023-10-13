<?php

namespace App\View\Components;

use App\Models\Subscription;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $subscriptions = Subscription::all();
        return view('layouts.app',compact('subscriptions'));
    }
}
