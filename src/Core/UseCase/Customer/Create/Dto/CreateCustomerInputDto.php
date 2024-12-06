<?php

namespace Core\UseCase\Customer\Create\Dto;

use Core\Domain\ValueObject\Address;

class CreateCustomerInputDto
{
    public function __construct(
        public bool $active,
        public string $personType,
        public string $name,
        public string $cnpj_cpf,
        public string $birthDate,
        public string $registrationDate,
        public string $idExternal,
    ) {}
}
