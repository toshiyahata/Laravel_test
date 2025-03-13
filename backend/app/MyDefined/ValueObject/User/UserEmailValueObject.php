<?php

namespace App\MyDefined\ValueObject\User;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class UserEmailValueObject extends ValueObject
{
    static $ITEM_NAME = 'メールアドレス';

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
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>