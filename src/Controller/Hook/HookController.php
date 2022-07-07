<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Hook;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\HookOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle webhook calls
 *
 * @link https://docs.propstack.de/reference/webhooks
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class HookController extends PropstackController
{
    protected string $route = 'hooks';

    /**
     * Read all hooks
     */
    public function read()
    {
        $this->call([], self::METHOD_READ);

        return $this->getResponse();
    }

    /**
     * Create a hook
     */
    public function create(array $parameters)
    {
        $this->call(
            (new HookOptions(Options::MODE_CREATE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Delete hook
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }
}
