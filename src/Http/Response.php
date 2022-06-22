<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 14:56.
 */

namespace HughCube\Laravel\HuaWei\Http;

use HughCube\GuzzleHttp\LazyResponse;

abstract class Response
{
    /**
     * @var LazyResponse
     */
    private $httpResponse;

    private $bodyData;

    public function __construct(LazyResponse $httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    public function getHttpResponse(): LazyResponse
    {
        return $this->httpResponse;
    }

    public function getBodyData(): ?array
    {
        if (null === $this->bodyData) {
            $this->bodyData = $this->httpResponse->toArray();
        }

        return $this->bodyData;
    }

    abstract public function getCode();

    abstract public function getMessage();

    abstract public function isSuccess(): bool;

    public function __get($name)
    {
        return $this->getBodyData()[$name] ?? null;
    }
}
