<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Measurement;
use App\Factory\MeasurementFactory;
use Doctrine\ODM\MongoDB\DocumentManager;

readonly class MeasurementService
{
    public function __construct(
        private DocumentManager $documentManager
    )
    {
    }

    public function create(array $data): Measurement
    {
        $measurement = MeasurementFactory::createFromArray($data);

        $this->documentManager->persist($measurement);
        $this->documentManager->flush();

        return new Measurement(
        $data['timestamp'],
        $data['temperature'],
        $data['humidity'],
        $data['pressure'],
        $data['voc']
    );
    }
}
