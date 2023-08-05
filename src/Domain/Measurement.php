<?php

declare(strict_types=1);

namespace App\Domain;

class Measurement
{
    private float $timestamp;

    private float $temperature;

    private float $humidity;

    private float $pressure;

    private float $voc;

    public function __construct(float $timestamp, float $temperature, float $humidity, float $pressure, float $voc)
    {
        $this->timestamp = $timestamp;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->voc = $voc;
    }

    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    public function setTimestamp(float $timestamp): self
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
