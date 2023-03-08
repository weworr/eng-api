<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(repositoryClass: 'Repository\MeasurementRepository')]
class Measurement
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: 'float')]
    private float $temperature;

    #[MongoDB\Field(type: 'float')]
    private float $humidity;

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;
        return $this;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function setHumidity(float $humidity): self
    {
        $this->humidity = $humidity;
        return $this;
    }
}