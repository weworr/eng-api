<?php

declare(strict_types=1);

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Positive;

class GetMeasurementsQueryCommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('last', IntegerType::class, [
            'constraints' => [
                new Positive(),
            ],
        ])
        ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            if (isset($data['last'])) {
                $data['last'] = (int) $data['last'];
            }

            $event->setData($data);
        });
    }
}
