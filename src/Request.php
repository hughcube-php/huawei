<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 14:56
 */

namespace HughCube\Laravel\HuaWei;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HughCube\GuzzleHttp\LazyResponse;
use Illuminate\Support\Str;

abstract class Request
{
    /**
     * @var Application
     */
    private $container = null;

    /**
     * @var array
     */
    protected $httpOptions = [];

    /**
     * @param  Container  $container
     */
    public function __construct(Container $container)
    {
        /** @phpstan-ignore-next-line */
        $this->container = $container;

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
     * @return Application
     */
    public function getContainer(): Container
    {
        return $this->container;
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
        $container = $this->getContainer();

        if (method_exists($container, 'getHttpBaseUri') && !empty($baseUrl = $container->getHttpBaseUri())) {
            $this->withBaseUri($baseUrl);
        }

        $response = $container->http_client->request(
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
