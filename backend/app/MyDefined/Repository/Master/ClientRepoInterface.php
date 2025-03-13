<?php

namespace App\MyDefined\Repository\Master;

use App\MyDefined\Entity\Master\ClientEntity;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;

interface ClientRepoInterface{
    public function getClientbyId(ClientCodeValueObject $clientCode): ClientEntity;
}
?>