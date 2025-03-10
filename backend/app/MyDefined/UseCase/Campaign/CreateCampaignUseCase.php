<?php

namespace APP\MyDefined\UseCase\Campaign;

use App\MyDefined\Repository\Campaign\CampaignRepoInterface;
use App\MyDefined\Repository\Master\ClientRepoInterface;
use App\MyDefined\Repository\Organization\DepartmentRepoInterface;
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
    private $campaignRepository;
    private $userRepository;
    private $clientRepository;
    private $departmentRepository;

    public function __construct(
        CampaignRepoInterface $campaignRepository,
        UserRepoInterface $userRepository,
        ClientRepoInterface $clientRepository,
        DepartmentRepoInterface $departmentRepository
    )
    {
        $this->campaignRepository = $campaignRepository;   
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function execute(
        CampaignName1ValueObject $campaignName1,
        CampaignName2ValueObject $campaignName2,
        OrderDateValueObject $orderDate,
        DeadlineValueObject $deadline,
        ClientOrderNumberValueObject $clientrOrderNumber,
        ClientCodeValueObject $clientCode,
        DepartmentNameValueObject $departmentName,
        UserEmailValueObject $salesManager,
        UserEmailValueObject $manager,
        OrderCategoryValueObject $orderCategory,
        $orderNumbers
    )
    {
        $user_sales = $this->userRepository->getUserbyEmail($salesManager);
        $user_manager = $this->userRepository->getUserbyEmail($manager);
        $client = $this->clientRepository->getClientbyClientCode($clientCode);
        $department = $this->departmentRepository->getDepartmentbyName($departmentName);
        // $orders = $this->campaignRepository->factoryOrder();
        // $campaign = $this->campaignRepository->create();

        // 永続化処理(DB登録)

        return $department;
    }
}