<?php

declare(strict_types=1);

namespace Oveleon\ContaoPropstackApiBundle\Exception;

class ApiMethodDeniedException extends ApiBaseException
{
    protected $code = 3003;
}
