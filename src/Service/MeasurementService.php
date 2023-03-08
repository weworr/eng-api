<?php

namespace App\Service;

use App\Repository\MeasurementRepository;

class MeasurementService
{
    public function __construct(private readonly MeasurementRepository $measurementRepository)
    {
    }

    public function getAll(): array
    {
        return $this->measurementRepository->findAll();
    }
}