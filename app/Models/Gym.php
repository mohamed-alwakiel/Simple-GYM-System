<?php

namespace App\Models;

use App\Models\Coach;
use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gym extends Model
{
    use HasFactory;

    protected$table='gyms';

    protected $fillable = [
        'id',
        'name',
        'cover_img',
        'created_at',
        'updated_at',
        'city_id'
    ];

    // gym under one city
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    // as a manager
    public function manager()
    {
        return $this->hasMany(GymManager::class, 'gym_id');
    }


    // as a client
    public function user()
    {
        return $this->hasMany(User::class, 'gym_id');
    }

    public function TrainingSessions()
    {
        return $this->hasMany(TrainingSession::class,'gym_id');
    }
    public function coaches()
    {
        return $this->hasMany(Coach::class, 'gym_id');
    }
}
