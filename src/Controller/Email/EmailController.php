<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Email;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\EmailOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle email calls
 *
 * @link https://docs.propstack.de/reference/e-mails
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class EmailController extends PropstackController
{
    protected string $route = 'messages';

    /**
     * Send an email
     */
    public function send(array $parameters)
    {
        $this->call(
            (new EmailOptions(Options::MODE_CREATE))
                ->validate(['message' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }
}
