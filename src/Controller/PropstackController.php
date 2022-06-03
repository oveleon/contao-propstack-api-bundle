<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller;

use Contao\Config;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiAccessDeniedException;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiConnectionException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

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

    public const METHOD_READ   = 'GET';
    public const METHOD_CREATE = 'POST';
    public const METHOD_EDIT   = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public const FORMAT_JSON = 0;
    public const FORMAT_ARRAY = 1;

    private ?ResponseInterface $response;

    private ?array $routePaths = null;
    private ?array $routeQueries = null;

    /**
     * Set API key
     */
    public function __construct()
    {
        // Set default response format
        $this->setFormat(self::FORMAT_ARRAY);

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
    protected function call(?array $parameters, string $method): void
    {
        if(null === $this->key)
        {
            throw new ApiAccessDeniedException('No valid Propstack API key');
        }

        $this->response = null;

        switch ($method)
        {
            case self::METHOD_READ:   $this->response = $this->read($parameters); break;
            case self::METHOD_CREATE: $this->response = $this->create($parameters); break;
            case self::METHOD_EDIT:   $this->response = $this->edit($parameters); break;
            case self::METHOD_DELETE: $this->response = $this->delete($parameters); break;
        }

        // Reset route paths and queries
        $this->routePaths = null;
        $this->routeQueries = null;
    }

    /**
     * Returns the data of the last call
     */
    protected function getResponse()
    {
        if(null === $this->response)
        {
            throw new ApiAccessDeniedException('There is no response, please execute the `call` method first');
        }

        if(!in_array($this->response->getStatusCode(), [200, 201]))
        {
            throw new ApiConnectionException('The call was not accepted by Propstack, please check the passed parameters');
        }

        // Get content as array
        $content = $this->response->toArray();

        // Create response array
        $response = [
            'meta' => [
                'absolute' => isset($content['id']) ? 1 : count($content)
            ],
            'data' => $content
        ];

        switch ($this->format)
        {
            case self::FORMAT_JSON:
                return new JsonResponse($response);
            default:
                return $response;
        }
    }

    /**
     * Temporarily adds a route path, paths are reset after executing `call`
     */
    protected function addRoutePath(string $path): void
    {
        $this->routePaths[] = $path;
    }

    /**
     * Temporarily adds a route query, queries are reset after executing `call`
     */
    protected function addRouteQuery(string $key, string $value): void
    {
        $this->routeQueries[ $key ] = $value;
    }

    /**
     * Read properties
     */
    private function read(?array $parameters): ResponseInterface
    {
        return (HttpClient::create())->request(
            self::METHOD_READ,
            $this->generateRoute(),
            [
                'headers' => $this->getHeaders(),
                'query'   => $parameters
            ]
        );
    }

    /**
     * Create properties
     */
    private function create(?array $parameters): ResponseInterface
    {
        return (HttpClient::create())->request(
            self::METHOD_CREATE,
            $this->generateRoute(),
            [
                'headers' => $this->getHeaders(),
                'json'    => $parameters
            ]
        );
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
     * Returns the request headers
     */
    private function getHeaders(): array
    {
        return [
            'X-API-KEY' => $this->key
        ];
    }

    /**
     * Returns the entire route to be called
     */
    private function generateRoute(): string
    {
        $query = '';
        $fragments = [
            self::BASE_URL,
            $this->version,
            $this->route
        ];

        if(null !== $this->routePaths)
        {
            $fragments = array_merge($fragments, $this->routePaths);
        }

        if(null !== $this->routeQueries)
        {
            $query = '?' . http_build_query($this->routeQueries);
        }

        return implode('/', $fragments) . $query;
    }
}
