<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Contact;

use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle contact sources calls
 *
 * @link https://docs.propstack.de/reference/kontakte#kontakt-quellen-lesen
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ContactSourceController extends PropstackController
{
    protected string $route = 'contact_sources';

    /**
     * Read contact sources
     */
    public function read()
    {
        $this->call([], self::METHOD_READ);

        return $this->getResponse();
    }
}
