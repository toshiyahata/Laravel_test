<?php

namespace App\MyDefined\ValueObject;

use App\Exceptions\InvalidValueErrorResponseException;

class CampaignName1ValueObject extends ValueObject
{
    static $ITEM_NAME = 'キャンペーン名1';

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
        $msg .= $this->length(100);
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>