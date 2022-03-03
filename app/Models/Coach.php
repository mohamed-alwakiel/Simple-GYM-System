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

    ];

    public function trainingSessions()
    {
        return $this->belongsToMany(TrainingSession::class, 'coach_sessions','coach_id','training_session_id');
    }
}
