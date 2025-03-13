<?php

namespace App\MyDefined\ValueObject\Order;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class OrderDateValueObject extends ValueObject
{
    static $ITEM_NAME = '受注日';

    /**
     * @param string $value
     */
    public static function create(?string $value): self
    {
        $instance = new self($value);
        return $instance;
    }

    public function validate($required, $msg = '')
    {
        if ($required) {
            $msg .= $this->required();
        }
        $msg .= $this->datetime();
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>