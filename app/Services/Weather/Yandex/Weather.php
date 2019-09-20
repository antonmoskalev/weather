<?php

namespace App\Services\Weather\Yandex;

use App\Services\Weather\WeatherInterface;

class Weather implements WeatherInterface
{
    private $dateTime;

    private $temperature;

    private $windDir;

    private $windSpeed;

    public function __construct(array $data)
    {
        $this->dateTime = $data['now_dt'];
        $this->temperature = $data['fact']['temp'];
        $this->windDir = $data['fact']['wind_dir'];
        $this->windSpeed = $data['fact']['wind_speed'];
    }

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getWindDir(): string
    {
        return $this->windDir;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }
}
