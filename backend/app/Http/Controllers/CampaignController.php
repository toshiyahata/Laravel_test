<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\MyDefined\UseCase\Master\CreateCampaignUseCase;

use App\MyDefined\ValueObject\CampaignNameValueObject;
use App\MyDefined\ValueObject\ClientCodeValueObject;
use App\MyDefined\ValueObject\DepartmentNameValueObject;
use App\MyDefined\ValueObject\ManagerEmailValueObject;
use App\MyDefined\ValueObject\ExecTimeValueObject;
use App\MyDefined\ValueObject\OrderCategoryValueObject;
use App\MyDefined\ValueObject\OrderNumberValueObject;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function createCampaign(
        Request $request,
        CreateCampaignUseCase $UseCase
    )
    {
        $campaignName = CampaignNameValueObject::create($request->input('campaign_name'));
        $orderDate = ExecTimeValueObject::create($request->input('order_date'));
        $deadline = ExecTimeValueObject::create($request->input('deadline'));
        $clientCode = ClientCodeValueObject::create($request->input('client_code'));
        $department = DepartmentNameValueObject::create($request->input('department_name'));
        $manager = ManagerEmailValueObject::create($request->input('manager_email'));
        $orderCategory = OrderCategoryValueObject::create($request->input('order_category'));
        $orderNumbers = [];
        foreach($request->input('order_numbers') as $orderNumber){
            array_push($orderNumbers, OrderNumberValueObject::create($orderNumber));
        }

        $result = $UseCase->execute($campaignName, $orderDate, $deadline, $clientCode, $department, 
                                    $manager, $orderCategory, $orderNumbers);

        return new JsonResponse($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}