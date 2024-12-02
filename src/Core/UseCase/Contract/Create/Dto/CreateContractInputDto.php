<?php

namespace Core\UseCase\Contract\Create\Dto;

class CreateContractInputDto
{
    public function __construct(
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
