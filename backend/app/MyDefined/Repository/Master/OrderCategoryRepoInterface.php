<?php

namespace APP\MyDefined\Repository\Master;

use App\MyDefined\ValueObject\Order\OrderCategoryIdValueObject;
use App\MyDefined\ValueObject\Order\OrderCategoryNameValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;

interface OrderCategoryRepoInterface{
    public function getOrderCategoryName(OrderCategoryNameValueObject $OrderCategoryName
                                    , DepartmentNameValueObject $DepartmentName): OrderCategoryIdValueObject;
}
?>