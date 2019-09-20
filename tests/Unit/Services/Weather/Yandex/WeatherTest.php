<?php

namespace Tests\Unit\Services\Weather\Yandex;

use App\Services\Weather\Yandex\Weather;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    public function testConstructor()
    {
        $weather = new Weather([
            'now_dt' => '2019-09-20T13:22:06.346Z',
            'fact' => [
                'temp' => 14,
                'wind_dir' => 'e',
                'wind_speed' => 1,
            ],
        ]);

        $this->assertEquals('2019-09-20T13:22:06.346Z', $weather->getDateTime());
        $this->assertIsFloat($weather->getTemperature());
        $this->assertEquals(14.0, $weather->getTemperature());
        $this->assertEquals('e', $weather->getWindDir());
        $this->assertEquals(1.0, $weather->getWindSpeed());
    }
}
