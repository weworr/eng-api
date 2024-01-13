<?php

declare(strict_types=1);

namespace App\Repository\Api\OpenMeteo;

final readonly class OpenMeteoUrl
{
    public static function getCurrentForecast(): string
    {
        return '/v1/forecast';
    }
}