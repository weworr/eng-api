<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\MeasurementBuilder;
use App\Document\Measurement;
use App\Domain\Measurement as MeasurementResult;
use App\Exception\InvalidFormData;
use App\QueryCommand\GetMeasurementsQueryCommand;
use App\Repository\MeasurementRepository;
use App\Type\GetMeasurementsQueryCommandType;
use App\Type\MeasurementType;
use App\Enum\MeasurementType as MeasurementTypeEnum;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\FormFactoryInterface;

readonly class MeasurementService
{
    public function __construct(
        private DocumentManager $documentManager,
        private FormFactoryInterface $formFactory,
        private ErrorService $errorService,
        private MeasurementRepository $measurementRepository,
        private MeasurementBuilder $measurementBuilder
    )
    {
    }

    public function get(array $params): MeasurementResult
    {
        $query = new GetMeasurementsQueryCommand();
        $form = $this->formFactory->create(GetMeasurementsQueryCommandType::class, $query);
        $form->submit($params);

        if ($form->isSubmitted() && $form->isValid()) {
            $measurements = $this->measurementRepository->findMeasurements($query);
            /** @var Measurement $measurement */
            foreach ($measurements as $measurement) {
                switch ($query->getMeasurementType()) {
                    case MeasurementTypeEnum::Temperature:
                        $this->measurementBuilder->buildTemperatureCollection($measurement);

                        break;
                    case MeasurementTypeEnum::Humidity:
                        $this->measurementBuilder->buildHumidityCollection($measurement);

                        break;
                    case MeasurementTypeEnum::Pressure:
                        $this->measurementBuilder->buildPressureCollection($measurement);

                        break;
                    case MeasurementTypeEnum::Voc:
                        $this->measurementBuilder->buildVocCollection($measurement);

                        break;
                    default:
                        $this->measurementBuilder
                            ->buildTemperatureCollection($measurement)
                            ->buildHumidityCollection($measurement)
                            ->buildPressureCollection($measurement)
                            ->buildVocCollection($measurement);
                }
            }

            return $this->measurementBuilder->build();
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
