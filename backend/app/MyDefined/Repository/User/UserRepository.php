<?php

namespace App\MyDefined\Repository\User;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\Exceptions\DatabaseStoreErrorResponseException;
use App\Models\User\UserAMS;
use App\Models\User\UserSquare;
use App\MyDefined\Entity\User\UserEntity;
use App\MyDefined\ValueObject\User\UserEmailValueObject;
use App\MyDefined\ValueObject\User\UserIdValueObject;
use App\MyDefined\ValueObject\User\UserNameValueObject;

final class UserRepository implements UserRepoInterface{
    public function getUserInfo(UserEmailValueObject $email): UserEntity
    {

        $User = UserAMS::where('メールアカウント', $email->v())->first();
        if(!$User){
            throw new DatabaseExistanceErrorResponseException('指定の' . $email->getName() . 'は存在しません。');
        }

        return UserEntity::reconstructFromRepository(
            UserIdValueObject::create($User->SquareID),
            UserNameValueObject::create($User->姓 . $User->名),
            UserEmailValueObject::create($User->メールアカウント)
        );
        return $User;
    }
}
?>