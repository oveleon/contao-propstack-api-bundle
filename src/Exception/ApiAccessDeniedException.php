<?php

declare(strict_types=1);

namespace Oveleon\ContaoPropstackApiBundle\Exception;

class ApiAccessDeniedException extends ApiBaseException
{
    protected $code = 3002;
}
