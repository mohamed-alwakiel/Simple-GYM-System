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


    public function gyms() {
        return $this->hasMany(Gym::class, 'city_id', 'id');
    }

    // as a manager
    public function manager(){
        return $this->hasOne(CityManager::class,);
    }

    // as a client
    public function user(){
        return $this->hasMany(CityManager::class, 'city_id');
    }

}
