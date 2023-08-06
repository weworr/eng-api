<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\MeasurementMessage;
use App\Service\MeasurementService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use Throwable;

class MeasurementHandler implements MessageHandlerInterface
{
    public function __construct(
        private MeasurementService $measurementService,
        private ChatterInterface $chatter
    )
    {
    }

    public function __invoke(MeasurementMessage $measurementMessage): void
    {
        try {
            $this->measurementService->create(
                json_decode($measurementMessage->getContent(), true)
            );
        } catch (Throwable $exception) {
            $this->chatter->send(
                new ChatMessage("@everyone Sending message failed\n" . $exception->getMessage())
            );
        }
    }
}
