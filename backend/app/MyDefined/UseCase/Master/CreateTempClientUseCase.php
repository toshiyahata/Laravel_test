<?php

namespace APP\MyDefined\UseCase\Master;

use App\MyDefined\Entity\Master\ClientEntity;
use App\MyDefined\Repository\Master\ClientRepoInterface;
use App\MyDefined\ValueObject\ClientCodeValueObject;

final class CreateTempClientUseCase
{
    private $clientRepository;

    public function __construct(
        ClientRepoInterface $clientRepository
    )
    {
        $this->clientRepository = $clientRepository;   
    }

    public function execute(
        ClientCodeValueObject $clientCode
    )
    {
        $client = ClientEntity::create($clientCode);
        $this->clientRepository->store($client);
        return $client->entityToResponse();
    }
}