<?php

namespace App\MyDefined\ValueObject\Campaign;

use App\Exceptions\InvalidValueErrorResponseException;
use App\MyDefined\ValueObject\ValueObject;

class CampaignNumberValueObject extends ValueObject
{
    static $ITEM_NAME = 'CPNo';

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
        $msg .= $this->match('/^CP[0-9]{6}$/', 'CP + 数字6桁');
        if ($msg) throw new InvalidValueErrorResponseException($msg);
        return;
    }

}
?>