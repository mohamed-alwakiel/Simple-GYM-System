<?php

namespace App\Models;

use App\Models\User;
use App\Models\Coach;
use App\Models\Attendance;
use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
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
        return $this->hasOne(User::class, 'city_id');
    }

    // as a client
    public function user(){
        return $this->hasMany(CityManager::class, 'city_id');
    }

    public function trainingSessions() {
        return $this->hasManyThrough(TrainingSession::class, Gym::class);
    }

    public function attendances() {
        return $this->hasManyThrough(Attendance::class, User::class);
    }

    public function coaches()
    {
        return $this->hasManyThrough(Coach::class, Gym::class);
    }


}
