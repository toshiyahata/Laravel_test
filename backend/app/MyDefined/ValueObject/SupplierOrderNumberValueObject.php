<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class SupplierOrderNumberValueObject extends ValueObject
{
    static $ITEM_NAME = '先方注文番号';

    /**
     * @param string $value
     */
    public static function create(?string $value): self
    {
        $instance = new self($value);
        $instance->validate();
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