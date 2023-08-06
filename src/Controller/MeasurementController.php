<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message\MeasurementMessage;
use App\Service\MeasurementService;
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
        return $this->json([
            $this->measurementService->get($request->request->all())
        ]);
    }

    #[Route('/add', name: 'add', methods: ['PUT'])]
    public function add(
        Request $request
    ): JsonResponse
    {
        return $this->json(
            $this->measurementService->create($request->request->all()),
            Response::HTTP_CREATED
        );
    }

    #[Route('/test')]
    public function test(
        MessageBusInterface $bus
    ): JsonResponse
    {
        $bus->dispatch(new MeasurementMessage('lol'));

        return $this->json('xdd');
    }
}
