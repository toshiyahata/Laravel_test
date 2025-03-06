<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\MyDefined\UseCase\Master\CreateCampaignUseCase;
use App\MyDefined\ValueObject\CampaignName1ValueObject;
use App\MyDefined\ValueObject\CampaignName2ValueObject;
use App\MyDefined\ValueObject\ClientCodeValueObject;
use App\MyDefined\ValueObject\DeadlineValueObject;
use App\MyDefined\ValueObject\DepartmentNameValueObject;
use App\MyDefined\ValueObject\ManagerEmailValueObject;
use App\MyDefined\ValueObject\OrderCategoryValueObject;
use App\MyDefined\ValueObject\OrderDateValueObject;
use App\MyDefined\ValueObject\OrderNumberValueObject;
use App\MyDefined\ValueObject\SupplierOrderNumberValueObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function createCampaign(
        Request $request,
        CreateCampaignUseCase $UseCase
    )
    {
        $campaignName1 = CampaignName1ValueObject::create($request->input('campaign_name1'));
        $campaignName2 = CampaignName2ValueObject::create($request->input('campaign_name2'));
        $orderDate = OrderDateValueObject::create($request->input('order_date'));
        $deadline = DeadlineValueObject::create($request->input('deadline'));
        $supplierOrderNumber = SupplierOrderNumberValueObject::create('supplier_order_number');
        $clientCode = ClientCodeValueObject::create($request->input('client_code'));
        $department = DepartmentNameValueObject::create($request->input('department_name'));
        $sales = ManagerEmailValueObject::create($request->input('email_manager'));
        $manager = ManagerEmailValueObject::create($request->input('email_manager'));
        $orderCategory = OrderCategoryValueObject::create($request->input('order_category'));
        $orderNumbers = collect($request->input('order_numbers'))->map(function($orderNumber){
            return OrderNumberValueObject::create($orderNumber);
        });

        $result = $UseCase->execute(
            $campaignName1,
            $campaignName2,
            $orderDate,
            $deadline,
            $supplierOrderNumber,
            $clientCode,
            $department,
            $sales,
            $manager,
            $orderCategory,
            $orderNumbers
        );

        return new JsonResponse($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}