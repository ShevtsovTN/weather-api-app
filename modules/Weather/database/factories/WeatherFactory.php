<?php

namespace Modules\Weather\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Modules\Weather\Models\Weather;

class WeatherFactory extends Factory
{
    protected $model = Weather::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'city_name' => $this->faker->city,
            'city_id' => rand(1000000, 9999999),
            'weather_date' => Carbon::now()->format('Y-m-d'),
            'data' => json_encode([]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
