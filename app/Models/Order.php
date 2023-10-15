<?php

namespace App\Models;

use App\Trait\BelongsToSubscriptions;
use App\Trait\BelongsToUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use BelongsToUsers;
    use BelongsToSubscriptions;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'duration',
        'session_id',
    ];
}
