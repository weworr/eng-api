<?php

declare(strict_types=1);

namespace App\Repository;

use App\Document\Measurement;
use App\QueryCommand\GetMeasurementsQueryCommand;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\Persistence\ManagerRegistry;

class MeasurementRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Measurement::class);
    }

    public function findMeasurements(GetMeasurementsQueryCommand $query): array
    {
        $qb = $this->createQueryBuilder()
            ->sort('timestamp', 'DESC');

        if (null !== $query->getMeasurementType()) {
            $qb->select('timestamp', $query->getMeasurementType()->value);
        }

        if (null !== $query->getFrom()) {
            $qb->field('timestamp')->gte($query->getFrom());
        }

        if (null !== $query->getLast()) {
            $qb->limit($query->getLast());
        }

        return $qb
            ->getQuery()
            ->execute()
            ->toArray();
    }
}
