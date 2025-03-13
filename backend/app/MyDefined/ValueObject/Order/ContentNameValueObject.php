<?php

namespace App\MyDefined\ValueObject\Order;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class ContentNameValueObject extends ValueObject
{
    static $ITEM_NAME = '製品名';

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
        $msg .= $this->length(100);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>