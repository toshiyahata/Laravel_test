<?php

namespace App\MyDefined\ValueObject\Order;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class ClientOrderNumberValueObject extends ValueObject
{
    static $ITEM_NAME = '先方注文番号';

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
        $msg .= $this->length(100);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>