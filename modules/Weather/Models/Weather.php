<?php

namespace Modules\Weather\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $casts = [
        'data' => 'json'
    ];

    protected $fillable = [
        'city_id',
        'city_name',
        'weather_date',
        'data'
    ];

    protected $table = 'weathers';
}
