<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Unit;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\UnitImageOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle unit image calls
 *
 * @link https://docs.propstack.de/reference/objekte/bilder
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class UnitImageController extends PropstackController
{
    protected string $route = 'images';

    /**
     * Upload unit image
     */
    public function create(array $parameters)
    {
        $this->call(
            (new UnitImageOptions(Options::MODE_CREATE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit unit image
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call(
            (new UnitImageOptions(Options::MODE_EDIT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Delete unit image
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }

    /**
     * Sort unit images
     */
    public function sortImages(array $parameters)
    {
        // Add sort attribute to route
        $this->addRoutePath('sort');

        foreach ((new UnitImageOptions(Options::MODE_QUERY))->validate($parameters) as $key => $value)
        {
            $this->addRouteQuery($key, $value);
        }

        $this->call(
            (new UnitImageOptions(UnitImageOptions::MODE_EDIT_SORT))
                ->validate($parameters),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }
}
