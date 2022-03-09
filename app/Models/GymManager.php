<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Cog\Laravel\Ban\Traits\Bannable;
use Cog\Contracts\Ban\Bannable as BannableContract;

// class GymManager extends Model
class GymManager extends model implements BannableContract
{
    use HasFactory, HasRoles, Bannable;

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
        'gym_id',
        'city_id',
        'email_verified_at'
    ];

    // one gym for a single manager
    public function gym()
    {
        return $this->belongsTo(Gym::class, 'id');
    }

    //
    public function city()
    {
        return $this->belongsTo(City::class, 'id');
    }

}
