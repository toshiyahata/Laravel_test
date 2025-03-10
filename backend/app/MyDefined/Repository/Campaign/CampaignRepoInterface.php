<?php

namespace App\MyDefined\Repository\Campaign;

use App\MyDefined\Entity\Campaign\CampaignEntity;

interface CampaignRepoInterface{
    public function factoryOrder();
    public function getCPNo();
    public function create();//: CampaignEntity;
    public function store();
}
?>