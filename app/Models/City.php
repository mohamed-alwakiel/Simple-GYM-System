<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    // on city have more than one gym
    public function gyms() {
        return $this->hasMany(Gym::class, 'city_id');
    }

    // as a manager
    public function manager(){
        return $this->hasOne(CityManager::class, 'city_id');
    }

    // as a client
    public function user(){
        return $this->hasMany(CityManager::class, 'city_id');
    }

}
