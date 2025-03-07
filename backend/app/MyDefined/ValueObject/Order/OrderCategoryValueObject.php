<?php

namespace App\MyDefined\ValueObject\Order;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class OrderCategoryValueObject extends ValueObject
{
    static $ITEM_NAME = '主要カテゴリ';

    /**
     * @param string $value
     */
    public static function create(?string $value): self
    {
        $instance = new self($value);
        return $instance;
    }

    private function validate($msg = '')
    {
        $msg .= $this->required();
        $msg .= $this->length(100);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>