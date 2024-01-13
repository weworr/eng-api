<?php

declare(strict_types=1);

namespace App\Domain\Forecast;

final readonly class ForecastDTO
{
    public function __construct(
        private int $timestamp,
        private float $temperature,
        private float $pressure,
        private float $humidity
    ) {
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getPressure(): float
    {
        return $this->pressure;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}