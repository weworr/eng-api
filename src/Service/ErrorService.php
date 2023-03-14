<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class ErrorService
{
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors(true) as $error) {
            $formFieldName = $error->getOrigin()->getName();
            $errors[$formFieldName] = $error->getMessage();
        }

        return $errors;
    }
}