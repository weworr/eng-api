<?php

declare(strict_types=1);

namespace App\QueryCommand;

class GetMeasurementsQueryCommand
{
    private ?int $last = null;

    public function getLast(): ?int
    {
        return $this->last;
    }

    public function setLast(?int $last): self
    {
        $this->last = $last;
        return $this;
    }
}
