<?php

namespace App\Models;

use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'cover_img',
        'created_at',
        'updated_at',
        'city_id'
    ];
    protected$table='gyms';

    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function TrainingSessions(){
        return $this->hasMany(TrainingSession::class,'gym_id');
    }
}
