<?php

namespace App\MyDefined\ValueObject\Organization;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class LocationCodeValueObject extends ValueObject
{
    static $ITEM_NAME = '事業所コード';

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
        $msg .= $this->length(3);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>