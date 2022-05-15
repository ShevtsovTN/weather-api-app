<?php

namespace Modules\Weather\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WeatherCollection extends ResourceCollection
{
    public $collects = WeatherResource::class;
}
