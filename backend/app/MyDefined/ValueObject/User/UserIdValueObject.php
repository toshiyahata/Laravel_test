<?php

namespace App\MyDefined\ValueObject\User;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class UserIdValueObject extends ValueObject
{
    static $ITEM_NAME = 'ユーザーID';

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
        $msg .= $this->required();
        $msg .= $this->length(10);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>