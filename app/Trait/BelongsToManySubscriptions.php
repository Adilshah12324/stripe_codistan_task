<?php
namespace App\Trait;

use App\Models\Subscription;

trait BelongsToManySubscriptions{

    public function subscriptions()
    {
        return $this->BelongsToMany(Subscription::class);
    }
}
?>