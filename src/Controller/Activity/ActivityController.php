<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Activity;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\ActivityOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle activity calls
 *
 * @link https://docs.propstack.de/reference/aktivitaeten-1
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ActivityController extends PropstackController
{
    protected string $route = 'activities';

    /**
     * Read activities
     */
    public function read(array $parameters)
    {
        $this->call(
            (new ActivityOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Read a single activity
     */
    public function readOne($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        return $this->read([]);
    }
}
