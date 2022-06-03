<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Api;

use Contao\System;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;
use Oveleon\ContaoPropstackApiBundle\Controller\Unit\UnitController;
use Oveleon\ContaoPropstackApiBundle\Controller\Unit\UnitStateController;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiAccessDeniedException;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiMethodDeniedException;
use Oveleon\ContaoPropstackApiBundle\Security\Api\Authenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/propstack", name="propstack_api_")
 */
class RoutingController
{
    /**
     * Base URL to access the API via request
     */
    const BASE_URL = '/api/propstack';

    protected RequestStack $requestStack;

    public function __construct(Authenticator $authenticator, RequestStack $requestStack)
    {
        if(!$authenticator->isGranted())
        {
            throw new ApiAccessDeniedException('No valid API key passed');
        }

        $this->requestStack = $requestStack;
    }

    /**
     * List api routes
     *
     * @Route("/help", name="help")
     */
    public function help(): JsonResponse
    {
        $router = System::getContainer()->get('router');
        $routeCollection = $router->getRouteCollection();
        $routes = [];

        foreach($routeCollection->all() as $name => $route)
        {
            $path = $route->getPath();

            if(0 === strpos($path, self::BASE_URL))
            {
                $routes[ $name ] = $route->getPath();
            }
        }

        return new JsonResponse($routes);
    }

    /**
     * Units
     *
     * @Route("/units/{id}", defaults={"id" = null}, name="units")
     */
    public function units(?int $id = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objUnits = new UnitController();
        $objUnits->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_CREATE:
                // Create
                return $objUnits->create($parameters);

            case PropstackController::METHOD_EDIT:
                // Edit
                return $objUnits->edit($id, $parameters);

            case PropstackController::METHOD_DELETE:
                // Delete
                return $objUnits->delete($id);

            case PropstackController::METHOD_READ:
                // Read
                if(null !== $id)
                {
                    return $objUnits->readOne($id);
                }

                return $objUnits->read($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Property Statuses
     *
     * @Route("/property_status", name="property_status")
     */
    public function propertyStatuses(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objUnits = new UnitStateController();
        $objUnits->setFormat(PropstackController::FORMAT_JSON);

        if(PropstackController::METHOD_READ === $request->getMethod())
        {
            return $objUnits->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }
}
