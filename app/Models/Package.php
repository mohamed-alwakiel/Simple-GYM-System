<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public $table = 'training_packages';

    protected $fillable = [
        'id',
        'name',
        'price',
        'number_of_sessions'

    ];
}
