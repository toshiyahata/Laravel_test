<?php

namespace App\MyDefined\Repository\Master;

use App\MyDefined\Entity\Master\CampaignEntity;

interface CampaignRepoInterface{
    public function store(CampaignEntity $campaign);
}
?>