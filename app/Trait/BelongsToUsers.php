<?php
namespace App\Trait;

use App\Models\User;

trait BelongsToUsers{

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
?>
