<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Api;

use Contao\System;
use Oveleon\ContaoPropstackApiBundle\Controller\Activity\ActivityController;
use Oveleon\ContaoPropstackApiBundle\Controller\Activity\ActivityTypeController;
use Oveleon\ContaoPropstackApiBundle\Controller\Contact\ContactController;
use Oveleon\ContaoPropstackApiBundle\Controller\Contact\ContactSourceController;
use Oveleon\ContaoPropstackApiBundle\Controller\Department\DepartmentController;
use Oveleon\ContaoPropstackApiBundle\Controller\Document\DocumentController;
use Oveleon\ContaoPropstackApiBundle\Controller\Email\EmailController;
use Oveleon\ContaoPropstackApiBundle\Controller\Event\EventController;
use Oveleon\ContaoPropstackApiBundle\Controller\Location\LocationController;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;
use Oveleon\ContaoPropstackApiBundle\Controller\CustomField\CustomFieldController;
use Oveleon\ContaoPropstackApiBundle\Controller\Note\NoteController;
use Oveleon\ContaoPropstackApiBundle\Controller\SearchInquiry\SearchInquiryController;
use Oveleon\ContaoPropstackApiBundle\Controller\Task\TaskController;
use Oveleon\ContaoPropstackApiBundle\Controller\Team\TeamController;
use Oveleon\ContaoPropstackApiBundle\Controller\Unit\UnitController;
use Oveleon\ContaoPropstackApiBundle\Controller\Unit\UnitImageController;
use Oveleon\ContaoPropstackApiBundle\Controller\Unit\UnitLinkController;
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

        $objStates = new UnitStateController();
        $objStates->setFormat(PropstackController::FORMAT_JSON);

        if(PropstackController::METHOD_READ === $request->getMethod())
        {
            return $objStates->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Property Links
     *
     * @Route("/links/{id}", defaults={"id" = null}, name="property_link")
     */
    public function propertyLinks(?int $id = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objLinks = new UnitLinkController();
        $objLinks->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_CREATE:
                // Create
                return $objLinks->create($parameters);

            case PropstackController::METHOD_EDIT:
                // Edit
                return $objLinks->edit($id, $parameters);

            case PropstackController::METHOD_DELETE:
                // Delete
                return $objLinks->delete($id);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Property Images
     *
     * @Route("/images", name="property_image")
     */
    public function propertyImages(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objImages = new UnitImageController();
        $objImages->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_CREATE:
                // Create
                return $objImages->create($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Custom fields
     *
     * @Route("/custom_field_groups", name="custom_field")
     */
    public function customFields(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objFields = new CustomFieldController();
        $objFields->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Create
                return $objFields->read($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Activities
     *
     * @Route("/activities/{id}", defaults={"id" = null}, name="activities")
     */
    public function activities(?int $id = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objActivity = new ActivityController();
        $objActivity->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                if(null !== $id)
                {
                    return $objActivity->readOne($id);
                }

                return $objActivity->read($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Activities types
     *
     * @Route("/activity_types", name="activity_types")
     */
    public function activityTypes(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objTypes = new ActivityTypeController();
        $objTypes->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objTypes->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Tasks
     *
     * @Route("/tasks/{module}", defaults={"module" = null}, name="tasks")
     */
    public function tasks(?string $module = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objTasks = new TaskController();
        $objTasks->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_CREATE:
                // Create
                switch ($module)
                {
                    case 'note':
                        return $objTasks->createNote($parameters);
                    case 'reminder':
                        return $objTasks->createReminder($parameters);
                    case 'event':
                        return $objTasks->createEvent($parameters);
                    case 'inquiry':
                        return $objTasks->createInquiry($parameters);
                    default:
                        return $objTasks->create($parameters);
                }
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Notes
     *
     * @Route("/notes", name="notes")
     */
    public function notes(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objTasks = new NoteController();
        $objTasks->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objTasks->read($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Events
     *
     * @Route("/events", name="events")
     */
    public function events(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objEvents = new EventController();
        $objEvents->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objEvents->read($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Search Inquiries
     *
     * @Route("/saved_queries/{id}", defaults={"id" = null}, name="saved_queries")
     */
    public function searchInquiries(?int $id = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objInquiries = new SearchInquiryController();
        $objInquiries->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objInquiries->read($parameters);

            case PropstackController::METHOD_CREATE:
                // Create
                return $objInquiries->create($parameters);

            case PropstackController::METHOD_EDIT:
                // Edit
                return $objInquiries->edit($id, $parameters);

            case PropstackController::METHOD_DELETE:
                // Delete
                return $objInquiries->delete($id);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Documents
     *
     * @Route("/documents/{id}", defaults={"id" = null}, name="documents")
     */
    public function documents(/*mixed*/ $id = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objDocuments = new DocumentController();
        $objDocuments->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                if(null !== $id)
                {
                    if('tags' === $id)
                    {
                        return $objDocuments->readTags();
                    }

                    return $objDocuments->readOne($id);
                }

                return $objDocuments->read($parameters);

            case PropstackController::METHOD_CREATE:
                // Create
                return $objDocuments->create($parameters);

            case PropstackController::METHOD_EDIT:
                // Edit
                return $objDocuments->edit($id, $parameters);

            case PropstackController::METHOD_DELETE:
                // Delete
                return $objDocuments->delete($id);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Messages
     *
     * @Route("/messages", name="messages")
     */
    public function messages(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objMail = new EmailController();
        $objMail->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_CREATE:
                // Send (create)
                return $objMail->send($parameters);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Contacts
     *
     * @Route("/contacts/{id}/{module}", defaults={"id" = null, "module" = null}, name="contacts")
     */
    public function contacts(/*mixed*/ $id = null, ?string $module = null): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();
        $parameters = $request->query->all();

        $objContacts = new ContactController();
        $objContacts->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                if(null !== $id)
                {
                    return $objContacts->readOne($id, $parameters);
                }

                return $objContacts->read($parameters);

            case PropstackController::METHOD_CREATE:
                // Create
                if('favorites' === $module && null !== $id)
                {
                    return $objContacts->favorite($id, $parameters);
                }

                return $objContacts->create($parameters);

            case PropstackController::METHOD_EDIT:
                // Edit
                return $objContacts->edit($id, $parameters);

            case PropstackController::METHOD_DELETE:
                // Delete
                return $objContacts->delete($id);
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Contact sources
     *
     * @Route("/contact_sources", name="contact_sources")
     */
    public function contactSources(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objSources = new ContactSourceController();
        $objSources->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objSources->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Locations
     *
     * @Route("/locations", name="locations")
     */
    public function locations(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objLocations = new LocationController();
        $objLocations->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objLocations->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Teams
     *
     * @Route("/teams", name="teams")
     */
    public function teams(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objTeams = new TeamController();
        $objTeams->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objTeams->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }

    /**
     * Departments
     *
     * @Route("/departments", name="department")
     */
    public function departments(): JsonResponse
    {
        $request = $this->requestStack->getCurrentRequest();

        $objDepartments = new DepartmentController();
        $objDepartments->setFormat(PropstackController::FORMAT_JSON);

        switch($request->getMethod())
        {
            case PropstackController::METHOD_READ:
                // Read
                return $objDepartments->read();
        }

        throw new ApiMethodDeniedException('The method used is not supported');
    }
}
