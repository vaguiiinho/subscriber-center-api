<?php

namespace Core\UseCase\Contract\Create\Dto;

use Core\Domain\ValueObject\Address;

class CreateContractInputDto
{
    public function __construct(
        public string $activationDate,
        public string $renewalDate,
        public string $contractStatus,
        public string $internetStatus,
        public string $idExternal,
        public ?Address $address = null,
        
    ) {}
}
