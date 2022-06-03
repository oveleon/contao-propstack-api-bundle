<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Unit;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle unit (property states) calls
 *
 * @link https://docs.propstack.de/reference/objekte
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class UnitStateController extends PropstackController
{
    protected string $route = 'property_statuses';

    /**
     * Read property states
     */
    public function read()
    {
        $this->call([], self::METHOD_READ);

        return $this->getResponse();
    }
}
