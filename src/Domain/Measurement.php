<?php

declare(strict_types=1);

namespace App\Domain;

use Symfony\Component\Serializer\Annotation as Serializer;

readonly class Measurement
{
    public function __construct(
        #[Serializer\SerializedName(serializedName: 'temperature')]
        private MeasurementValueCollection $temperatureCollection,
        #[Serializer\SerializedName(serializedName: 'humidity')]
        private MeasurementValueCollection $humidityCollection,
        #[Serializer\SerializedName(serializedName: 'pressure')]
        private MeasurementValueCollection $pressureCollection,
        #[Serializer\SerializedName(serializedName: 'voc')]
        private MeasurementValueCollection $vocCollection
    )
    {
    }

    public function getTemperatureCollection(): MeasurementValueCollection
    {
        return $this->temperatureCollection;
    }

    public function getHumidityCollection(): MeasurementValueCollection
    {
        return $this->humidityCollection;
    }

    public function getPressureCollection(): MeasurementValueCollection
    {
        return $this->pressureCollection;
    }

    public function getVocCollection(): MeasurementValueCollection
    {
        return $this->vocCollection;
    }

}
