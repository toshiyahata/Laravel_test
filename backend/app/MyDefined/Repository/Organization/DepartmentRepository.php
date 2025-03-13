<?php

namespace App\MyDefined\Repository\Organization;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\Models\Master\Department;
use App\MyDefined\Entity\Organization\DepartmentEntity;
use App\MyDefined\ValueObject\Organization\DepartmentCodeValueObject;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;
use App\MyDefined\ValueObject\Organization\LocationCodeValueObject;
use App\MyDefined\ValueObject\Organization\LocationNameValueObject;

final class DepartmentRepository implements DepartmentRepoInterface{
    public function getDepartmentbyName(DepartmentNameValueObject $departmentName): DepartmentEntity
    {
        $Department = Department::where('部門名', $departmentName->v())
            ->where('削除フラグ', 0)
            ->first();

        if(!$Department){
            throw new DatabaseExistanceErrorResponseException('指定の部門: ' . $departmentName->getName() . 'は存在しません。');
        }
        return DepartmentEntity::reconstructFromRepository(
            DepartmentCodeValueObject::create($Department->部門コード),
            DepartmentNameValueObject::create($Department->部門名),
            LocationCodeValueObject::create($Department->事業所コード),
            LocationNameValueObject::create($Department->locationName->事業所名)
        );
    }
}
?>