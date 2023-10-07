<?php

declare(strict_types=1);

namespace App\Domain;

readonly class MeasurementValue
{
    public function __construct(
        private int $timestamp,
        private float $value
    )
    {
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
