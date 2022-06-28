<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2022/6/22
 * Time: 15:17.
 */

namespace HughCube\Laravel\HuaWei\Services\Iap\Apis;

/**
 * @property-read string $responseCode
 * @property-read string $responseMessage
 * @property-read string $purchaseTokenData
 * @property-read string $dataSignature
 * @property-read string $signatureAlgorithm
 */
class OrderVerifyTokenResponse extends AAAResponse
{
}
