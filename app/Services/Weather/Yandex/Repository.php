<?php

namespace App\Services\Weather\Yandex;

use App\Services\Weather\Exceptions\RepositoryErrorException;
use App\Services\Weather\RepositoryInterface;
use App\Services\Weather\WeatherInterface;
use App\Services\Weather\Yandex\Exceptions\ApiErrorException;

class Repository implements RepositoryInterface
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @throws RepositoryErrorException
     */
    public function getCurrentWeather(float $latitude, float $longitude): WeatherInterface
    {
        try {
            $data = $this->api->getForecast($latitude, $longitude);
        } catch (ApiErrorException $e) {
            throw new RepositoryErrorException(
                sprintf('Yandex weather API error: "%s"', $e->getMessage()),
                $e->getCode()
            );
        }

        return new Weather($data);
    }
}
