<?php

namespace App\Services\Weather\Exceptions;

use Throwable;

class FormatterNotFoundException extends \Exception
{
    public function __construct(string $format, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Formatter not found for format "%s"', $format);

        parent::__construct($message, $code, $previous);
    }
}
