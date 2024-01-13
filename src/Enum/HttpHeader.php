<?php

declare(strict_types=1);

namespace App\Enum;

enum HttpHeader: string
{
    case CONTENT_TYPE = 'content-type';
}