<?php

declare(strict_types=1);

namespace App\QueryCommand;

use App\Enum\MeasurementType;

class GetMeasurementsQueryCommand
{
    private int|null $last = null;

    private MeasurementType|null $measurementType = null;

    private int|null $from = null;

    public function getLast(): ?int
    {
        return $this->last;
    }

    public function setLast(int|null $last): self
    {
        $this->last = $last;
        return $this;
    }

    public function getMeasurementType(): MeasurementType|null
    {
        return $this->measurementType;
    }

    public function setMeasurementType(MeasurementType|null $measurementType): self
    {
        $this->measurementType = $measurementType;
        return $this;
    }

    public function getFrom(): int|null
    {
        return $this->from;
    }

    public function setFrom(int|null $from): self
    {
        $this->from = $from;
        return $this;
    }
}
