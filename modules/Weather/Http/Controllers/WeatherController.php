<?php

namespace Modules\Weather\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Weather\Dto\WeatherDto;
use Modules\Weather\Http\Requests\WeatherPullRequest;
use Modules\Weather\Http\Requests\WeatherShowRequest;
use Modules\Weather\Http\Requests\WeatherUpdateRequest;
use Modules\Weather\Http\Resources\WeatherCollection;
use Modules\Weather\Http\Resources\WeatherResource;
use Modules\Weather\Models\Weather;
use Modules\Weather\Services\WeatherApiService;
use Modules\Weather\Services\WeatherService;
use Throwable;

class WeatherController extends Controller
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @throws Throwable
     */
    public function show(WeatherShowRequest $weatherShowRequest): WeatherCollection
    {
        return WeatherCollection::make(
            $this->weatherService->show($weatherShowRequest->validated())
        );
    }

    /**
     * @throws Throwable
     */
    public function pull(): WeatherCollection
    {
        return WeatherCollection::make(
            $this->weatherService->pull()
        );
    }

    public function update(Weather $weather, WeatherUpdateRequest $weatherUpdateRequest): WeatherResource
    {
        return WeatherResource::make($this->weatherService->update(
            $weather,
            WeatherDto::fromRequest($weatherUpdateRequest->validated())
        ));
    }

    /**
     * @throws Throwable
     */
    public function destroy(Weather $weather): WeatherResource
    {
        return WeatherResource::make($this->weatherService->destroy($weather));
    }
}
