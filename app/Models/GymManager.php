<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymManager extends Model
{
    use HasFactory;

    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'profile_img',
        'role_id',
        'role_type',
        'gym_id',
        'city_id'
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }


    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }

}
