<?php

declare(strict_types=1);

namespace App\Factory;

use App\Document\Measurement;

class MeasurementFactory
{
    public static function createFromArray(array $data): Measurement
    {
        return new Measurement(
            $data['timestamp'],
            $data['temperature'],
            $data['humidity'],
            $data['pressure'],
            $data['voc']
        );
    }
}
