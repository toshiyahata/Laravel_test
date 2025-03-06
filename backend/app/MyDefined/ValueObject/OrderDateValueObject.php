<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class OrderDateValueObject extends ValueObject
{
    static $ITEM_NAME = '受注日';

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
        $msg .= $this->required();
        $msg .= $this->datetime();
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>