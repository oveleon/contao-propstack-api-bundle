<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Location;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle location calls
 *
 * @link https://docs.propstack.de/reference/bezirke
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class LocationController extends PropstackController
{
    protected string $route = 'locations';

    /**
     * Read locations
     */
    public function read()
    {
        $this->call([],self::METHOD_READ);

        return $this->getResponse();
    }
}
