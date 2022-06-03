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
    public function upload(array $parameters)
    {
        $this->call(
            (new UnitImageOptions(Options::MODE_UPLOAD))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }
}
