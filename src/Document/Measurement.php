<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(repositoryClass: 'Repository\MeasurementRepository')]
class Measurement
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: 'int')]
    private int $timestamp;

    #[MongoDB\Field(type: 'float')]
    private float $temperature;

    #[MongoDB\Field(type: 'float')]
    private float $humidity;

    #[MongoDB\Field(type: 'float')]
    private float $pressure;

    #[MongoDB\Field(type: 'float')]
    private float $voc;

    public function __construct()
    {
        $this->timestamp = (new \DateTime)->getTimestamp();
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;
        return $this;
    }

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

    public function getPressure(): float
    {
        return $this->pressure;
    }

    public function setPressure(float $pressure): self
    {
        $this->pressure = $pressure;
        return $this;
    }

    public function getVoc(): float
    {
        return $this->voc;
    }

    public function setVoc(float $voc): self
    {
        $this->voc = $voc;
        return $this;
    }
}