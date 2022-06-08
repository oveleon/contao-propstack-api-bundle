<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Department;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle department calls
 *
 * @link https://docs.propstack.de/reference/abteilungen
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class DepartmentController extends PropstackController
{
    protected string $route = 'teams';

    /**
     * Read departments
     */
    public function read()
    {
        $this->call([],self::METHOD_READ);

        return $this->getResponse();
    }
}
