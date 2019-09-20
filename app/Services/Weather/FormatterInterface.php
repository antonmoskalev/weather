<?php

namespace App\Services\Weather;

interface FormatterInterface
{
    public function supports(string $format): bool;

    public function getContents(WeatherInterface $weather): string;

    public function getExtension(): string;
}
