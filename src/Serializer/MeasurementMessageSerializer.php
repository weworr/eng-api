<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Message\MeasurementMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Serializer\SerializerInterface as Serializer;

class MeasurementMessageSerializer implements SerializerInterface
{
    public function __construct(
        private Serializer $serializer
    )
    {
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        if (empty($encodedEnvelope['body'])) {
            throw new InvalidArgumentException('Encoded envelope should have at least a "body"');
        }

        return new Envelope(
            new MeasurementMessage($encodedEnvelope['body'])
        );
    }

    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        if (!$message instanceof MeasurementMessage) {
            throw new UnexpectedTypeException($message, MeasurementMessage::class);
        }

        return [
            'body' => $this->serializer->serialize($message, JsonEncoder::FORMAT),
        ];
    }
}
