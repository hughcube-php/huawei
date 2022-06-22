<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17.
 */

namespace HughCube\Laravel\HuaWei\Services\Account\Apis;

/**
 * @method TokenInfoResponse request()
 *
 * @see https://developer.huawei.com/consumer/cn/doc/development/HMSCore-References/account-verify-id-token_hms_reference-0000001050050577
 */
class TokenInfoRequest extends AAARequest
{
    public function getUri(): string
    {
        return '/oauth2/v3/tokeninfo';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function withIdToken(string $code)
    {
        return $this->withFormValue('id_token', $code);
    }
}
