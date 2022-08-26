<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller\Document;

use Oveleon\ContaoPropstackApiBundle\Controller\Options\DocumentOptions;
use Oveleon\ContaoPropstackApiBundle\Controller\Options\Options;
use Oveleon\ContaoPropstackApiBundle\Controller\PropstackController;

/**
 * Handle document calls
 *
 * @link https://docs.propstack.de/reference/dokumente
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
class DocumentController extends PropstackController
{
    protected string $route = 'documents';

    /**
     * Read documents
     */
    public function read(array $parameters)
    {
        $this->call(
            (new DocumentOptions(Options::MODE_READ))
                ->validate($parameters),
            self::METHOD_READ
        );

        return $this->getResponse();
    }

    /**
     * Read a single document
     */
    public function readOne($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        return $this->read([]);
    }

    /**
     * Read document tags
     */
    public function readTags()
    {
        // Add id to route
        $this->addRoutePath('tags');

        return $this->read([]);
    }

    /**
     * Create documents
     */
    public function create(array $parameters)
    {
        $this->call(
            (new DocumentOptions(Options::MODE_CREATE))
                ->validate(['document' => $parameters]),
            self::METHOD_CREATE
        );

        return $this->getResponse();
    }

    /**
     * Edit a single document
     */
    public function edit($id, array $parameters)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call(
            (new DocumentOptions(Options::MODE_EDIT))
                ->validate(['document' => $parameters]),
            self::METHOD_EDIT
        );

        return $this->getResponse();
    }

    /**
     * Delete a single document
     */
    public function delete($id)
    {
        // Add id to route
        $this->addRoutePath($id);

        $this->call([], self::METHOD_DELETE);

        return $this->getResponse();
    }

    /**
     * @inheritDoc
     */
    protected function transformResponse($response, $content): array
    {
        $response['meta']['total_count'] = $content['meta']['total_count'];
        $response['data'] = $content['documents'] ?? $content;

        return $response;
    }
}
