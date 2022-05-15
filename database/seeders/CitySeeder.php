<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $cities = [
            'New York',
            'London',
            'Paris',
            'Berlin',
            'Tokyo'
        ];
        foreach ($cities as $city) {
            City::factory()->create([
                'city_name' => $city
            ]);
        }
    }
}
