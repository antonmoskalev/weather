<?php

namespace App\Providers;

use App\Services\Weather\FormatterFactory;
use App\Services\Weather\Formatters\JsonFormatter;
use App\Services\Weather\Formatters\XmlFormatter;
use App\Services\Weather\RepositoryInterface;
use App\Services\Weather\Yandex;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Yandex\Repository::class);

        $this->app->singleton(Yandex\Api::class, function () {
            return new Yandex\Api(env('YANDEX_WEATHER_TOKEN'));
        });

        $this->app->singleton(FormatterFactory::class, function (Application $app) {
            return new FormatterFactory(...[
                $app->make(JsonFormatter::class),
                $app->make(XmlFormatter::class),
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
