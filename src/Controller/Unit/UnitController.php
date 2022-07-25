<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Unit;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\Constants;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\UnitOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle unit calls
 *
 * @link https://docs.propstack.de/reference/objekte
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class UnitController extends PropstackController
{
    protected string $route = 'units';

    protected ?array $relations = null;

    /**
     * Read units
     */
    public function read(array $parameters)
    {
        foreach ((new UnitOptions(Options::MODE_QUERY))->validate($parameters) as $key => $value)
        {
            $this->addRouteQuery($key, $value);
        }

        $this->call(
            (new UnitOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Read a single unit
     */
    public function readOne($id, $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        return $this->read($parameters);
    }

    /**
     * Create unit
     */
    public function create(array $parameters)
    {
        // Apply relationships
        $this->applyRelationships($parameters);

        $this->call(
            (new UnitOptions(Options::MODE_CREATE))
                ->validate(['property' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit units
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        // Apply relationships
        $this->applyRelationships($parameters);

        $this->call(
            (new UnitOptions(Options::MODE_EDIT))
                ->validate(['property' => $parameters]),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Delete unit
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }

    /**
     * Add a relation to an existing contact
     */
    public function setRelationship(string $relationType, int $relatedClientId, ?array $customData = null): void
    {
        $relation = array_merge([
            'internal_name'     => $relationType,
            'related_client_id' => $relatedClientId
        ], $customData ?? []);

        // Only known relations should be added
        switch($relationType)
        {
            case Constants::RELATIONSHIP_OWNER:
            case Constants::RELATIONSHIP_PARTNER:
                $this->relations[] = $relation;
        }
    }

    /**
     * Applies the existing relations to the given parameters
     */
    private function applyRelationships(&$parameters): void
    {
        if(!$this->relations)
        {
            return;
        }

        // Consideration of already given Relationships
        if(array_key_exists('relationships_attributes', $parameters))
        {
            $parameters['relationships_attributes'] = array_merge(
                $parameters['relationships_attributes'],
                $this->relations
            );
        }
        else
        {
            $parameters['relationships_attributes'] = $this->relations;
        }
    }
}
