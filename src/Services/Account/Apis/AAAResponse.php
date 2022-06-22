<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17
 */

namespace HughCube\Laravel\HuaWei\Services\Account\Apis;

use HughCube\Laravel\HuaWei\Http\Response;

class AAAResponse extends Response
{
    public function getCode(): ?int
    {
        return $this->error;
    }

    public function getSubCode(): ?int
    {
        return $this->sub_error;
    }

    public function getMessage(): ?string
    {
        return $this->error_description;
    }

    public function isSuccess(): bool
    {
        return null === $this->getCode();
    }
}
