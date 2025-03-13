<?php

namespace App\MyDefined\Repository\Campaign;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\Exceptions\DatabaseStoreErrorResponseException;

use App\Models\Campaign\CampaignBasic;
use App\Models\Campaign\CampaignElement;
use App\Models\Order\OrderBasic;
use App\Models\Master\Number;

use App\MyDefined\Entity\Campaign\CampaignEntity;
use App\MyDefined\Entity\Order\OrderEntity;

use App\MyDefined\ValueObject\Campaign\CampaignNumberValueObject;
use App\MyDefined\ValueObject\Order\ContentNameValueObject;
use App\MyDefined\ValueObject\Order\OrderNumberValueObject;
use App\MyDefined\ValueObject\Order\OrderQuantityValueObject;
use Illuminate\Support\Facades\DB;

final class CampaignRepository implements CampaignRepoInterface{
    public function getOrderbyId(OrderNumberValueObject ...$orderNumbers): array
    {
        $Orders = collect($orderNumbers)->map(function(OrderNumberValueObject $orderNumber){
            $Order = OrderBasic::find($orderNumber->v());

            if(!$Order){
                throw new DatabaseExistanceErrorResponseException('指定の受注' . $orderNumber->v() . 'が存在しません。');
            }
            return $Order;
        });

        $orders = collect($Orders)->map(function($Order){
            return OrderEntity::reconstructFromRepository(
                OrderNumberValueObject::create($Order->受注番号),
                ContentNameValueObject::create($Order->製品名1 . $Order->製品名2),
                OrderQuantityValueObject::create($Order->受注数量)
            );
        });
        return $orders->all();
    }

    public function store(CampaignEntity $campaign): CampaignNumberValueObject
    {
        $dt = now();
        DB::beginTransaction();
        try{
            //CPNo発番
            $Number = Number::lockForUpdate()->find('CP');
            $Number->現在 = $Number->現在 + 1;
            $Number->更新回数 = $Number->更新回数 + 1;
            $Number->更新日 = $dt;
            $Number->更新担当者名 = $campaign->salesManagerName->v();
            $Number->更新担当者コード = $campaign->salesManagerId->v();
            $Number->更新端末コード = $campaign->systemName->v();
            $Number->save();

            $CPNo = CampaignNumberValueObject::create('CP' . sprintf('%06d', $Number->現在));

            // Mキャンペーン_基本 にInsert
            $CampaignBase = new CampaignBasic();
            $CampaignBase->キャンペーン番号 = $CPNo->v();
            $CampaignBase->キャンペーン名1 = $campaign->campaignName1->v();
            $CampaignBase->キャンペーン名2 = $campaign->campaignName2->v();
            $CampaignBase->キャンペーンフラグ = -1;
            $CampaignBase->受注区分 = 0;
            $CampaignBase->受注区分名 = 0;
            $CampaignBase->主要カテゴリ区分 = $campaign->orderCategoryId->v();
            $CampaignBase->主要カテゴリ名 = $campaign->orderCategoryName->v();
            $CampaignBase->受注日 = $campaign->orderDate->v();
            $CampaignBase->納期 = $campaign->deadline->v();
            $CampaignBase->先方注文番号 = $campaign->clientOrderNumber->v();
            $CampaignBase->事業所コード = $campaign->locationCode->v();
            $CampaignBase->事業所親コード = '00000';
            $CampaignBase->事業所子コード = $campaign->locationCode->v();
            $CampaignBase->事業所名 = $campaign->locationName->v();
            $CampaignBase->部門コード = $campaign->departmentCode->v();
            $CampaignBase->部門名 = $campaign->departmentName->v();
            $CampaignBase->営業担当者コード = $campaign->salesManagerId->v();
            $CampaignBase->営業担当者名 = $campaign->salesManagerName->v();
            $CampaignBase->得意先親コード = substr($campaign->clientCode->v(), 0, 5);
            $CampaignBase->得意先子コード = substr($campaign->clientCode->v(), 6, 8);
            $CampaignBase->得意先コード = $campaign->clientCode->v();
            $CampaignBase->得意先略称 = $campaign->clientName->v();
            $CampaignBase->作成日 = $dt;
            $CampaignBase->作成担当者コード = $campaign->managerId->v();
            $CampaignBase->作成担当者名 = $campaign->managerName->v();
            $CampaignBase->作成端末コード = $campaign->systemName->v();
            $CampaignBase->更新日 = $dt;
            $CampaignBase->更新担当者コード = $campaign->managerId->v();
            $CampaignBase->更新担当者名 = $campaign->managerName->v();
            $CampaignBase->更新端末コード = $campaign->systemName->v();
            $CampaignBase->save();

            // Mキャンペーン_構成 にInsert
            foreach($campaign->orders as $index => $order){
                $CampaignElement = new CampaignElement();
                $CampaignElement->キャンペーン番号 = $CPNo->v();
                $CampaignElement->行番号 = $index + 1;
                $CampaignElement->種類区分 = 1;
                $CampaignElement->種類区分名= '受注';
                $CampaignElement->紐付番号 = $order->orderNumber->v();
                $CampaignElement->品名 = $order->contentName->v();
                $CampaignElement->数量 = $order->orderQuantity->v();;
                $CampaignElement->作成日 = $dt;
                $CampaignElement->作成担当者コード = $campaign->managerId->v();
                $CampaignElement->作成担当者名 = $campaign->managerName->v();
                $CampaignElement->作成端末コード = $campaign->systemName->v();
                $CampaignElement->更新日 = $dt;
                $CampaignElement->更新担当者コード = $campaign->managerId->v();
                $CampaignElement->更新担当者名 = $campaign->managerName->v();
                $CampaignElement->更新端末コード = $campaign->systemName->v();
                $CampaignElement->save();
            };

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new DatabaseStoreErrorResponseException($e->getMessage());
        }

        return $CPNo;
    }
}
