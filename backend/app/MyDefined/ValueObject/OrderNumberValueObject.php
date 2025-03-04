<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class OrderNumberValueObject extends ValueObject
{
    static $ITEM_NAME = '受注番号';

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
        $msg .= $this->match('/^B[0-9]{8}$/', 'B + 数字8桁');
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>