<?php

namespace Core\UseCase\Contract\Create\Dto;

class CreateContractOutputDto
{
    public function __construct(
        public string $id,
        public string $activationDate,
        public string $renewalDate,
        public string $contractStatus,
        public string $internetStatus,
        public string $idExternal,
        public ?string $street = null,
        public ?string $number = null,
        public ?string $neighborhood = null,
        public ?string $complement = null,
        public ?string $city = null,
    ) {}
}
