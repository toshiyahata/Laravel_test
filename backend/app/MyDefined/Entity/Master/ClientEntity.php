<?php

namespace App\MyDefined\Entity\Master;

use App\MyDefined\Entity\Entity;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;
use App\MyDefined\ValueObject\Client\ClientNameValueObject;

final class ClientEntity extends Entity{
    public $clientCode;
    public $clientName;

    private function __construct()
    {
        
    }

    public static function reconstructFromRepository(
        ClientCodeValueObject $clientCode,
        ClientNameValueObject $clientName,
    ): ClientEntity {
        $selfEntity = new self();
        $selfEntity->clientCode = $clientCode;
        $selfEntity->clientName = $clientName;

        return $selfEntity;
    }
}