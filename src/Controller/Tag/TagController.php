<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Tag;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\TagOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle tag calls
 *
 * @link https://docs.propstack.de/reference/merkmale
 *
 * @author Sebastian Zoglowek <https://github.com/zoglo>
 */
class TagController extends PropstackController
{
    protected string $route = 'groups';

    /**
     * Read tags
     */
    public function read(array $parameters)
    {
        $this->call(
            (new TagOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Create tags
     */
    public function create(array $parameters)
    {
        $this->call(
            (new TagOptions(Options::MODE_CREATE))
                ->validate($parameters),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }
}
