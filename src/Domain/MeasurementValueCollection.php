<?php

declare(strict_types=1);

namespace App\Domain;

class MeasurementValueCollection
{
    /**
     * @var MeasurementValue[]
     */
    private array $measurements = [];

    public function getMeasurements(): array
    {
        return $this->measurements;
    }

    public function addToCollection(MeasurementValue $measurement): self
    {
        $this->measurements[] = $measurement;

        return $this;
    }
}
