<?php

namespace App\Models;

use App\Models\TrainingSession;
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
    public function coach()
    {
        return $this->belongsToMany(Coach::class, 'coaches_sessions');
    }


}
