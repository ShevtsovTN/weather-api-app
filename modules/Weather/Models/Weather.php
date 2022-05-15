<?php

namespace Modules\Weather\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Weather\database\factories\WeatherFactory;

class Weather extends Model
{
    use HasFactory;

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

    protected static function newFactory(): WeatherFactory
    {
        return WeatherFactory::new();
    }
}
