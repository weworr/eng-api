<?php

namespace App\Controller;

use App\Document\Measurement;
use App\Service\MeasurementService;
use Doctrine\ODM\MongoDB\DocumentManager;
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
    public function getMeasurements(MeasurementService $measurementService, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($measurementService->getAll(), 'json'), json: true);
    }

    #[Route('addMeasurements', methods: ['POST', 'PUT'])]
    public function addMeasurements(Request $request, DocumentManager $dm, SerializerInterface $serializer): JsonResponse
    {
        $measurement = new Measurement();

        $measurement
            ->setTemperature(1.4)
            ->setHumidity(45);

        $dm->persist($measurement);
        $dm->flush();

        return new JsonResponse(
            $serializer->serialize(['measurement' => $measurement], 'json'),
            status: Response::HTTP_CREATED,
            json: true
        );
    }
}