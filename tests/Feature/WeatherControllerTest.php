<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Mockery\MockInterface;
use Modules\Weather\Models\Weather;
use Modules\Weather\Services\WeatherApiService;
use Tests\TestCase;

class WeatherControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_success()
    {
        if (Weather::where('weather_date', Carbon::now()->format('Y-m-d'))->doesntExist()) {
            $spy = $this->spy(WeatherApiService::class);

            $responseSuccess = $this->get(route('weather.show', [
                'weather_date' => Carbon::now()->format('Y-m-d')
            ]));
            $responseSuccess->assertStatus(200);
            $spy->shouldHaveReceived('getWeatherFromApi');
        }

        if (Weather::where('weather_date', Carbon::now()->subDay()->format('Y-m-d'))->exists()) {
            $responseSuccess = $this->get(route('weather.show', [
                'weather_date' => Carbon::now()->subDay()->format('Y-m-d')
            ]));
            $responseSuccess->assertStatus(200);
        }
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_failure()
    {
        $responseFail = $this->get(route('weather.show', [
            'weather_date' => Carbon::now()->addDay()->format('Y-m-d')
        ]));
        $responseFail->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_pull()
    {
        $weatherApiServiceMock = $this->mock(WeatherApiService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getWeatherFromApi');
        });
        $response = $this->post(route('weather.pull'));
        $weatherApiServiceMock->shouldHaveReceived('getWeatherFromApi');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update()
    {
        $weather = Weather::first();
        $data = [
            'weather_date' => '2022-05-14',
            'data' => [
                'temp' => 14
            ]
        ];
        $response = $this->put(route('weather.update', [
            'weather' => $weather->id
        ]), $data);
        $model = Weather::find($weather->id);
        $this->assertEquals($model->data['temp'], $data['data']['temp']);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_destroy()
    {
        $weather = Weather::first();
        $response = $this->delete(route('weather.destroy', [
            'weather' => $weather->id
        ]));
        $this->assertModelMissing($weather);
        $response->assertStatus(200);
    }
}
