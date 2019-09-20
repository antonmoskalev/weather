<?php

namespace App\Console\Commands\Weather;

use App\Services\Weather\Exceptions\FormatterNotFoundException;
use App\Services\Weather\Exceptions\RepositoryErrorException;
use App\Services\Weather\FormatterFactory;
use App\Services\Weather\RepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;

class Import extends Command
{
    protected $signature = 'weather:import {latitude} {longitude} {--format=json : json or xml}';

    protected $description = 'Weather import';

    private $repository;

    private $formatterFactory;

    private $filesystem;

    public function __construct(
        RepositoryInterface $repository,
        FormatterFactory $formatterFactory,
        Filesystem $filesystem
    ) {
        $this->repository = $repository;
        $this->formatterFactory = $formatterFactory;
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    public function handle()
    {
        $this->line($this->description);

        try {
            $format = strtolower($this->option('format'));
            $formatter = $this->formatterFactory->get($format);
        } catch (FormatterNotFoundException $e) {
            $this->error('--format must be json or xml');

            return;
        }

        $latitude = (float)$this->argument('latitude');
        $longitude = (float)$this->argument('longitude');

        try {
            $weather = $this->repository->getCurrentWeather($latitude, $longitude);
        } catch (RepositoryErrorException $e) {
            $this->error($e->getMessage());

            return;
        }

        $path = sprintf('%s_%s_%s.%s', $latitude, $longitude, date('Y_m_d'), $formatter->getExtension());
        $contents = $formatter->getContents($weather);

        $this->filesystem->put($path, $contents);

        $this->info($path);
        $this->info('Successful');
    }
}
