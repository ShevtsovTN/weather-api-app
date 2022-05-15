<?php

namespace Modules\Weather\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Modules\Weather\Models\Weather;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $cities = [
            'New York' => 5128581,
            'London' => 2643743,
            'Paris' => 2988507,
            'Berlin' => 2950159,
            'Tokyo' => 1850144
        ];
        $data = [
            'temp' => 296.39,
            'humidity' => 40,
            'pressure' => 1019,
            'temp_max' => 298.35,
            'temp_min' => 295.03,
            'feels_like' => 295.81
        ];
        foreach ($cities as $name => $id) {
            Weather::factory()->create([
                'city_name' => $name,
                'city_id' => $id,
                'weather_date' => Carbon::now()->subDay()->format('Y-m-d'),
                'data' => $data,
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay()
            ]);
        }
    }
}
