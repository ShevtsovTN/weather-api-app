<?php

namespace Modules\Weather\ApiModels;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Modules\Weather\Contracts\WeatherApiContract;
use Modules\Weather\Dto\WeatherDto;
use Psr\Http\Message\ResponseInterface;

class OpenWeather implements WeatherApiContract
{
    private string $api_key;
    private string $api_url;

    public function __construct()
    {
        $this->api_key = config('weathers.open_weather.api_key');
        $this->api_url = config('weathers.open_weather.api_url');
    }

    public function getCurrentWeather(array $data): WeatherDto
    {
        $url = $this->api_url;
        $response = $this->send($data, $url);
        return WeatherDto::fromResponse($response);
    }

    /**
     * @throws GuzzleException
     */
    public function send(array $data, string $url): ResponseInterface
    {
        $client = new Client();
        $data = array_merge($data, [
            'appid' => $this->api_key
        ]);
        return $client->get($url, [
            'query'  => $data,
            'headers' => [
                'Content-Type', 'application/x-www-form-urlencoded',
            ],
            'verify'  =>  false,
            'connect_timeout'  =>  5
        ]);
    }
}
