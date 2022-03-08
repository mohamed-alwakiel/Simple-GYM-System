<?php

namespace App\Models;

use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function trainingSessions() {

        return $this->hasManyThrough(TrainingSession::class, Gym::class);
    }


}
