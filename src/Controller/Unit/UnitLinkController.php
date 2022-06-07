<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Unit;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\UnitLinkOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle unit link calls
 *
 * @link https://docs.propstack.de/reference/objekte/links
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class UnitLinkController extends PropstackController
{
    protected string $route = 'links';

    /**
     * Create link
     */
    public function create(array $parameters)
    {
        $this->call(
            (new UnitLinkOptions(Options::MODE_CREATE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit link
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call(
            (new UnitLinkOptions(Options::MODE_EDIT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Delete link
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }
}
