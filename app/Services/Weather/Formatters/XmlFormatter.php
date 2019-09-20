<?php

namespace App\Services\Weather\Formatters;

use App\Services\Weather\FormatterInterface;
use App\Services\Weather\WeatherInterface;
use Spatie\ArrayToXml\ArrayToXml;

class XmlFormatter implements FormatterInterface
{
    public function supports(string $format): bool
    {
        return $format === 'xml';
    }

    public function getContents(WeatherInterface $weather): string
    {
        $arrayToXml = new ArrayToXml([
            'date_time' => $weather->getDateTime(),
            'wind_speed' => $weather->getWindSpeed(),
            'temperature' => $weather->getTemperature(),
            'wind_dir' => $weather->getWindDir(),
        ]);

        return $arrayToXml->toXml();
    }

    public function getExtension(): string
    {
        return 'xml';
    }
}
