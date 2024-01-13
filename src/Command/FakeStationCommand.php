<?php

declare(strict_types=1);

namespace App\Command;

use App\Document\Measurement;
use App\Enum\SerializationFormat;
use App\Message\MeasurementMessage;
use App\Repository\Api\OpenMeteo\OpenMeteoApiRepository;
use App\Type\MeasurementType;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(name: 'app:fake-station')]
final class FakeStationCommand extends Command
{
    public function __construct(
        private readonly OpenMeteoApiRepository $openMeteoApiRepository,
        private readonly FormFactoryInterface $formFactory,
        private readonly MessageBusInterface $bus,
        private readonly SerializerInterface $serializer,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $measurement = new Measurement();

        $form = $this->formFactory->create(
            MeasurementType::class,
            $measurement
        );

        $data = [
            ...$this->openMeteoApiRepository->getCurrentForecast()->toArray(),
            'voc' => 0.0
        ];

        $form->submit($data);

        if ($form->isSubmitted() && !$form->isValid()) {
            $errors = [];

            foreach ($form as $fieldName => $field) {
                if (0 !== $field->getErrors()->count()) {
                    $errors[$fieldName] = $field->getErrors()->current()->getMessage();
                }
            }

            $output->writeln('Invalid Form! Errors:');
            $output->writeln(json_encode($errors, JSON_PRETTY_PRINT));

            return 1;
        }

        $this->bus->dispatch(
            new MeasurementMessage(
                $this->serializer->serialize($measurement, SerializationFormat::JSON->value)
            )
        );

        $output->writeln('Readings sent to queue');

        return 0;
    }
}