<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    use HasFactory;

    public $table = 'stripe';

    protected $fillable = [
        'id',
        'name',
        'price',
        'number_of_sessions',
        'package_id',
        'user_id',
        'gym_id',
        'city_id',
    ];

    
}
