<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable =[

        'user_id',
        'training_session_id',
        'attendance_date',
        'attendance_time'
    ];

    
}
