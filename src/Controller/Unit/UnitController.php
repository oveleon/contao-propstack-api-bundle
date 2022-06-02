<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Unit;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle unit calls
 *
 * @link https://docs.propstack.de/reference/objekte
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class UnitController extends PropstackController
{
    protected string $route = 'units';

    /**
     * Read units
     */
    public function read(array $parameters)
    {
        $this->call($parameters, self::TYPE_READ);

        return $this->getResponse();
    }

    /**
     * Read a single unit
     */
    public function readById($id, array $parameters)
    {
        // Set route with id
        $this->route = $this->route . '/' . $id;

        return $this->read($parameters);
    }


}
