<?php

namespace Modules\Weather\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeatherShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'weather_date' => [
                'required',
                'date_format:Y-m-d'
            ]
        ];
    }
}
