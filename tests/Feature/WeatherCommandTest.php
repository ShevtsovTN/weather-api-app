<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Mockery\MockInterface;
use Modules\Weather\Events\WeatherPullEvent;
use Modules\Weather\Jobs\GetWeatherJob;
use Modules\Weather\Services\WeatherApiService;
use Modules\Weather\Services\WeatherService;
use Tests\TestCase;

class WeatherCommandTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_job_create()
    {
        Bus::fake();
        $this->artisan('weather:get-current-weather')->assertExitCode(0);
        Bus::assertDispatched(GetWeatherJob::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_event_create()
    {
        Event::fake([
            WeatherPullEvent::class,
        ]);

        $weatherApiServiceMock = $this->partialMock(WeatherApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getWeatherFromApi');
        });

        $weatherServiceMock = $this->partialMock(WeatherService::class, function (MockInterface $mock) {
            $mock->shouldReceive('save');
        });

        $this->artisan('weather:get-current-weather')->assertExitCode(0);
        $weatherApiServiceMock->shouldHaveReceived('getWeatherFromApi');
        $weatherServiceMock->shouldHaveReceived('save');
        Event::assertDispatched(WeatherPullEvent::class);
    }
}
