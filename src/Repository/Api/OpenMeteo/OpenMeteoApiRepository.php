<?php

declare(strict_types=1);

namespace App\Repository\Api\OpenMeteo;

use App\Domain\Forecast\ForecastDTO;
use App\Enum\HttpContentType;
use App\Enum\HttpHeader;
use App\Enum\HttpMethod;
use App\Repository\Api\AbstractApiRepository;

final readonly class OpenMeteoApiRepository extends AbstractApiRepository
{
    protected const API_HOST = 'https://api.open-meteo.com';

    private const GET_CURRENT_FORECAST_QUERY_PARAMS = [
        'latitude' => 52.52,
        'longitude' => 13.41,
        'current' => 'temperature_2m,relative_humidity_2m,surface_pressure',
        'timeformat' => 'unixtime'
    ];

    public function getCurrentForecast(): ForecastDTO
    {
        $response = $this->request(
            HttpMethod::GET,
            OpenMeteoUrl::getCurrentForecast(),
            query: self::GET_CURRENT_FORECAST_QUERY_PARAMS
        );

        if (!isset($response->getHeaders()[HttpHeader::CONTENT_TYPE->value][0])) {
            throw new \RuntimeException('No content-type');
        }

        $contentType = $response->getHeaders()[HttpHeader::CONTENT_TYPE->value][0];

        if (!is_string($contentType) || !str_contains($contentType, HttpContentType::APPLICATION_JSON->value)) {
            throw new \RuntimeException();
        }

        $responseBody = json_decode($response->getContent(), true);

        return new ForecastDTO(
            $responseBody['current']['time'],
            $responseBody['current']['temperature_2m'],
            $responseBody['current']['surface_pressure'],
            $responseBody['current']['relative_humidity_2m'],
        );
    }
}