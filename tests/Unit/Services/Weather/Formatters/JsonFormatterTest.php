<?php

namespace Tests\Unit\Services\Weather\Formatters;

use App\Services\Weather\Formatters\JsonFormatter;
use App\Services\Weather\Yandex\Weather;
use Tests\TestCase;

class JsonFormatterTest extends TestCase
{
    public function testSupports()
    {
        $jsonFormatter = $this->app->get(JsonFormatter::class);

        $this->assertTrue($jsonFormatter->supports('json'));
        $this->assertFalse($jsonFormatter->supports('xml'));
    }

    public function testGetContents()
    {
        $weather = $this->getMockBuilder(Weather::class)->disableOriginalConstructor()->getMock();
        $weather->method('getDateTime')->will($this->returnValue('2019-09-20T13:22:06.346Z'));
        $weather->method('getTemperature')->will($this->returnValue(14.0));
        $weather->method('getWindDir')->will($this->returnValue('e'));
        $weather->method('getWindSpeed')->will($this->returnValue(1.0));

        $jsonFormatter = $this->app->get(JsonFormatter::class);

        $this->assertEquals(
            '{"date_time":"2019-09-20T13:22:06.346Z","temperature":14,"wind_dir":"e","wind_speed":1}',
            $jsonFormatter->getContents($weather)
        );
    }

    public function testGetExtension()
    {
        $jsonFormatter = $this->app->get(JsonFormatter::class);

        $this->assertEquals('json', $jsonFormatter->getExtension());
    }
}
