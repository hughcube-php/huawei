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
    /**
     * @return null|array
     */
    public function getPurchaseData(): ?array
    {
        $data = json_decode($this->purchaseTokenData, true);
        return is_array($data) ? $data : null;
    }

    public function getOrderId(): ?string
    {
        return $this->getPurchaseData()['orderId'] ?? null;
    }

    public function getProductId(): ?string
    {
        return $this->getPurchaseData()['productId'] ?? null;
    }

    public function getDeveloperPayload(): ?string
    {
        return $this->getPurchaseData()['developerPayload'] ?? null;
    }
}
