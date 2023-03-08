<?php

namespace App\Controller;

use App\Service\MeasurementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/')]
class MeasurementController extends AbstractController
{
    #[Route('/')]
    public function index(): void
    {
        throw new NotFoundHttpException();
    }

    #[Route('/getMeasurements', methods: ['GET'])]
    public function getMeasurements(
        MeasurementService $measurementService,
        SerializerInterface $serializer
    ): JsonResponse
    {
        return new JsonResponse($serializer->serialize($measurementService->getAll(), 'json'), json: true);
    }

    #[Route('addMeasurements', methods: ['POST', 'PUT'])]
    public function addMeasurements(
        Request $request,
        MeasurementService $measurementService,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $measurement = $measurementService->addMeasurement($request->request->all());

        return new JsonResponse(
            $serializer->serialize(['measurement' => $measurement], 'json'),
            status: Response::HTTP_CREATED,
            json: true
        );
    }
}