<?php

namespace App\Models;

use App\Models\User;
use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable =[

        'user_id',
        'training_session_id',
        'attendance_date',
        'attendance_time'
    ];

    public function trainingSessions(){

        return $this->belongsTo(TrainingSession::class,'training_session_id');
    }
    public function users(){

        return $this->belongsTo(User::class,'user_id');
    }
}
