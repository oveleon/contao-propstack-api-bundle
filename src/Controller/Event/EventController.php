<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Event;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\EventOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle event calls
 *
 * @link https://docs.propstack.de/reference/termine
 * @link https://docs.propstack.de/reference/task
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class EventController extends PropstackController
{
    protected string $route = 'events';

    /**
     * Create event
     */
    public function read(array $parameters)
    {
        $this->call(
            (new EventOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * @inheritDoc
     */
    protected function transformResponse($response, $content): array
    {
        $response['meta']['total_count'] = count($content['events']);
        $response['data'] = $content['events'];

        return $response;
    }
}
