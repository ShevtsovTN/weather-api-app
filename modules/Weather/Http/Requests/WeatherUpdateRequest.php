<?php

namespace Modules\Weather\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'weather_date' => [
                'date_format:Y-m-d'
            ],
            'data' => [
                'array:temp,humidity,pressure,temp_max,temp_min,feels_like',
            ],
            'data.temp' => [
                'numeric',
                'min:-273',
                'max:1000'
            ],
            'data.humidity' => [
                'numeric',
                'min:0',
                'max:100'
            ],
            'data.pressure' => [
                'numeric',
                'min:0',
                'max:2000'
            ],
            'data.temp_max' => [
                'numeric',
                'min:-273',
                'max:1000'
            ],
            'data.temp_min' => [
                'numeric',
                'min:-273',
                'max:1000'
            ],
            'data.feels_like' => [
                'numeric',
                'min:-273',
                'max:1000'
            ],
        ];
    }
}
