<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 14:56
 */

namespace HughCube\Laravel\HuaWei\Http;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HughCube\GuzzleHttp\LazyResponse;
use HughCube\Laravel\HuaWei\Service;
use Illuminate\Support\Str;

abstract class Request
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @var array
     */
    protected $httpOptions = [];

    /**
     * @param  Service  $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->initialize();
    }

    protected function initialize()
    {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    abstract public function getUri(): string;

    protected function createResponse(LazyResponse $response): Response
    {
        $class = sprintf('%sResponse', Str::beforeLast(static::class, 'Request'));

        return new $class($response);
    }

    /**
     * @throws GuzzleException
     */
    public function request(): Response
    {
        $service = $this->getService();

        if (method_exists($service, 'getHttpBaseUri') && !empty($baseUrl = $service->getHttpBaseUri())) {
            $this->withBaseUri($baseUrl);
        }

        $response = $service->http_client->requestLazy(
            $this->getMethod(),
            $this->getUri(),
            $this->getHttpOptions()
        );

        return $this->createResponse($response);
    }

    /**
     * @param $when
     * @param  callable  $callable
     * @return static
     */
    public function when($when, callable $callable): Request
    {
        if ($when) {
            $callable($this);
        }

        return $this;
    }

    /**
     * @param $value
     * @param  callable  $callable
     * @return static
     */
    public function whenEmpty($value, callable $callable): Request
    {
        if (empty($value)) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @param $value
     * @param  callable  $callable
     * @return static
     */
    public function whenNotEmpty($value, callable $callable): Request
    {
        if (!empty($value)) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @param $value
     * @param  callable  $callable
     * @return static
     */
    public function whenNull($value, callable $callable): Request
    {
        if (null === $value) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @param $value
     * @param  callable  $callable
     * @return static
     */
    public function whenNotNull($value, callable $callable): Request
    {
        if (null !== $value) {
            $callable($value, $this);
        }

        return $this;
    }

    /**
     * @param  string  $name
     * @param $value
     * @return static
     */
    public function with(string $name, $value): Request
    {
        $this->httpOptions[$name] = $value;
        return $this;
    }

    /**
     * @param $value
     * @return static
     */
    public function withBaseUri($value): Request
    {
        return $this->with('base_uri', $value);
    }

    /**
     * @param $name
     * @param $value
     * @return static
     */
    public function withQueryValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::QUERY][$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return static
     */
    public function withJsonValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::JSON][$name] = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return static
     */
    public function withFormValue($name, $value): Request
    {
        $this->httpOptions[RequestOptions::FORM_PARAMS][$name] = $value;

        return $this;
    }
}
