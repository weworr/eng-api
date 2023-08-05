<?php

declare(strict_types=1);

namespace App\Service;

use App\Document\Measurement;
use App\Exception\InvalidFormData;
use App\QueryCommand\GetMeasurementsQueryCommand;
use App\Repository\MeasurementRepository;
use App\Type\GetMeasurementsQueryCommandType;
use App\Type\MeasurementType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\FormFactoryInterface;

readonly class MeasurementService
{
    public function __construct(
        private DocumentManager $documentManager,
        private FormFactoryInterface $formFactory,
        private ErrorService $errorService,
        private MeasurementRepository $measurementRepository
    )
    {
    }

    public function get(array $params): array
    {
        $query = new GetMeasurementsQueryCommand();
        $form = $this->formFactory->create(GetMeasurementsQueryCommandType::class, $query);
        $form->submit($params);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->measurementRepository->findMeasurements($query);
        }

        throw new InvalidFormData($this->errorService->getFormErrors($form));
    }

    public function create(array $data): Measurement
    {
        $measurement = new Measurement();
        $form = $this->formFactory->create(MeasurementType::class, $measurement);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->documentManager->persist($measurement);
            $this->documentManager->flush();

            return $measurement;
        }


        throw new InvalidFormData($this->errorService->getFormErrors($form));
    }
}
