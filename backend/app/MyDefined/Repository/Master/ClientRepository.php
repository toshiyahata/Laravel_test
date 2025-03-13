<?php

namespace App\MyDefined\Repository\Master;

use App\Exceptions\DatabaseExistanceErrorResponseException;
use App\Models\Master\Client;
use App\MyDefined\Entity\Master\ClientEntity;
use App\MyDefined\ValueObject\Client\ClientCodeValueObject;
use App\MyDefined\ValueObject\Client\ClientNameValueObject;

final class ClientRepository implements ClientRepoInterface{
    public function getClientbyId(ClientCodeValueObject $clientCode): ClientEntity
    {
        $Client = Client::where('取引先コード', $clientCode->v())
            ->where('削除フラグ', 0)
            ->first();
        if(!$Client){
            throw new DatabaseExistanceErrorResponseException('指定の' . $clientCode->getName() . 'は存在しません。');
        }

        return ClientEntity::reconstructFromRepository(
            ClientCodeValueObject::create($Client->取引先コード),
            ClientNameValueObject::create($Client->取引先略称)
        );
    }
}
?>