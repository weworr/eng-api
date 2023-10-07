<?php

declare(strict_types=1);

namespace App\Enum;

enum MeasurementType : string
{
    case Temperature = 'temperature';

    case Humidity = 'humidity';

    case Pressure = 'pressure';

    case Voc = 'voc';
}
