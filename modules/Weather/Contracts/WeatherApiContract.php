<?php

namespace Modules\Weather\Contracts;

use Modules\Weather\Dto\WeatherDto;
use Psr\Http\Message\ResponseInterface;

interface WeatherApiContract
{
    public function getCurrentWeather(array $data): WeatherDto;

    public function send(array $data, string $url): ResponseInterface;
}
