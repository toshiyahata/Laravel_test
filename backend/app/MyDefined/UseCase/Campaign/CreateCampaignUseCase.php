<?php

namespace APP\MyDefined\UseCase\Campaign;

use App\MyDefined\Repository\Campaign\CampaignRepoInterface;
use App\MyDefined\Repository\User\UserRepoInterface;
use App\MyDefined\ValueObject\Campaign\CampaignName1ValueObject;
use App\MyDefined\ValueObject\Campaign\CampaignName2ValueObject;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;
use App\MyDefined\ValueObject\Order\ClientOrderNumberValueObject;
use App\MyDefined\ValueObject\Order\DeadlineValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\MyDefined\ValueObject\User\UserEmailValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryValueObject;
use App\MyDefined\ValueObject\Order\OrderDateValueObject;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;

final class CreateCampaignUseCase
{
    private $repository;
    private $clientRepository;
    private $userRepository;

    public function __construct(
        // CampaignRepoInterface $repository
        UserRepoInterface $userRepository
    )
    {
        // $this->repository = $repository;   
        $this->userRepository = $userRepository;
    }

    public function execute(
        CampaignName1ValueObject $campaignName1,
        CampaignName2ValueObject $campaignName2,
        OrderDateValueObject $orderDate,
        DeadlineValueObject $deadline,
        ClientOrderNumberValueObject $clientrOrderNumber,
        ClientCodeValueObject $clientCode,
        DepartmentNameValueObject $department,
        UserEmailValueObject $salesManager,
        UserEmailValueObject $manager,
        OrderCategoryValueObject $orderCategory,
        $orderNumbers
    )
    {
        // UserEntityの取得
        $user = $this->userRepository->getUserbyEmail($salesManager);
        // ClientEntityの取得

        // CampaignEntityの生成

        // 永続化処理(DB登録)

        return $user;
    }
}