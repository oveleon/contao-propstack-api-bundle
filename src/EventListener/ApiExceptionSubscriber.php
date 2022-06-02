<?php

namespace Oveleon\ContaoPropstackApiBundle\EventListener;

use ContaoEstateManager\EstateManager\Exception\ApiBaseException;
use Oveleon\ContaoPropstackApiBundle\Controller\Api\RoutingController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Handle api exceptions
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class ApiExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(RequestEvent $event)
    {
        $r = $event->getRequest();
        $e = $event->getThrowable();

        if (!$e instanceof ApiBaseException && strpos($r->getPathInfo(), RoutingController::BASE_URL) !== 0) {
            return;
        }

        $arrError = [
            'error'   => 1,
            'message' => $e->getMessage(),
            'code'    => $e->getCode()
        ];

       $event->setResponse(new JsonResponse($arrError));
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }
}
