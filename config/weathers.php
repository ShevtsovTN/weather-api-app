<?php

return [
    'default' => 'open_weather',
    'open_weather' => [
        'api_key' => env('WEATHER_API_KEY'),
        'api_url' => 'https://api.openweathermap.org/data/2.5/weather'
    ]
];
