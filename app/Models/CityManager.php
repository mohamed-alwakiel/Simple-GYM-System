<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CityManager extends Model
{
    use HasFactory, HasRoles;

    public $table = 'users';
    protected $guard_name ='web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'profile_img',
        'role_id',
        'role_type',
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
