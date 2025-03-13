<?php

namespace APP\MyDefined\UseCase\Campaign;

use App\MyDefined\Repository\Campaign\CampaignRepoInterface;
use App\MyDefined\Repository\Master\ClientRepoInterface;
use App\MyDefined\Repository\Organization\DepartmentRepoInterface;
use App\MyDefined\Repository\User\UserRepoInterface;
use App\MyDefined\Repository\Master\OrderCategoryRepoInterface;

use App\MyDefined\ValueObject\Campaign\CampaignName1ValueObject;
use App\MyDefined\ValueObject\Campaign\CampaignName2ValueObject;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;
use App\MyDefined\ValueObject\Order\ClientOrderNumberValueObject;
use App\MyDefined\ValueObject\Order\DeadlineValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\MyDefined\ValueObject\User\UserEmailValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryNameValueObject;
use App\MyDefined\ValueObject\Order\OrderDateValueObject;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;
use APP\MyDefined\DomainService\getCurrentDateTime;
use App\MyDefined\Entity\Campaign\CampaignEntity;
use App\MyDefined\ValueObject\SystemNameValueObject;

final class CreateCampaignUseCase
{
    private $campaignRepository;

    private $userRepository;
    private $clientRepository;
    private $departmentRepository;
    private $orderCategoryRepository;

    public function __construct(
        CampaignRepoInterface $campaignRepository,
        UserRepoInterface $userRepository,
        ClientRepoInterface $clientRepository,
        DepartmentRepoInterface $departmentRepository,
        OrderCategoryRepoInterface $orderCategoryRepository
    )
    {
        $this->campaignRepository = $campaignRepository;   
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->departmentRepository = $departmentRepository;
        $this->orderCategoryRepository = $orderCategoryRepository;
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
        OrderCategoryNameValueObject $orderCategoryName,
        SystemNameValueObject $systemName,
        OrderNumberValueObject ...$orderNumbers
    )
    {
        $client = $this->clientRepository->getClientbyId($clientCode);
        $department = $this->departmentRepository->getDepartmentbyName($departmentName);
        $user_sales = $this->userRepository->getUserbyEmail($salesManager);
        $user_manager = $this->userRepository->getUserbyEmail($manager);
        $order_category_id = $this->orderCategoryRepository->getOrderCategoryName($orderCategoryName, $departmentName);
        
        $campaign = CampaignEntity::create(
            $campaignName1,
            $campaignName2,
            $orderDate,
            $deadline,
            $client,
            $clientrOrderNumber,
            $department, 
            $user_sales,
            $user_manager,
            $order_category_id,
            $orderCategoryName,
            $systemName,
            ...$this->campaignRepository->getOrderbyId(...$orderNumbers)
        );

        $CPNo = $this->campaignRepository->store($campaign);

        return $CPNo;
    }
}
?>