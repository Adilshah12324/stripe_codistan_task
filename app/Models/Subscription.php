<?php

namespace App\Models;


use App\Trait\HasManyOrders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    use HasManyOrders;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'duration',

    ];
}
