<?php

namespace App\MyDefined\Entity\Campaign;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\MyDefined\DomainService\Campaign\OrderService;
use App\MyDefined\Entity\Entity;
use App\MyDefined\Entity\Master\ClientEntity;
use App\MyDefined\Entity\Order\OrderEntity;
use App\MyDefined\Entity\Organization\DepartmentEntity;
use App\MyDefined\Entity\User\UserEntity;
use App\MyDefined\ValueObject\Campaign\CampaignName1ValueObject;
use App\MyDefined\ValueObject\Campaign\CampaignName2ValueObject;

use App\MyDefined\ValueObject\Order\OrderNumberValueObject;
use App\MyDefined\ValueObject\Order\ClientOrderNumberValueObject;
use App\MyDefined\ValueObject\Order\DeadlineValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryIdValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryNameValueObject;
use App\MyDefined\ValueObject\Order\OrderDateValueObject;
use App\MyDefined\ValueObject\SystemNameValueObject;

final class CampaignEntity extends Entity{
    public $campaignName1;
    public $campaignName2;
    public $orderDate;
    public $deadline;
    public $orderCategoryId;
    public $orderCategoryName;
    public $clientOrderNumber;
    public $locationCode;
    public $locationName;
    public $departmentCode;
    public $departmentName;
    public $salesManagerId;
    public $salesManagerName;
    public $clientCode;
    public $clientName;
    public $managerId;
    public $managerName;
    public $systemName;
    public $orders;

    private function __construct()
    {

    }

    public static function create(
        CampaignName1ValueObject $campaignName1,
        CampaignName2ValueObject $campaignName2,
        OrderDateValueObject $orderDate,
        DeadlineValueObject $deadline,
        ClientEntity $client,
        ClientOrderNumberValueObject $clientOrderNumber,
        DepartmentEntity $department,
        UserEntity $salesManager,
        UserEntity $manager,
        OrderCategoryIdValueObject $orderCategoryId,
        OrderCategoryNameValueObject $orderCategoryName,
        SystemNameValueObject $systemName,
        OrderEntity ...$orders
    ): CampaignEntity{
        //バリエーション
        $campaignName1->validate($required = true);
        $campaignName2->validate($required = false);
        $orderDate->validate($required = true);
        $deadline->validate($required = true);
        $client->clientCode->validate($required = true);
        $client->clientName->validate($required = true);
        $clientOrderNumber->validate($required = false);
        $department->locationCode->validate($required = true);
        $department->locationName->validate($required = true);
        $department->departmentCode->validate($required = true);
        $department->departmentName->validate($required = true);
        $salesManager->userId->validate($required = true);
        $salesManager->userName->validate($required = true);
        $manager->userId->validate($required = true);
        $manager->userName->validate($required = true);
        $orderCategoryId->validate($required = true);
        $orderCategoryName->validate($required = true);
        $systemName->validate($required = true);

        $orderNumbers = collect($orders)->map(function($order){
            $order->orderNumber->validate($required = true);
            $order->contentName->validate($required = true);
            $order->orderQuantity->validate($required = false);

            return $order->orderNumber->v();
        });
        //すでにキャンペーンに登録されている受注がないか
        OrderService::checkCampaign($orderNumbers);
        //既に売立済みの受注がないか
        OrderService::checkSales($orderNumbers);

        $selfEntity = new self();
        $selfEntity->campaignName1 = $campaignName1;
        $selfEntity->campaignName2 = $campaignName2;
        $selfEntity->orderDate = $orderDate;
        $selfEntity->deadline = $deadline;
        $selfEntity->orderCategoryId = $orderCategoryId;
        $selfEntity->orderCategoryName = $orderCategoryName;
        $selfEntity->clientOrderNumber = $clientOrderNumber;
        $selfEntity->locationCode = $department->locationCode;
        $selfEntity->locationName = $department->locationName;
        $selfEntity->departmentCode = $department->departmentCode;
        $selfEntity->departmentName = $department->departmentName;
        $selfEntity->salesManagerId = $salesManager->userId;
        $selfEntity->salesManagerName = $salesManager->userName;
        $selfEntity->clientCode = $client->clientCode;
        $selfEntity->clientName = $client->clientName;
        $selfEntity->managerId = $manager->userId;
        $selfEntity->managerName = $manager->userName;
        $selfEntity->systemName = $systemName;
        $selfEntity->orders = $orders;
        
        return $selfEntity;
    }


}