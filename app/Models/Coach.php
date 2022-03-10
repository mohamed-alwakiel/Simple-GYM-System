<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    protected $fillable =[

        'id',
        'name',
        'gym_id'

    ];

    public function trainingSessions()
    {
        return $this->belongsToMany(TrainingSession::class, 'coach_sessions','coach_id','training_session_id');
    }
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
