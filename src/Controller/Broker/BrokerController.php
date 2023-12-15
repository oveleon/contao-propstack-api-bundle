<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Broker;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle brokers
 *
 * @link https://docs.propstack.de/reference/brokers
 *
 * @author Sebastian Zoglowek <https://github.com/zoglo>
 */
class BrokerController extends PropstackController
{
    protected string $route = 'brokers';

    /**
     * Read brokers
     */
    public function read()
    {
        $this->call([],self::METHOD_READ);

        return $this->getResponse();
    }

    /**
     * Read a single broker
     */
    public function readOne($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        return $this->read();
    }
}
