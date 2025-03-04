<?php

namespace App\MyDefined\Entity;

use App\Exceptions\AlreadyDeletedErrorResponseException;
use App\Exceptions\InvalidOperationErrorResponseException;
use App\Exceptions\InvalidValueErrorResponseException;
use App\Exceptions\RequiredValueErrorResponseException;
use App\MyDefined\Entity\User\UserEntity;
use App\MyDefined\ValueObject\ExecTimeValueObject;
use App\MyDefined\ValueObject\IsDeletedValueObject;
use Carbon\Carbon;
use stdClass;
use Illuminate\Support\Str;

class Entity{
    public $id;
    public $creatorId;
    public $creatorName;
    public $createdAt;
    public $updaterId;
    public $updaterName;
    public $updatedAt;
    public $deleterId;
    public $deleterName;
    public $deletedAt;
    public $isDeleted;

    private function __construct()
    {

    }

    public function entityToResponse(){
        $response = new stdClass;
        foreach(get_object_vars($this) as $property => $valueObject){
            if($valueObject != null){
                $snake_property = Str::snake($property);
                $response->$snake_property = $valueObject->value ?? $valueObject;
            }
        }
        return $response;
    }

    public final function setCreator(UserEntity $creator): void
    {
        $this->creatorId = $creator->id;
        $this->creatorName = $creator->userName;
        $this->createdAt = ExecTimeValueObject::create(Carbon::now()->format('Y-m-d H:i:s'));
        return;
    }

    public final function changeUpdater(UserEntity $updater): void
    {
        $this->updaterId = $updater->id;
        $this->updaterName = $updater->userName;
        $this->updatedAt = ExecTimeValueObject::create(Carbon::now()->format('Y-m-d H:i:s'));
        return;
    }

    public final function changeDeleter(UserEntity $deleter): void
    {
        $this->deleterId = $deleter->id;
        $this->deleterName = $deleter->userName;
        $this->deletedAt = ExecTimeValueObject::create(Carbon::now()->format('Y-m-d H:i:s'));
        $this->isDeleted = IsDeletedValueObject::create(1);
        return;
    }

    // Entity同士の依存関係不整合チェック
    public final function dependsOn(...$entities): void
    {

        $msg = '';
        foreach($entities as $entity){
            // 削除済みのEntityを参照していないかチェック
            if($entity->isDeleted->v() === 1){
                $msg .= $entity->id->getName() . ": " . $entity->id->v() . '<br>';
            }
        }
        if($msg != ''){
            throw new AlreadyDeletedErrorResponseException($msg);
        }
        return;
    }

    // Nullチェック
    public final function requiredFields(...$fields): void
    {
        $msg = '';
        foreach($fields as $field){
            if(is_null($field->v()) or empty($field->v())){
                $msg .= $field->getName() . '<br>';
            }
        }
        if($msg != ''){
            throw new RequiredValueErrorResponseException($msg);
        }
        
        return;
    }

    // 排他制御チェック
    public final function checkExclusiveControl(): void
    {
        if($this->updatedAt->v() != request()->header('updated-at')){
            throw new InvalidOperationErrorResponseException('この製品は他のユーザー: ' . $this->updaterName->v() . ' によって更新されています。');
        }
        return;
    } 

    // バリデーション
    // public final function validateFields(...$fields): void
    // {
    //     $msg = '';
    //     foreach($fields as $field){
    //         if($field->v() != null){
    //             $msg .= $field->validate() . '<br>';
    //         }
    //     }
    //     if($msg != ''){
    //         throw new InvalidValueErrorResponseException($msg);
    //     }
        
    //     return;
    // }
}
?>