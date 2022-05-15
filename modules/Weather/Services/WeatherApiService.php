<?php

namespace Modules\Weather\Services;

use Illuminate\Support\Str;
use Modules\Weather\Dto\WeatherDto;
use Throwable;

class WeatherApiService
{
    /**
     * @throws Throwable
     */
    public function getWeatherFromApi(string $city_name, $save = false): WeatherDto
    {
        $apiModel = Str::studly(config('weathers.default'));
        $dto = (new ('Modules\Weather\ApiModels\\' . $apiModel))->getCurrentWeather([
            'q' => $city_name,
        ]);

        if ($save) {
            $dto->id = WeatherService::save($dto);
        }

        return $dto;
    }
}
