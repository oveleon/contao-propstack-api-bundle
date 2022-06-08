<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Team;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle team calls
 *
 * @link https://docs.propstack.de/reference/teams
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class TeamController extends PropstackController
{
    protected string $route = 'departments';

    /**
     * Read teams
     */
    public function read()
    {
        $this->call([],self::METHOD_READ);

        return $this->getResponse();
    }
}
