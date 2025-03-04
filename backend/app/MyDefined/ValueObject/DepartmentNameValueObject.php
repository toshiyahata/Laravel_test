<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class DepartmentNameValueObject extends ValueObject
{
    static $ITEM_NAME = '部門名';

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
        $msg .= $this->length(30);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>