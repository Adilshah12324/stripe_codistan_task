<?php
namespace App\Trait;

use App\Models\Subscription;

trait BelongsToSubscriptions{

    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class);
    }
}
?>
