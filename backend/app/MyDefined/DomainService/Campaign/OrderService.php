<?php

namespace App\MyDefined\DomainService\Campaign;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\Models\Campaign\CampaignElement;
use App\Models\Order\SalesDetail;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;

final class OrderService
{
    private function __construct()
    {
        
    } 

    public static function checkCampaign($orderNumbers): void
    {

        $CampaignElement = CampaignElement::whereIn('紐付番号', $orderNumbers)
        ->where('削除フラグ', 0)
        ->first();

        if($CampaignElement){
            throw new DatabaseExistanceErrorResponseException('既にキャンペーンに登録されている受注があります。');

        }
    }

    public static function checkSales($orderNumbers): void
    {
        $SalesDetail = SalesDetail::whereIn('受注番号', $orderNumbers)
        ->where('削除フラグ', 0)
        ->first();

        if($SalesDetail){
            throw new DatabaseExistanceErrorResponseException('既に売立されている受注があります。');

        }

    }
}
