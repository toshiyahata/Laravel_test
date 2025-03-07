<?php

namespace App\MyDefined\Repository\User;

use App\MyDefined\Entity\User\UserEntity;
use App\MyDefined\ValueObject\User\UserEmailValueObject;

interface UserRepoInterface{
    public function getUserbyEmail(UserEmailValueObject $email): UserEntity;
}
?>