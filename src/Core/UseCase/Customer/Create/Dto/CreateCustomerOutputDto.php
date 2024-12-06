<?php

namespace Core\UseCase\Customer\Create\Dto;

class CreateCustomerOutputDto
{
    public function __construct(
        public string $id,
        public bool $active,
        public string $personType,
        public string $name,
        public string $cnpj_cpf,
        public string $birthDate,
        public string $registrationDate,
        public string $idExternal,
    ) {}
}
