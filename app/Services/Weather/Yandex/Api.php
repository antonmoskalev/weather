<?php

namespace App\Services\Weather\Yandex;

use App\Services\Weather\Yandex\Exceptions\ApiErrorException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class Api
{
    private $httpClient;

    public function __construct(string $token)
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.weather.yandex.ru/v1/',
            'headers' => [
                'X-Yandex-API-Key' => $token,
            ],
        ]);
    }

    /**
     * @throws ApiErrorException
     */
    public function getForecast(float $latitude, float $longitude): array
    {
        $response = $this->request('GET', 'forecast', [
            'query' => [
                'lat' => $latitude,
                'lon' => $longitude,
                'lang' => 'ru_RU',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws ApiErrorException
     */
    private function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->httpClient->request($method, $uri, $options);
        } catch (ClientException $e) {
            throw new ApiErrorException($e->getMessage(), $e->getCode());
        }
    }
}
