<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\MyDefined\UseCase\Campaign\CreateCampaignUseCase;

use App\MyDefined\ValueObject\Campaign\CampaignName1ValueObject;
use App\MyDefined\ValueObject\Campaign\CampaignName2ValueObject;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;
use App\MyDefined\ValueObject\Order\ClientOrderNumberValueObject;
use App\MyDefined\ValueObject\Order\DeadlineValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryNameValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\MyDefined\ValueObject\Order\OrderDateValueObject;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;
use App\MyDefined\ValueObject\SystemNameValueObject;
use App\MyDefined\ValueObject\User\UserEmailValueObject;
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
        $clientOrderNumber = ClientOrderNumberValueObject::create('client_order_number');
        $clientCode = ClientCodeValueObject::create($request->input('client_code'));
        $department = DepartmentNameValueObject::create($request->input('department_name'));
        $sales = USerEmailValueObject::create($request->input('email_sales'));
        $manager = UserEmailValueObject::create($request->input('email_manager'));
        $orderCategory = OrderCategoryNameValueObject::create($request->input('order_category_name'));
        $systemName = SystemNameValueObject::create($request->input('system_name'));
        $orderNumbers = collect($request->input('order_numbers'))->map(function($orderNumber){
            return OrderNumberValueObject::create($orderNumber);
        });

        $result = $UseCase->execute(
            $campaignName1,
            $campaignName2,
            $orderDate,
            $deadline,
            $clientOrderNumber,
            $clientCode,
            $department,
            $sales,
            $manager,
            $orderCategory,
            $systemName,
            ...$orderNumbers
        );

        return new JsonResponse($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}