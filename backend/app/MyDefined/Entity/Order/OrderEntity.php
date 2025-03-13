<?php

namespace App\MyDefined\Entity\Order;

use App\MyDefined\Entity\Entity;
use App\MyDefined\ValueObject\Order\ContentNameValueObject;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;
use App\MyDefined\ValueObject\Order\OrderQuantityValueObject;

final class OrderEntity extends Entity{
    public $orderNumber;
    public $contentName;
    public $orderQuantity;

    private function __construct()
    {
        
    }

    public static function reconstructFromRepository(
        OrderNumberValueObject $orderNumber,
        ContentNameValueObject $contentName,
        OrderQuantityValueObject $orderQuantity
    ):OrderEntity {
        $selfEntity = new self();
        $selfEntity->orderNumber = $orderNumber;
        $selfEntity->contentName = $contentName;
        $selfEntity->orderQuantity = $orderQuantity;
        return $selfEntity;
    }
}
?>