<?php

declare(strict_types=1);

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Range;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timestamp', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new PositiveOrZero(),
                ],
            ])
            ->add('temperature', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('humidity', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Range(
                        min: 0,
                        max: 100
                    )
                ],
            ])
            ->add('voc', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new PositiveOrZero(),
                ],
            ])
            ->add('pressure', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new PositiveOrZero(),
                ],
            ]);
    }
}
