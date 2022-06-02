<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller;

use Contao\Config;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiAccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Propstack abstract controller.
 *
 * Usage:
 *   $units = new UnitController()
 *
 *   $units->setKey('myKey');
 *   $units->setFormat(PropstackController::FORMAT_ARRAY);
 *   $units->setVersion('v1');
 *
 *   $properties = $units->read(['marketing_type' => 'BUY'])
 *
 *
 * @author Daniele Sciannimanica <https://github.com/doishub>
 */
abstract class PropstackController
{
    /**
     * Base URL to call modules on Propstack
     */
    const BASE_URL = 'https://api.propstack.de';

    protected ?string $key;
    protected ?string $format;
    protected string $route;
    protected string $version = 'v1';

    protected const TYPE_READ = 0;
    protected const TYPE_CREATE = 1;
    protected const TYPE_EDIT = 2;
    protected const TYPE_DELETE = 3;

    public const FORMAT_JSON = 0;
    public const FORMAT_ARRAY = 1;

    private ?array $response;

    /**
     * Set API key
     */
    public function __construct()
    {
        // Set default response format
        $this->format = self::FORMAT_ARRAY;

        // Set key from config
        $this->key = Config::get('propstackApiKey') ?: null;
    }

    /**
     * Set key
     */
    public function setKey(string $key)
    {
        $this->key = $key;
    }

    /**
     * Set version
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
    }

    /**
     * Set response format
     */
    public function setFormat(int $format)
    {
        $this->format = $format;
    }

    /**
     * Call API
     */
    protected function call(?array $parameters, int $type): ?array
    {
        $this->response = null;

        if(null === $this->key)
        {
            throw new ApiAccessDeniedException('No valid Propstack API key');
        }

        switch ($type)
        {
            case self::TYPE_READ:   return $this->response = $this->read($parameters);
            case self::TYPE_CREATE: return $this->response = $this->create($parameters);
            case self::TYPE_EDIT:   return $this->response = $this->edit($parameters);
            case self::TYPE_DELETE: return $this->response = $this->delete($parameters);
        }

        return $this->response;
    }

    /**
     * Returns the data of the last call or the passed response
     */
    protected function getResponse(?array $response = null)
    {
        if(null === $response)
        {
            $response = $this->response;
        }

        switch ($this->format)
        {
            case self::FORMAT_JSON:
                return new JsonResponse($response);
            default:
                return $response;
        }
    }

    /**
     * Read properties
     */
    private function read(?array $parameters): ?array
    {
        // GET
        return [];
    }

    /**
     * Create properties
     */
    private function create(?array $parameters): ?array
    {
        // POST
        return [];
    }

    /**
     * Edit properties
     */
    private function edit(?array $parameters): ?array
    {
        // PUT
        return [];
    }

    /**
     * Delete properties
     */
    private function delete(?array $parameters): ?array
    {
        // DELETE
        return [];
    }

    /**
     * Returns the entire route to be called
     */
    private function generateRoute(): string
    {
        return self::BASE_URL . '/' .  $this->version . '/' . $this->route;
    }
}
