<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;
    protected $fillable = [
        'number_of_sessions',
        'remaining_sessions',
    ];

    protected $table = 'bought_packages';
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne('App\User', 'role');
    }
}



