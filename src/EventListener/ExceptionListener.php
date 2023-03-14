<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $responseMessage = json_decode($exception->getMessage(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $responseMessage = $exception->getMessage();
        }

        $response = new JsonResponse(['status' => $responseMessage], Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }
}