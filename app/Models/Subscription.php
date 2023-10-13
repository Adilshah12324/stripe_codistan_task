<?php

namespace App\Models;

use App\Trait\BelongsToManyUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;
    use BelongsToManyUsers;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'duration',

    ];
}
