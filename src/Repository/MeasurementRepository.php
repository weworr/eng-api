<?php

namespace App\Repository;

use App\Document\Measurement;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class MeasurementRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $dm)
    {
        parent::__construct($dm, Measurement::class);
    }

    public function add(Measurement $measurement)
    {
        $this->dm->persist($measurement);
        $this->dm->flush();
    }
}