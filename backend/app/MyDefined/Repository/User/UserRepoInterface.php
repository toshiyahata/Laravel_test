<?php

namespace App\MyDefined\Repository\User;

use App\MyDefined\Entity\User\UserEntity;
use App\MyDefined\ValueObject\User\UserEmailValueObject;

interface UserRepoInterface{
    public function getUserInfo(UserEmailValueObject $email): UserEntity;
}
?>