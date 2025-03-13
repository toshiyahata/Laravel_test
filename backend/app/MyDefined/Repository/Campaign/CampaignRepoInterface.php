<?php

namespace App\MyDefined\Repository\Campaign;

use App\MyDefined\Entity\Campaign\CampaignEntity;
use App\MyDefined\Entity\Order\OrderEntity;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;

interface CampaignRepoInterface{
    public function getOrderbyId(OrderNumberValueObject ...$orderNumber):array;
    public function store(CampaignEntity $campaign);
}
?>