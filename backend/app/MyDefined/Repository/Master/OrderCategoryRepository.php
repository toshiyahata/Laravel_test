<?php

namespace App\MyDefined\Repository\Master;

use App\Models\Master\OrderCategory;

use App\MyDefined\ValueObject\Order\OrderCategoryNameValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryIdValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\Exceptions\DatabaseExistanceErrorResponseException;

final class OrderCategoryRepository implements OrderCategoryRepoInterface{
    public function getOrderCategoryName(OrderCategoryNameValueObject $OrderCategoryName
                                     , DepartmentNameValueObject $DepartmentName): OrderCategoryIdValueObject
    {
        $OrderCategory = OrderCategory::where('主要カテゴリ名', $OrderCategoryName->v())
            ->where('部門名', $DepartmentName->v())
            ->where('削除フラグ', 0)
            ->first();
        if(!$OrderCategory){
            throw new DatabaseExistanceErrorResponseException('指定の主要カテゴリ区分' . 
                $OrderCategoryName->v() . $DepartmentName->v() .'は存在しません。');
        }

        return OrderCategoryIdValueObject::create($OrderCategory->主要カテゴリ区分);
    }
}
?>