<?php

namespace App\MyDefined\Repository\Organization;

use App\MyDefined\Entity\Organization\DepartmentEntity;
use App\MyDefined\ValueObject\Organization\DepartmentNameValueObject;

interface DepartmentRepoInterface{
    public function getDepartmentbyName(DepartmentNameValueObject $departName): DepartmentEntity;
}
?>