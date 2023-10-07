<?php

declare(strict_types=1);

namespace App\Controller;

use App\Document\Measurement;
use App\Exception\InvalidFormData;
use App\Message\MeasurementMessage;
use App\Service\ErrorService;
use App\Service\MeasurementService;
use App\Type\MeasurementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/measurement', name: 'measurements_')]
class MeasurementController extends AbstractController
{
    public function __construct(
        private readonly MeasurementService $measurementService
    )
    {
    }

    #[Route('/get', name: 'get', methods: ['GET'])]
    public function getMeasurements(
        Request $request
    ): JsonResponse
    {
        return $this->json(
            $this->measurementService->get($request->request->all())
        );
    }

    #[Route('/add', name: 'add', methods: ['PUT'])]
    public function add(
        Request $request,
        MessageBusInterface $bus,
        ErrorService $errorService
    ): JsonResponse
    {
        $measurement = new Measurement();
        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch(new MeasurementMessage($request->getContent()));

            return $this->json(
                [],
                Response::HTTP_ACCEPTED
            );
        }

        throw new InvalidFormData($errorService->getFormErrors($form));
    }
}
