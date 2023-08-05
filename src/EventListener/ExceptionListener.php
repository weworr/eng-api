<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof JsonException) {
            $response = new JsonResponse(json_decode($exception->getMessage()), Response::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}
