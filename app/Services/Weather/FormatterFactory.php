<?php

namespace App\Services\Weather;

use App\Services\Weather\Exceptions\FormatterNotFoundException;

class FormatterFactory
{
    private $formatters;

    public function __construct(FormatterInterface ...$formatters)
    {
        $this->formatters = $formatters;
    }

    public function get(string $format): FormatterInterface
    {
        foreach ($this->formatters as $formatter) {
            if ($formatter->supports($format)) {
                return $formatter;
            }
        }

        throw new FormatterNotFoundException($format);
    }
}
