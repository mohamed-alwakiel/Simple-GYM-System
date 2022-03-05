<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingSession extends Model
{
    use HasFactory;
    protected $fillable =[

        'id',
        'name',
        'day',
        'started_at',
        'finished_at',
        'gym_id'
    ];

    public function gym(){

        return $this->belongsTo(Gym::class);
    }
    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'coach_sessions','training_session_id','coach_id');
    }


}
