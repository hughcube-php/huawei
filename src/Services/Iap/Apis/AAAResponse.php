<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17.
 */

namespace HughCube\Laravel\HuaWei\Services\Iap\Apis;

use HughCube\Laravel\HuaWei\Http\Response;

class AAAResponse extends Response
{
    public function getCode(): ?int
    {
        /** @phpstan-ignore-next-line  */
        return $this->responseCode;
    }

    public function getSubCode(): ?int
    {
        return null;
    }

    public function getMessage(): ?string
    {
        /** @phpstan-ignore-next-line  */
        return $this->responseMessage;
    }

    public function isSuccess(): bool
    {
        return 0 === $this->getCode();
    }
}
