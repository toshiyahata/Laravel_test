<?php

namespace App\Exceptions;

class DatabaseStoreErrorResponseException extends BaseErrorResponseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage('データベースへの永続化に失敗しました。<br>'. $this->getErrorMessage());
        $this->setStatusCode(500);
        $this->setErrorCode('database_store');
        return parent::toResponse($request);
    }
}