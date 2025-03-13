<?php

namespace App\MyDefined\Entity\Organization;

use App\MyDefined\Entity\Entity;
use App\MyDefined\ValueObject\Organization\DepartmentCodeValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\MyDefined\ValueObject\Organization\LocationCodeValueObject;
use App\MyDefined\ValueObject\Organization\LocationNameValueObject;

final class DepartmentEntity extends Entity{
    public $departmentCode;
    public $departmentName;
    public $locationCode;
    public $locationName;

    private function __construct()
    {
        
    }

    public static function reconstructFromRepository(
        DepartmentCodeValueObject $departmentCode,
        DepartmentNameValueObject $departmentName,
        LocationCodeValueObject $locationCode,
        LocationNameValueObject $locationName
    ): DepartmentEntity {
        $selfEntity = new self();
        $selfEntity->departmentCode = $departmentCode;
        $selfEntity->departmentName = $departmentName;
        $selfEntity->locationCode = $locationCode;
        $selfEntity->locationName = $locationName;

        return $selfEntity;
    }
}