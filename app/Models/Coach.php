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

    public function trainingSession()
    {
        return $this->belongsToMany(TrainingSession::class, 'coaches_sessions');
    }
}
