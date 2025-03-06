<?php

namespace App\MyDefined\Repository\Campaign;

use App\MyDefined\Entity\Campaign\CampaignEntity;

interface CampaignRepoInterface{
    public function store(CampaignEntity $campaign);
}
?>