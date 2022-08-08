<?php

namespace Oveleon\ContaoPropstackApiBundle\Controller;

use Contao\Config;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiAccessDeniedException;
use Oveleon\ContaoPropstackApiBundle\Exception\ApiConnectionException;
use Symfony\Component\HttpClient\Exception\JsonException;
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
    protected function call(array $parameters, string $method): void
    {
        if(null === $this->key)
        {
            throw new ApiAccessDeniedException('No valid Propstack API key');
        }

        // Call api
        $params = [
            'headers' => $this->getHeaders()
        ];

        if(count($parameters))
        {
            switch ($method)
            {
                case self::METHOD_READ:
                    $params['query'] = $parameters;
                    break;
                default:
                    $params['json'] = $parameters;
            }
        }

        $this->response = (HttpClient::create())->request(
            $method,
            $this->generateRoute(),
            $params
        );

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
            $error = $this->response->toArray(false);

            throw new ApiConnectionException($error['errors'][0]);
        }

        // Get content as array
        try {
            $content = $this->response->toArray();
        }
        catch (JsonException $e)
        {
            $content = [];
        }

        // Set default response array
        $response = [
            'data' => $content,
            'meta' => [
                'total_count' => isset($content['id']) ? 1 : count($content)
            ]
        ];

        // Check if the response contains a meta schema
        if(array_key_exists('meta', $content))
        {
            $response['meta'] = $content['meta'];
        }

        // Check if the response contains a data schema
        if(array_key_exists('data', $content))
        {
            $response['meta']['total_count'] = count($content['data']);
            $response['data'] = $content['data'];
        }

        $response = $this->transformResponse($response, $content);

        switch ($this->format)
        {
            case self::FORMAT_JSON:
                return new JsonResponse($response);
            default:
                return $response;
        }
    }

    /**
     * Validate and return the response
     */
    protected function transformResponse($response, $content): array
    {
        return $response;
    }

    /**
     * Temporarily adds a route path, paths are reset after executing `call`
     */
    protected function addRoutePath($path): void
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
     * Returns the request headers
     */
    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
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
