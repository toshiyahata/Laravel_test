<?php

namespace App\MyDefined\ValueObject\Organization;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class DepartmentCodeValueObject extends ValueObject
{
    static $ITEM_NAME = '部門コード';

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
        $msg .= $this->length(10);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>