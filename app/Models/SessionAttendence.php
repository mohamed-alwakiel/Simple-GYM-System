<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAttendence extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'user_id',
        'attendance_time',
        'attendance_date'
    ];

    protected $table = 'attendance';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\TrainingSession', 'session_id');
    }
}
