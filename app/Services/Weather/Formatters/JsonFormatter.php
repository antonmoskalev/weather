<?php

namespace App\Services\Weather\Formatters;

use App\Services\Weather\FormatterInterface;
use App\Services\Weather\WeatherInterface;

class JsonFormatter implements FormatterInterface
{
    public function supports(string $format): bool
    {
        return $format === 'json';
    }

    public function getContents(WeatherInterface $weather): string
    {
        return json_encode([
            'date_time' => $weather->getDateTime(),
            'temperature' => $weather->getTemperature(),
            'wind_dir' => $weather->getWindDir(),
            'wind_speed' => $weather->getWindSpeed(),
        ]);
    }

    public function getExtension(): string
    {
        return 'json';
    }
}
