<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityManager extends Model
{
    use HasFactory;

    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'profile_img',
        'role_id',
        'role_type'
    ];
}
