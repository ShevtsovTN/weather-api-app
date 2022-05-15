<?php

namespace Modules\Weather\Services;

use App\Models\City;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Weather\Dto\WeatherDto;
use Modules\Weather\Exceptions\WeatherModuleException;
use Modules\Weather\Models\Weather;
use Throwable;

class WeatherService
{
    private WeatherApiService $weatherApiService;

    public function __construct(WeatherApiService $weatherApiService)
    {
        $this->weatherApiService = $weatherApiService;
    }

    /**
     * @throws Throwable
     */
    public function show(array $data): Collection
    {
        if (Weather::where('weather_date', $data['weather_date'])->exists()) {
            return Weather::where('weather_date', $data['weather_date'])->orderBy('weather_date')->get();
        }
        if ($data['weather_date'] == Carbon::now()->format('Y-m-d')) {
            return $this->pull();
        }
        throw new WeatherModuleException('No data found for this date.', 404);
    }

    /**
     * @throws Throwable
     */
    public function pull(): Collection
    {
        $cities = City::all();
        $weathersDto = [];
        foreach ($cities as $city) {
            $weathersDto[] = $this->weatherApiService->getWeatherFromApi($city->city_name, save: true);
        }
        return collect($weathersDto);
    }

    /**
     * @param Weather $weather
     * @param WeatherDto $weatherDto
     * @return Weather
     * @throws Throwable
     */
    public function update(Weather $weather, WeatherDto $weatherDto): Weather
    {
        DB::beginTransaction();
        try {
            if ($weatherDto->weather_date) {
                $weather->updateOrFail([
                    'weather_date' => $weatherDto->weather_date,
                ]);
            }
            if ($weatherDto->data) {
                $arr = $weather->data;
                $dtoArr = $weatherDto->data;
                array_walk($arr, function (&$value, $key) use ($dtoArr) {
                    $value = isset($dtoArr[$key])
                        ? (float)$dtoArr[$key]
                        : $value;
                });
                $weather->data = $arr;
                $weather->save();
            }
            DB::commit();
            return $weather;
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param Weather $weather
     * @return Weather
     */
    public function destroy(Weather $weather): Weather
    {
        DB::beginTransaction();
        try {
            $weather->delete();
            DB::commit();
            return $weather;
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param WeatherDto $weatherDto
     * @return int
     * @throws Throwable
     */
    public static function save(WeatherDto $weatherDto): int
    {
        DB::beginTransaction();
        try {
            $weather = Weather::updateOrCreate([
                'city_name' => $weatherDto->city_name,
                'weather_date' => $weatherDto->weather_date,
            ],
                [
                    'city_id' => $weatherDto->city_id,
                    'data' => $weatherDto->data
                ]);

            DB::commit();

            return $weather->id;
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
