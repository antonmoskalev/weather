<?php

namespace Tests\Unit;

use App\Services\Weather\Exceptions\FormatterNotFoundException;
use App\Services\Weather\FormatterFactory;
use App\Services\Weather\FormatterInterface;
use Tests\TestCase;

class FormatterFactoryTest extends TestCase
{
    public function testSuccessfulGet(): void
    {
        $formatterFactory = $this->app->get(FormatterFactory::class);
        $jsonFormatter = $formatterFactory->get('json');
        $xmlFormatter = $formatterFactory->get('xml');

        $this->assertInstanceOf(FormatterInterface::class, $jsonFormatter);
        $this->assertInstanceOf(FormatterInterface::class, $xmlFormatter);
    }

    public function testFailedGet(): void
    {
        $formatterFactory = $this->app->get(FormatterFactory::class);

        $this->expectException(FormatterNotFoundException::class);
        $formatterFactory->get('yaml');
    }
}
