<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Weather\database\seeders\WeatherSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            WeatherSeeder::class,
            CitySeeder::class,
        ]);
    }
}
