<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public $table = 'test';

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

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function package()
    // {
    //     return $this->belongsTo(Package::class);
    // }
    
    // public function gym()
    // {
    //     return $this->belongsTo(Gym::class);
    // }
    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }
    
}
