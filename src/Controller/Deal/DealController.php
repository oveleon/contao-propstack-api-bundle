<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Deal;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\DealOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle deal calls
 *
 * @link https://docs.propstack.de/reference/deals
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class DealController extends PropstackController
{
    protected string $route = 'client_properties';

    /**
     * Read deals
     */
    public function read(array $parameters)
    {
        $this->call(
            (new DealOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Create deal
     */
    public function create(array $parameters)
    {
        $this->call(
            (new DealOptions(Options::MODE_CREATE))
                ->validate(['client_property' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit deal
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call(
            (new DealOptions(Options::MODE_EDIT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }
}
