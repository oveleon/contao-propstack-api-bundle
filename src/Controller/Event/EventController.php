<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Event;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\EventOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle note calls
 *
 * @link https://docs.propstack.de/reference/termine
 * @link https://docs.propstack.de/reference/task
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class EventController extends PropstackController
{
    protected string $route = 'events';

    /**
     * Create task
     */
    public function read(array $parameters)
    {
        $this->call(
            (new EventOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }
}
