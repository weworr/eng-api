<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

class JsonException extends Exception
{
    public function __construct(array $message = [], int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(json_encode($message, JSON_PRETTY_PRINT), $code, $previous);
    }
}
