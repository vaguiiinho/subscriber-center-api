<?php

namespace Core\UseCase\Contract\Create\Dto;

class CreateContractOutputDto
{
    public function __construct(
        protected string $id,
        protected string $activationDate,
        protected string $renewalDate,
        protected string $contractStatus,
        protected string $internetStatus,
        protected string $idExternal,
        protected string $street = '',
        protected string $number = '',
        protected string $neighborhood = '',
        protected string $complement = '',
        protected string $city = '',
    ) {}
}
