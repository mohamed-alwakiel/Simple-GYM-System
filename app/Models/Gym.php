<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_img',
        'created_at',
        'updated_at',
        'city_id'
    ];
    protected$table='gyms';

    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
