<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17.
 */

namespace HughCube\Laravel\HuaWei\Services\Account\Apis;

/**
 * @method RefreshTokenResponse request()
 *
 * @see https://developer.huawei.com/consumer/cn/doc/development/HMSCore-References/account-obtain-token_hms_reference-0000001050048618
 */
class RefreshTokenRequest extends AAARequest
{
    protected function initialize()
    {
        $this
            ->withFormValue('grant_type', 'refresh_token')
            ->withFormValue('client_id', $this->getService()->config->get('client_id'))
            ->withFormValue('client_secret', $this->getService()->config->get('client_id'));
    }

    public function getUri(): string
    {
        return '/oauth2/v3/token';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function withRefreshToken(string $code)
    {
        return $this->withFormValue('refresh_token', $code);
    }
}
