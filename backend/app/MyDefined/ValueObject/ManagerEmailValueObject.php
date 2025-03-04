<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class ManagerEmailValueObject extends ValueObject
{
    static $ITEM_NAME = '営業担当者';

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

        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>