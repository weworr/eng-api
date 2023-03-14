<?php

namespace App\Service;

use App\Document\Measurement;
use App\Exception\InvalidFormData;
use App\Form\MeasurementType;
use App\Repository\MeasurementRepository;
use Symfony\Component\Form\FormFactoryInterface;

readonly class MeasurementService
{
    public function __construct(
        private MeasurementRepository $measurementRepository,
        private FormFactoryInterface  $formFactory,
        private ErrorService $errorService
    )
    {
    }

    public function getAll(): array
    {
        return $this->measurementRepository->findAll();
    }

    public function addMeasurement(array $data): Measurement
    {
        $measurement = new Measurement();
        $form = $this->formFactory->create(MeasurementType::class, $measurement);

        $form->submit($data);

        if ($form->isValid()) {
            $this->measurementRepository->add($measurement);
            return $measurement;
        }

        throw new InvalidFormData(json_encode($this->errorService->getFormErrors($form)));
    }
}