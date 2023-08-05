<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\MeasurementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/measurement', name: 'measurements_')]
class MeasurementController extends AbstractController
{
    #[Route('/add', name: 'add', methods: ['PUT'])]
    public function index(
        Request $request,
        MeasurementService $measurementService
    ): JsonResponse
    {
        return $this->json([
            $measurementService->create($request->request->all()),
            ],
        Response::HTTP_CREATED
        );
    }
}
