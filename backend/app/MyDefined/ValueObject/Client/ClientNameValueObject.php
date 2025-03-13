<?php

namespace App\MyDefined\ValueObject\Client;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class ClientNameValueObject extends ValueObject
{
    static $ITEM_NAME = '取引先略称';

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
        $msg .= $this->length(30);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>