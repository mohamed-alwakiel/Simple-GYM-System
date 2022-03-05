<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPackage extends Model
{
    use HasFactory;

    public $table = 'bought_packages';

    protected $fillable = [
        'id',
        'name',
        'price',
        'number_of_sessions',
        'remaining_sessions',
        'package_id',
        'user_id',
        'gym_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
