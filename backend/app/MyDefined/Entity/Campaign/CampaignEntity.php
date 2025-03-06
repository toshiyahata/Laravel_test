<?php

namespace App\MyDefined\Entity\Campaign;

use App\MyDefined\Entity\Entity;

use App\MyDefined\ValueObject\CampaignNameValueObject;
use App\MyDefined\ValueObject\ClientCodeValueObject;
use App\MyDefined\ValueObject\DepartmentNameValueObject;
use App\MyDefined\ValueObject\ManagerEmailValueObject;
use App\MyDefined\ValueObject\ExecTimeValueObject;
use App\MyDefined\ValueObject\OrderCategoryValueObject;
use App\MyDefined\ValueObject\OrderNumberValueObject;


final class CampaignEntity extends Entity{
    // public $clientCode;

    private function __construct()
    {
        
    }

    // public static function create(
    //     ClientCodeValueObject $clientCode
    // ):ClientEntity{
    //     $selfEntity = new self();
    //     $selfEntity->clientCode = $clientCode;
    //     return $selfEntity;
    // }
}