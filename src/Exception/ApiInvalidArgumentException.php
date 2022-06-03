<?php

declare(strict_types=1);

namespace Oveleon\ContaoPropstackApiBundle\Exception;

class ApiInvalidArgumentException extends ApiBaseException
{
    protected $code = 3002;
}
