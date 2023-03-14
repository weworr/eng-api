<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('temperature', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\PositiveOrZero(),
                ],
                'invalid_message' => 'Value should be a number',
            ])
            ->add('humidity', NumberType::class, [
                'constraints' => [
                    new Assert\GreaterThanOrEqual(0),
                    new Assert\LessThanOrEqual(100),
                ],
                'invalid_message' => 'Value should be a number',
            ])
            ->add('pressure', NumberType::class, [
                'invalid_message' => 'Value should be a number',
            ])
            ->add('voc', NumberType::class, [
                'invalid_message' => 'Value should be a number',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'allow_extra_fields' => false,
        ]);
    }
}