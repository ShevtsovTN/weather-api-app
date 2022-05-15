<?php

namespace Modules\Weather\Dto;

use Illuminate\Support\Carbon;
use Psr\Http\Message\ResponseInterface;

class WeatherDto
{
    public ?int $id = null;
    public ?int $city_id = null;
    public ?string $city_name = null;
    public ?string $weather_date = null;
    public ?array $data = null;
    public ?Carbon $created_at = null;
    public ?Carbon $updated_at = null;

    public function __construct(array $data = null)
    {
        $this->id = isset($data['id']) ? (int)$data['id'] : $this->id;
        $this->city_name = isset($data['city_name']) ? (string)$data['city_name'] : $this->city_name;
        $this->weather_date = isset($data['weather_date'])
            ? Carbon::make($data['weather_date'])->format('Y-m-d')
            : $this->weather_date;
        $this->city_id = isset($data['city_id']) ? (int)$data['city_id'] : $this->city_id;
        $this->data = $data['data']?? $this->data;
        $this->created_at = isset($data['created_at'])
            ? Carbon::make($data['created_at'])
            : $this->created_at;
        $this->updated_at = isset($data['updated_at'])
            ? Carbon::make($data['updated_at'])
            : $this->updated_at;
    }

    public static function fromRequest(array $data): WeatherDto
    {
        $dto = new self();
        $dto->city_name = isset($data['city_name']) ? (string)$data['city_name'] : $dto->city_name;
        $dto->weather_date = isset($data['weather_date'])
            ? Carbon::make($data['weather_date'])->format('Y-m-d')
            : $dto->weather_date;
        $dto->data = $data['data']?? $dto->data;
        return $dto;
    }

    public static function fromResponse(ResponseInterface $response): WeatherDto
    {
        $data = json_decode($response->getBody()->getContents(), true);
        $dto = new self();
        $dto->city_name = (string)$data['name'];
        $dto->city_id = (int)$data['id'];
        $dto->weather_date = Carbon::createFromTimestamp($data['dt'])->format('Y-m-d');
        $dto->data = $data['main'];
        return $dto;
    }
}
