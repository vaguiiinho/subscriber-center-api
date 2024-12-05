<?php

namespace Core\Domain\Entity;

use Core\Domain\Enum\PersonType;
use Core\Domain\ValueObject\CnpjCpf;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Customer extends Entity
{

    public function __construct(
        protected bool $active,
        protected PersonType $personType,
        protected string $name,
        protected CnpjCpf $cnpj_cpf,
        protected DateTime $birthDate,
        protected DateTime $registrationDate,
        protected string $idExternal,
        protected ?Uuid $id = null,
    ) {
        $this->id = $this->id ?? Uuid::random();
    }

    public function birthDate()
    {
        return $this->birthDate->format('Y-m-d');
    }

    public function registrationDate()
    {
        return $this->registrationDate->format('Y-m-d');
    }
}
