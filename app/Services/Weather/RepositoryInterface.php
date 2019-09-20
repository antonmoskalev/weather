<?php

namespace App\Services\Weather;

use App\Services\Weather\Exceptions\RepositoryErrorException;

interface RepositoryInterface
{
    /**
     * @throws RepositoryErrorException
     */
    public function getCurrentWeather(float $latitude, float $longitude): WeatherInterface;
}
