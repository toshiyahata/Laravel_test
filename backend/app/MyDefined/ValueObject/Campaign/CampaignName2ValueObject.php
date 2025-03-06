<?php

namespace App\MyDefined\ValueObject\Campaign;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class CampaignName2ValueObject extends ValueObject
{
    static $ITEM_NAME = 'キャンペーン名2';

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
        $msg .= $this->length(50);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>