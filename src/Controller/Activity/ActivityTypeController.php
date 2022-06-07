<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Activity;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle activity calls
 *
 * @link https://docs.propstack.de/reference/aktivitaeten-1#aktivitaetstypen-lesen
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ActivityTypeController extends PropstackController
{
    protected string $route = 'activity_types';

    /**
     * Read activity types
     */
    public function read()
    {
        $this->call([], self::METHOD_READ);

        return $this->getResponse();
    }
}
