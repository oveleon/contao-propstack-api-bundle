<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Note;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\NoteOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle note calls
 *
 * @link https://docs.propstack.de/reference/notizen
 * @link https://docs.propstack.de/reference/task
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class NoteController extends PropstackController
{
    protected string $route = 'notes';

    /**
     * Read task
     */
    public function read(array $parameters)
    {
        $this->call(
            (new NoteOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }
}
