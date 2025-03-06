<?php

namespace APP\MyDefined\UseCase\Campaign;

use App\MyDefined\Repository\Campaign\CampaignRepoInterface;

use App\MyDefined\ValueObject\CampaignName1ValueObject;
use App\MyDefined\ValueObject\CampaignName2ValueObject;
use App\MyDefined\ValueObject\ClientCodeValueObject;
use App\MyDefined\ValueObject\ClientOrderNumberValueObject;
use App\MyDefined\ValueObject\DeadlineValueObject;
use App\MyDefined\ValueObject\DepartmentNameValueObject;
use App\MyDefined\ValueObject\ManagerEmailValueObject;
use App\MyDefined\ValueObject\OrderCategoryValueObject;
use App\MyDefined\ValueObject\OrderDateValueObject;
use App\MyDefined\ValueObject\OrderNumberValueObject;

final class CreateCampaignUseCase
{
    private $repository;
    // private $clientRepository;
    // private $userRepository;

    public function __construct(
        // CampaignRepoInterface $repository
    )
    {
        // $this->repository = $repository;   
    }

    public function execute(
        CampaignName1ValueObject $campaignName1,
        CampaignName2ValueObject $campaignName2,
        OrderDateValueObject $orderDate,
        DeadlineValueObject $deadline,
        ClientOrderNumberValueObject $clientrOrderNumber,
        ClientCodeValueObject $clientCode,
        DepartmentNameValueObject $department,
        ManagerEmailValueObject $salesManager,
        ManagerEmailValueObject $manager,
        OrderCategoryValueObject $orderCategory,
        $orderNumbers
    )
    {
        // UserEntityの取得

        // ClientEntityの取得

        // CampaignEntityの生成

        // 永続化処理(DB登録)

        return $orderNumbers;
    }
}