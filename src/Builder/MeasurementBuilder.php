<?php

declare(strict_types=1);

namespace App\Builder;

use App\Document\Measurement;
use App\Domain\Measurement as MeasurementResult;
use App\Domain\MeasurementValue;
use App\Domain\MeasurementValueCollection;

readonly class MeasurementBuilder
{
    private MeasurementValueCollection $temperatureCollection;

    private MeasurementValueCollection $humidityCollection;

    private MeasurementValueCollection $pressureCollection;

    private MeasurementValueCollection $vocCollection;

    public function __construct()
    {
        $this->temperatureCollection = new MeasurementValueCollection();
        $this->humidityCollection = new MeasurementValueCollection();
        $this->pressureCollection = new MeasurementValueCollection();
        $this->vocCollection = new MeasurementValueCollection();
    }

    public function build(): MeasurementResult
    {
        return new MeasurementResult(
            $this->temperatureCollection,
            $this->humidityCollection,
            $this->pressureCollection,
            $this->vocCollection
        );
    }

    public function buildTemperatureCollection(Measurement $measurement): self
    {
        $this->temperatureCollection->addToCollection(
            (new MeasurementValue(
                (int) $measurement->getTimestamp(),
                $measurement->getTemperature()
            ))
        );

        return $this;
    }

    public function buildHumidityCollection(Measurement $measurement): self
    {
        $this->humidityCollection->addToCollection(
            (new MeasurementValue(
                (int) $measurement->getTimestamp(),
                $measurement->getHumidity()
            ))
        );

        return $this;
    }

    public function buildPressureCollection(Measurement $measurement): self
    {
        $this->pressureCollection->addToCollection(
            (new MeasurementValue(
                (int) $measurement->getTimestamp(),
                $measurement->getPressure()
            ))
        );

        return $this;
    }

    public function buildVocCollection(Measurement $measurement): self
    {
        $this->vocCollection->addToCollection(
            (new MeasurementValue(
                (int) $measurement->getTimestamp(),
                $measurement->getVoc()
            ))
        );

        return $this;
    }
}
