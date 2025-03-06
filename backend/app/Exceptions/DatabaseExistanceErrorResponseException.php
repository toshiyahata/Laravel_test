<?php

namespace App\Exceptions;

class DatabaseExistanceErrorResponseException extends BaseErrorResponseException
{
    public function toResponse($request)
    {
        $this->setErrorMessage($this->getErrorMessage());
        $this->setStatusCode(404);
        $this->setErrorCode('database_existance');
        return parent::toResponse($request);
    }
}