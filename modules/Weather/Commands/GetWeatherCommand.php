<?php

namespace Modules\Weather\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Modules\Weather\Jobs\GetWeatherJob;
use Modules\Weather\Services\WeatherApiService;
use Modules\Weather\Services\WeatherService;
use Throwable;

class GetWeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-current-weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get actual weather data';

    /**
     * @throws Throwable
     */
    public function handle(WeatherApiService $weatherApiService)
    {
        GetWeatherJob::dispatch($weatherApiService);
    }
}
