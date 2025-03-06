<?php

namespace App\MyDefined\ValueObject\Client;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class ClientCodeValueObject extends ValueObject
{
    static $ITEM_NAME = 'クライアントコード';

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
        $msg .= $this->match('/^[0-9]{5}-[0-9]{3}$/', '数字5桁 + ハイフン(-) + 数字3桁');
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>