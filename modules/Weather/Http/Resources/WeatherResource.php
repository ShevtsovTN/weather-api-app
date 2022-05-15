<?php

namespace Modules\Weather\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'city_name' => $this->city_name,
            'weather_date' => $this->weather_date,
            'data' => $this->data,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
