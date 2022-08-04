<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Tag;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\SuperTagOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle super tag calls
 *
 * @link https://docs.propstack.de/reference/merkmale
 *
 * @author Sebastian Zoglowek <https://github.com/zoglo>
 */
class SuperTagController extends PropstackController
{
    protected string $route = 'super_groups';

    /**
     * Read super tags
     */
    public function read(array $parameters)
    {
        $this->call(
            (new SuperTagOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }
}
