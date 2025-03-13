<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class SystemNameValueObject extends ValueObject
{
    static $ITEM_NAME = 'システム名';

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
        $msg .= $this->length(50);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>