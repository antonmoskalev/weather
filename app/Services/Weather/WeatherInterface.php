<?php

namespace App\Services\Weather;

interface WeatherInterface
{
    /**
     * Время в UTC
     */
    public function getDateTime(): string;

    /**
     * Температура (°C)
     */
    public function getTemperature(): float;

    /**
     * Направление ветра
     */
    public function getWindDir(): string;

    /**
     * Скорость ветра (в м/с)
     */
    public function getWindSpeed(): float;
}
