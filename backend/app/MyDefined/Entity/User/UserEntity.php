<?php

namespace App\MyDefined\Entity\User;

use App\MyDefined\Entity\Entity;
use App\MyDefined\ValueObject\User\UserEmailValueObject;
use App\MyDefined\ValueObject\User\UserIdValueObject;
use App\MyDefined\ValueObject\User\UserNameValueObject;

final class UserEntity extends Entity{
    public $userName;
    public $userEmail;

    private function __construct()
    {
        
    }

    public static function reconstructFromRepository(
        UserIdValueObject $userId,
        UserNameValueObject $userName,
        UserEmailValueObject $userEmail
    ): UserEntity {
        $selfEntity = new self();
        $selfEntity->id = $userId;
        $selfEntity->userName = $userName;
        $selfEntity->userEmail = $userEmail;
        return $selfEntity;
    }
}
?>