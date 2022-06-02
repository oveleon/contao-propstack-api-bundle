<?php

declare(strict_types=1);

namespace Oveleon\ContaoPropstackApiBundle\Exception;

class ApiConnectionException extends ApiBaseException
{
    protected $code = 3001;
}
