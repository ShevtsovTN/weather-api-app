<?php

namespace Modules\Weather\Jobs;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Weather\Events\WeatherPullEvent;
use Modules\Weather\Services\WeatherApiService;
use Modules\Weather\Services\WeatherService;
use Throwable;

class GetWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private WeatherApiService $weatherApiService;
    private WeatherService $weatherService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param WeatherApiService $weatherApiService
     * @return void
     * @throws Throwable
     */
    public function handle(WeatherApiService $weatherApiService, WeatherService $weatherService): void
    {
        $cities = City::all();
        foreach ($cities as $city) {
            $weatherDto = $weatherApiService->getWeatherFromApi($city->city_name);
            $weatherService::save($weatherDto);
        }
        event(new WeatherPullEvent());
    }
}
