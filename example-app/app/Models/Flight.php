<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $table = 'flights';
    protected $primaryKey = 'flight_id';
    protected $connection = 'sqlite';

    # default attribute values
    protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
}
