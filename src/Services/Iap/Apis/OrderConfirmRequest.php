<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17.
 */

namespace HughCube\Laravel\HuaWei\Services\Iap\Apis;

use GuzzleHttp\RequestOptions;

/**
 * @method OrderConfirmResponse request()
 */
class OrderConfirmRequest extends AAARequest
{
    public function initialize()
    {
        parent::initialize();

        $this->httpOptions[RequestOptions::HEADERS]['Authorization']
            = $this->getService()->appat->getHttpAuthorization();
    }

    public function getUri(): string
    {
        return '/applications/v2/purchases/confirm';
    }

    public function withPurchaseToken($token)
    {
        return $this->withFormValue('purchaseToken', $token);
    }

    public function withProductId($id)
    {
        return $this->withFormValue('productId', $id);
    }
}
